<?php

use Proto\CS_Get_Password;
use \GatewayWorker\Lib\Gateway;
require_once __DIR__ . '/Proto/Autoloader.php';
//require_once './Proto/Proto/CS_Get_Password.php';
//require_once 'number_object_map.php';
require_once 'hall.php';
function test_xxx($client_id,$phone)
{
    $test_phone =[

        15310998091=>1,
        15010203055=>1,
        15086766692=>1,
        15215231585=>1,
        15025383863=>1,
        18375737897=>1,
        13527459205=>1,
        15825968078=>1,
        13408402252=>1,
        13368126145=>1,
        13637731507=>1,
        18502389625=>1,
        17749962904=>1,
        19923867963=>1,
        15310982078=>1,
        18723223788=>1,
        13852066988=>1,
        13032333303=>1,
        15683608811=>1,
    ];
    if(!array_key_exists($phone,$test_phone))
    {
        send_notice_by_client_id($client_id,1,'服务器暂未开放！');
        return false;
    }
    return true;
}

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
    echo "调用switch-->mid：$mid\n";
    if($mid == 40000)
    {
        web_server_message_manager($data);
        return;
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
        $channel_id=$cs_get_password->getChannelId();
        $phone = trim($phone);
//
//        if(!test_xxx($client_id,$phone))
//        {
//            return;
//        }

        //是否新建用户
        $is_create_user = false;
        //获取用户密码
        $password = product_password();

        $xxxx=db_exist_user_info($phone);
        //新增用户uid
        if($xxxx==null)
        {
            //新增用户
            db_add_user_id($phone,$password,$channel_id);
            $new_user = db_exist_user_info($phone);
            $is_create_user=true;
            if(!isset($new_user['user_id']))
            {
                send_notice_by_client_id($client_id,1,'注册失败！error:1001');
                util_log("db_add_user fail!web注册失败!phone: $phone");
                return ;
            }
            $user = db_exist_user($phone);
            if(isset($user['uid'])&&$user['uid']!=null)
            {
                if(!db_delete_user($user['uid']))
                {
                    send_notice_by_client_id($client_id,1,'注册失败！error:1003');
                    util_log("db_add_user fail!游戏服务器注册失败!phone: $phone");
                    return ;
                }
            }
            if(!db_add_user($phone,(int)$new_user['user_id'],$password))
            {
                db_delete_user_id((int)$new_user['user_id']);
                send_notice_by_client_id($client_id,1,'注册失败！error:1002');
                util_log("db_add_user fail!!游戏服务器注册失败!phone: $phone");
                return ;
            }

        }
        else
        {
            //拦截冻结用户
            if ($xxxx['nullity']==0)
            {
                send_notice_by_client_id($client_id,1,'该用户已被冻结，为了保证真实用户利益，请联系客户核对信息！客服电话：023-63010107 客服QQ：2480860168 客服微信：Lianhuanhui-Kefu');
                return;
            }

            $user = db_exist_user($phone);
            if(isset($user['uid'])&&$user['uid']!=null&&$user['uid']==$xxxx['user_id'])
            {
                db_update_password($phone,$password);

            }
            else
            {
                if(db_get_user_by_id($xxxx['user_id']))
                {
                    if(!db_delete_user($xxxx['user_id']))
                    {
                        send_notice_by_client_id($client_id,1,'注册失败！error:1006');
                        util_log("db_add_user fail!游戏服务器注册失败!phone: $phone");
                        return ;
                    }
                }
                if(isset($user['uid'])&&$user['uid']!=null&&$user['uid']!=$xxxx['user_id'])
                {
                    if(!db_delete_user($user['uid']))
                    {
                        send_notice_by_client_id($client_id,1,'注册失败！error:1007');
                        util_log("db_add_user fail!游戏服务器注册失败!phone: $phone");
                        return ;
                    }
                }
                //$xxx = db_exist_user_info($phone);
                if(!db_add_user($phone,(int)$xxxx['user_id'],$xxxx['user_passwd']))
                {
                    //db_delete_user_id((int)$xxx['user_id']);
                    send_notice_by_client_id($client_id,1,'注册失败！error:1004');
                    util_log("db_add_user fail!!游戏服务器注册失败!phone: $phone");
                    return ;
                }
                $password=$xxxx['user_passwd'];
            }
        }
        if(!isset($_SESSION['phone']))
        {
            // 保存当前手机号
            $_SESSION['phone'] = $phone;
        }
        $is_create_user=false;
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

//        if(!test_xxx($client_id,$cs_client_login->getPhone()))
//        {
//            return;
//        }
        if(substr($cs_client_login->getPhone(),0,3)=='170'||substr($cs_client_login->getPhone(),0,3)=='171')
        {
            return;
        }

        $get_user=db_get_user_by_verify($cs_client_login->getPhone(),$cs_client_login->getPassword());
        //var_dump($get_user);
        $is_success=false;
        $binded=0;
        if($get_user!=null)
        {
            $nowTime=date('Y-m-d h:i:s', time());
            //验证账号是否有问题
            $get_user_info=db_exist_user_info($cs_client_login->getPhone());

            //拦截冻结用户
            if ($get_user_info['nullity']==0)
            {
                send_notice_by_client_id($client_id,1,'该用户已被冻结，为了保证真实用户利益，请联系客户核对信息！客服电话：023-63010107 客服QQ：2480860168 客服微信：Lianhuanhui-Kefu');
                return;
            }

            if($get_user_info==null || $get_user_info['user_id']!=$get_user[0]['uid'])
            {
                if(!db_delete_user($get_user[0]['uid']))
                {
                    send_notice_by_client_id($client_id,1,'注册失败！error:1005');
                    util_log("db_add_user fail!游戏服务器注册失败!phone: ".$cs_client_login->getPhone());
                    return ;
                }
                return;
            }
            $is_success=true;
            if(!isset($_SESSION['uid']))
            {
                if(Gateway::isUidOnline($get_user[0]['uid']))
                {
                    $arr=Gateway::getClientIdByUid($get_user[0]['uid']);
                    foreach ($arr as $value)
                    {
                        Gateway::closeClient($value);
                    }
                }
                Gateway::bindUid($client_id,$get_user[0]['uid']);
                // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
                $_SESSION['uid'] = $get_user[0]['uid'];
                $_SESSION['phone'] = $cs_client_login->getPhone();
                $_SESSION['loginTime']=time();
                //添加相应数据到连接
                /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
                 * 实现针对特定uid推送数据
                 */
                //$tcp_worker->uidConnections[$connection->phone] = $connection;
            }
            //判断是否创建角色
//            if($get_user[0]['name']==null)
//            {
//                send_pack_password($client_id,$cs_client_login->getPhone(),$cs_client_login->getPassword(),true);
//                return;
//            }
            //
            $uid=$_SESSION['uid'];
            //修改用户登陆时间信息
            $sql="update bolaik_user.user_info set login_time='$nowTime',rmb=1 where user_id=$uid";
            db_query($sql);
            $sql="insert into bolaik_user.user_stat_time(user_id) values($uid)";
            db_query($sql);
            //记录今日最高在线人数
            $date=date('Y-m-d', time());
            $time=date('h:i:s', time());
            $sql="select max_user from bolaik_user.user_online where date_time='$date'";
            $online=db_query($sql);
            $max=count($online)>0?$online[0]['max_user']:1000;
            global $connection_count;
            if($connection_count>$max){
                $sql="update bolaik_user.user_online set max_user= $connection_count,max_time='$time' where date_time='$date'";
                db_query($sql);
            }
            //判断是否绑定邀请码
            $sql="SELECT agent_id FROM `bolaik_user`.`user_info` WHERE user_id=$uid";
            $rs=db_query($sql);
            if($rs[0]["agent_id"]!=""){
                $binded=1;
            }
        }
        send_pack_login($client_id,$is_success,$binded);
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
//        return;
    }
    //大厅新加信息
    if($mid>20000&&$mid<30000){
        hall_message_switch($mid,$data);
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
                $vip_day = 0;
                $user_info_vip = db_get_user_info_vip($_SESSION['uid']);
                if(isset($user_info_vip['vip_num'])&&$user_info_vip['vip_num']!=null&&$user_info_vip['vip_num']>0)
                {
                    $vip_day = $user_info_vip['vip_num'];
                }
                send_vip_day($_SESSION['uid'],$vip_day);
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
                if($user_info_vip['b_qq']==null){
                    //获取绑定手机的BU奖励
                    $bu=getBuRemain($_SESSION["phone"]);
                    if(getBu($_SESSION["phone"],"015003A031B354",20)){
                        send_user_coin_change1($_SESSION['uid'],$bu+20);
                    }
                    //修改状态
                    $uid=$_SESSION['uid'];
                    $sql="update `bolaik_user`.`user_info` set b_qq=1 where user_id='$uid'";
                    db_query($sql);
                }
                //发送跑马灯信息
                hall_message_switch(20027,null);
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
                if($get_sign['is_sign']==1)
                {
                    send_pack_sign($client_id,1,false);
                    return;
                }
                db_user_sign($_SESSION['uid']);
                send_pack_sign($client_id,1,true);

                task_udpate_once($_SESSION['uid'],299999);
                return;
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
//                    task_udpate_once($_SESSION['uid'],300034);
                    $bu=getBuRemain($_SESSION["phone"]);
                    if(getBu($_SESSION["phone"],"015003A004B357",30)){
                        send_user_coin_change1($_SESSION['uid'],$bu+30);
                    }
                }
                return;
            }
        case 1012:
            {
                $user_info_up = new \Proto\CS_User_Bind_wx();
                $user_info_up->parseFromString($data);
                $is_success = true;
                $user=db_user_bWx_mark($_SESSION['uid']);
                if(!isset($user['bWx'])|| $user['bWx']===null || $user['bWx']==1)
                {
                    send_pack_user_wx($client_id,false);
                    return;
                }
                db_user_update_bWx($_SESSION['uid']);
                $user_wx = db_user_is_bWx($_SESSION['uid']);
                if($user_wx==null||!isset($user_wx['openid'])||$user_wx['openid']==null)
                {
                    if(db_user_bWx($_SESSION['uid'],$user_info_up->getOpenid(),$user_info_up->getUnionid())==null)
                    {
                        $is_success=false;
                    }
                }
                send_pack_user_wx($client_id,$is_success);
                if($is_success){
//                    task_udpate_once($_SESSION['uid'],300033);
                    $bu=getBuRemain($_SESSION["phone"]);
                    if(getBu($_SESSION["phone"],"015003A032B358",20)){
                        send_user_coin_change1($_SESSION['uid'],$bu+20);
                    }
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