<?php

use Proto\CS_Get_Password;
use \GatewayWorker\Lib\Gateway;
require_once __DIR__ . '/Proto/Autoloader.php';
//require_once './Proto/Proto/CS_Get_Password.php';
//require_once 'number_object_map.php';

//接收用户消息

function message_switch($client_id,$mid,$data)
{
    global $init_user_config;
    //如果包id不存在,记录错误返回
//    if(!array_key_exists($mid,$number_object_map))
//    {
//        echo "client packet error!from ip:";
//        //echo "client packet error!from ip:". $connection->getRemoteIp() . "\n";
//        return;
//    }
    if($mid == 40000)
    {
        web_server_message_manager($data);
    }
//    if(array_key_exists($mid,$task_event_map))
//    {
//        task_manager($mid,$task_event_map[$mid],$data);
//        //echo "client packet error!from ip:". $connection->getRemoteIp() . "\n";
//    }
    //从消息获取到对象
    //$request_login_buf = new $number_object_map[$mid];
    //$request_login_buf->parseFromString(substr($data,8));
    //请求密码
    if($mid == 701)
    {
        echo "get password request!";
        //获取请求对象
        $cs_get_password = new CS_Get_Password();

        $cs_get_password->parseFromString($data);
        $phone = $cs_get_password->getPhone();

        //是否新建用户
        $is_create_user = false;
        //获取用户密码
        $password = product_password();

        //新增用户uid
        if(db_exist_user($phone)==null)
        {
            //新增用户
            db_add_user_id($phone,$password);
            $new_user = db_exist_user($phone);
            $is_create_user=true;
            if(!isset($new_user['user_id']))
            {
                send_notice_by_client_id($client_id,1,'注册失败！error:1001');
                util_log("db_add_user fail!web注册失败!phone: $phone");
                return ;
            }
            if(!db_add_user($phone,$new_user['user_id'],$password))
            {
                db_delete_user_id($new_user['user_id']);
                send_notice_by_client_id($client_id,1,'注册失败！error:1002');
                util_log("db_add_user fail!!游戏服务器注册失败!phone: $phone");
                return ;
            }

        }
        else
        {
            db_update_password($phone,$password);
        }
        if(!isset($_SESSION['phone']))
        {
            // 保存当前手机号
            $_SESSION['phone'] = $phone;
        }
        send_pack_password($client_id,$phone,$password,$is_create_user);
        return;

    }

    if($mid==703)
    {
        echo "create user request!";
        $create_user = new \Proto\CS_Create_User();
        $create_user->parseFromString($data);
        $create_user_back = new \Proto\SC_Create_User_Back();

        $is_success =false;
        if(db_create_user($_SESSION['phone'],$create_user->getName(),(int)$create_user->getGender(),(int)$create_user->getConstellation())!=null)
        {
//            task_manager($mid);
            $is_success=true;
        }
        send_pack_create_user($client_id,$is_success);
        return;
    }
    if($mid==710)
    {

        echo "client login request!";
        //获取请求对象
        $cs_client_login = new \Proto\CS_Client_Login();
        $cs_client_login->parseFromString($data);


        $get_user=db_get_user_by_verify($cs_client_login->getPhone(),$cs_client_login->getPassword());
        //var_dump($get_user);
        $is_success=false;
        if($get_user!=null)
        {
            $is_success=true;
            if(!isset($_SESSION['uid']))
            {
                Gateway::bindUid($client_id,$get_user[0]['uid']);
                // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
                $_SESSION['uid'] = $get_user[0]['uid'];
                $_SESSION['phone'] = $cs_client_login->getPhone();
                //添加相应数据到连接
                /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
                 * 实现针对特定uid推送数据
                 */
                //$tcp_worker->uidConnections[$connection->phone] = $connection;
            }
            //判断是否创建角色
            if($get_user[0]['name']==null)
            {
                send_pack_password($client_id,$cs_client_login->getPhone(),$cs_client_login->getPassword(),true);
                return;
            }
            //
            $nowTime=date('Y-m-d h:i:s', time());
            $uid=$_SESSION['uid'];
            //修改用户登陆时间信息
            $sql="update bolaik_user.user_info set login_time='$nowTime' where user_id=$uid";
            db_query($sql);
            $sql="insert into bolaik_user.user_stat_time(user_id) values($uid)";
            db_query($sql);
        }
        send_pack_login($client_id,$is_success);
        return;
    }
    if($mid ==712)
    {
        $xiaotiao= new \Proto\SC_XinTiao();
        $xiaotiao->setDate(time());
        Gateway::sendToClient($client_id,my_pack(713,$xiaotiao->serializeToString()));
        return;
    }
    //如果用户id没设置
    if(!isset($_SESSION['uid']))
    {
        echo "without login message!";
        return;
    }
    //根据id对对象执行相应的行为
    switch ($mid)
    {
        //用户信息请求
        case 800:
            {
                echo "init user !";
                $user_info = db_get_user_info_by_uid($_SESSION['uid']);
                if($user_info==null)
                {
                    echo "get user error";
                    return;
                }
                ///$user_info_vip = db_get_user_info_vip($_SESSION['uid']);
//                if(isset($user_info_vip['vip_state']))
//                {
//
//                }
                send_vip_day($_SESSION['uid'],1);
                //商城开关
                send_notice($_SESSION['uid'],4,$init_user_config['shangchengkaiguan']);
                //实名认证
                send_notice($_SESSION['uid'],5,$init_user_config['shimingkaiguan']);
                //h获取BU信息
                get_jinlian_assert($_SESSION['uid'],$_SESSION['phone']);
                //请求金lian
                //get_user_BU();
                //801基本信息
                send_pack_user_info($client_id,$user_info[0]);
                send_pack_task_reward($client_id);
                $user_info_bag = db_get_user_bag_info_by_uid($_SESSION['uid']);
                var_dump($user_info_bag);
                send_pack_user_bag_info($client_id,$user_info_bag[0]);
                //发送任务列表
                get_user_task_list($_SESSION['uid']);
                break;
            }
        //游戏完成
        case 807:
            {
                db_update_user_info_bAgent(true,$_SESSION['uid']);
                break;
            }
        case 900:
            {
                $play_game_result = new \Proto\CS_Game_Over_Score();
                $play_game_result->parseFromString($data);
                db_add_user_game_store($_SESSION['uid'],$play_game_result);
//                task_manager($mid);
                task_udpate_game($play_game_result,$_SESSION['uid']);
                break;
            }
        case 901:
            {
                //$object
                break;
            }
        case 1000:
            {
                $buy_item = new \Proto\CS_User_Use_Equip();
                $buy_item->parseFromString($data);
                $user_info_bag = db_get_user_bag_info_by_uid($_SESSION['uid']);
                $items = db_equip_item($_SESSION['uid'],$user_info_bag[0],$buy_item);
                if($items==null)
                {
                    echo "equip item error\n";
                }
                else
                {
                    send_pack_user_equip_item($client_id,$items);
                }
                return;
            }
        case 1002:
            {

                $buy_item = new \Proto\CS_User_Buy_Item();
                $buy_item->parseFromString($data);
                $user_info_bag = db_get_user_bag_info_by_uid($_SESSION['uid']);
                $items = db_buy_item($_SESSION['uid'],$user_info_bag[0],$buy_item);
                if($items==null)
                {
                    echo "bay error\n";
                }
                else
                {
                    send_pack_user_buy_item($client_id,$items);
                }
                return;
                break;
            }
        case 1004:
            {
                $buy_item = new \Proto\CS_User_Select_changjing();
                $buy_item->parseFromString($data);
                $user_info_bag = db_get_user_bag_info_by_uid($_SESSION['uid']);
                $items = db_equip_item_changjing($_SESSION['uid'],$user_info_bag[0],$buy_item);
                if($items==null)
                {
                    echo "equip item changjing error\n";
                }
                else
                {
                    send_pack_user_equip_item_changjing($client_id,$items);
                }
                break;
            }
        case 1006:
            {

                //用户是否以签到
                $get_sign = db_is_sign($_SESSION['uid']);
                if($get_sign['sign_date']==null)
                {

                    db_user_sign(true,$_SESSION['uid']);
                    send_pack_sign($client_id,1,false);

                    //任务处理
//                  task_manager($mid);
                    task_udpate_once($_SESSION['uid'],299999);

                    return;
                }
                if((intval(strtotime($get_sign['updated'])/86400))==intval(time()/86400))
                {
                    send_pack_sign($client_id,$get_sign['sign_date'],true);
                    return;
                }
                else
                {
                    db_user_sign(false,$_SESSION['uid']);
                    send_pack_sign($client_id,$get_sign['sign_date']%7+1,false);
                    //任务处理
                    //task_manager($mid);
                    task_udpate_once($_SESSION['uid'],299999);
                    return;
                }
                break;
            }
        case 1008:
            {
                $user_info_up = new \Proto\CS_User_Info_Update();
                $user_info_up->parseFromString($data);
                $is_success = true;
                if(db_update_user_info_some($_SESSION['uid'],$user_info_up->getName(),$user_info_up->getGender(),$user_info_up->getType())==null)
                {
                    $is_success=false;
                }
                send_pack_user_info_update($client_id,$is_success);
                return;
            }
        case 1010:
            {
                $user_info_up = new \Proto\CS_User_Real_Name();
                $user_info_up->parseFromString($data);
                $is_success = true;
                if(db_user_real_name($_SESSION['uid'],$user_info_up->getName(),$user_info_up->getCode())==null)
                {
                    $is_success=false;
                }
                else
                {
                  //  task_manager($mid);
                }
                db_user_update_bRealName($_SESSION['uid']);
                send_pack_user_real_name($client_id,$is_success);
                if($is_success){
                    task_udpate_once($_SESSION['uid'],300034);
                }
                return;
            }
        case 1012:
            {
                $user_info_up = new \Proto\CS_User_Bind_wx();
                $user_info_up->parseFromString($data);
                $is_success = true;
                if(db_user_bWx($_SESSION['uid'],$user_info_up->getOpenid(),$user_info_up->getUnionid())==null)
                {
                    $is_success=false;
                }
                else
                {
                 //   task_manager($mid);
                }
                db_user_update_bWx($_SESSION['uid']);
                send_pack_user_wx($client_id,$is_success);
                if($is_success){
                    task_udpate_once($_SESSION['uid'],300033);
                }
                return;
            }
        case 1015:
            {
                $user_info_up = new \Proto\CS_User_GPS();
                $user_info_up->parseFromString($data);
                db_store_user_gps($_SESSION['uid'],$user_info_up->getX(),$user_info_up->getY());
                break;
            }
        case 1017:
            {
                send_to_task_server(my_pack_with_uid(10056,$_SESSION['uid'],$data));
                break;
            }
        case 1019:
            {
                $bu_stream = new \Proto\CS_User_BU_Steam();
                $bu_stream->parseFromString($data);
                get_jinlian_liushui($_SESSION['uid'],$_SESSION['phone'],$bu_stream->getFlag(),$bu_stream->getDateFlag(),$bu_stream->getPage(),$bu_stream->getPageSize(),$bu_stream->getUnixTimestamp(),$bu_stream->getShowAll());
                break;
            }
        case 1020: //充值
            {
                $user_Recharge = new \Proto\CS_User_Recharge();
                $user_Recharge->parseFromString($data);
                user_recharge($_SESSION['userid'],$_SESSION['variable'],$_SESSION['code']);
                break;
            }
        case 1022: //提现
            {
                $user_tixian = new \Proto\CS_User_Tixian();
                $user_tixian->parseFromString($data);
                user_tixian($_SESSION['userid'],$_SESSION['variable']);
                break;
            }
                // case 1019:
        //     {
        //         get_user_task_list($_SESSION['uid']);
        //         break;
        //     }
        //绑定微信
        //修改名称 （更改用户信息）
        //实名认证 （是否实名认证）
        //换装 （用户装备列表）(一般频繁)（buff和记录）
        //换背景 （）（一般频繁）(buff和记录)
        //购买装备（）（buff和表）
        //购买背景（） （buff和表）
        //游戏结束（）
        //公告（）

    }

}
//消息转发
function on_task_server_message_switch($packet)
{

    $len = unpack('I*',substr($packet,0,4))[1]-12;
    $midArry = unpack('I*',substr($packet,4,4));
    $uid = unpack('P*',substr($packet,12,8))[1];
    $data = substr($packet,20);
    echo  $uid;
    echo "\n";
    switch ($midArry[1])
    {
        case 288:
            {
                if(Gateway::isUidOnline($uid))
                {
                    task_nianbao_send($packet,803);
                }
                break;
            }
        case 289:
            {
                if(Gateway::isUidOnline($uid))
                {
                    task_nianbao_send($packet,1016);
                }
                break;
            }
        case 290:
            {
                if(Gateway::isUidOnline($uid))
                {
                    task_nianbao_send($packet,1018);
                }
                break;
            }
    }
}
function task_nianbao_send($packet,$mid)
{
    $len_packet = strlen($packet);
    $len = unpack('I*',substr($packet,0,4))[1];
    $midArry = unpack('I*',substr($packet,4,4));
    $uid = unpack('P*',substr($packet,12,8))[1];

    while ($len_packet>=$len)
    {
        //解析包
        $data = substr($packet,20,$len-20);
        Gateway::sendToUid($uid,my_pack_with_len($len-12,$mid,$data));
        //剩余包
        $packet = substr($packet,$len);
        if($packet ==null)
        {
            break;
        }
        $len = unpack('I*',substr($packet,0,4))[1];
        $len_packet=$len_packet-$len;
    }
}
function product_uid()
{
    //return uniqid('', true);
    global $tcp_worker;
    $current_time= time();
    $header=(int)$tcp_worker->id;//5个字节
    $middle=$current_time-1557659984;//29位 ，100年左右
    $end=$tcp_worker->product_uid_count;//序号10位
    $tcp_worker->product_uid_count++;
    if($tcp_worker->product_uid_count>1024)
    {
        $tcp_worker->product_uid_count=0;
    }
    return $header<<39|$middle<<10|$end;
}
function product_password()
{
    return intval((microtime(true)*1000));
}