<?php
function db_get_user_init()
{
    global $tcp_worker;
    return $tcp_worker->db->query("select id,value from func_system.init_system");
}
function db_check_user($uid,$password)
{
    global $tcp_worker;
    if($tcp_worker->db->query("select * from user where uid = $uid and password = '$password'")==null)
    {
        return false;
    }
    return true;
}
function db_get_user_by_id($uid)
{
    global $tcp_worker;
    if($tcp_worker->db->query("select * from user where uid = $uid")==null)
    {
        return false;
    }
    return true;
}
function db_exist_user_info($phone)
{
    global $tcp_worker;
    global $web_user;
    return $tcp_worker->db->select('user_id,user_passwd')->from("$web_user.user_info")->where("user_account= '$phone'")->row();
}
function db_add_user_id($phone,$password)
{
    global $tcp_worker;
    global $web_user;
    $sql="select max(user_id+0) maxId from $web_user.user_info";
    $maxUser=$tcp_worker->db->query($sql);
    $user_id=$maxUser[0]['maxId']+1;
    try {
        $sql = "insert into $web_user.user_info(user_account,user_passwd,user_id,user_nick,user_equipment,login_type,b_phone_nu) values('$phone','$password',$user_id,'',2,2,'$phone');";
        //$sql = "insert into user (phone,password) values('$phone','$password');";
        $tcp_worker->db->query($sql);
    } catch (\Exception $e) {
        util_log("添加user_info失败!phone:$phone,user_id:$user_id!error: 2001");
    }

}
function db_delete_user_id($uid)
{
    global $tcp_worker;
    //$sql = "delete user where uid = $uid;";
    $tcp_worker->db->query("delete user where uid = $uid;");
}
function db_exist_user($phone)
{
    global $tcp_worker;
    return $tcp_worker->db->select('uid')->from("user")->where("phone= '$phone'")->row();
}
function db_delete_user($uid)
{
    global $tcp_worker;
    $tcp_worker->db->beginTrans();

    $tcp_worker->db->delete('user')->where("uid=$uid")->query();
    $tcp_worker->db->delete('user_money')->where("uid=$uid")->query();
    $tcp_worker->db->delete('user_sign')->where("uid=$uid")->query();
    $tcp_worker->db->delete('user_bag')->where("uid=$uid")->query();
    $tcp_worker->db->delete('user_wx')->where("uid=$uid")->query();

    if(!$tcp_worker->db->commitTrans())
    {
        $tcp_worker->db->rollBackTrans();
        return false;
    }// or $db1->rollBackTrans();


    return true;

}
function db_add_user($phone,$uid,$password)
{
    global $init_user_config;
    global $tcp_worker;
    global $init_equipment;
    global $init_equipment_having;

    $init_equipment_json = json_encode($init_equipment);
    $init_equipment_having_json = json_encode($init_equipment_having);
    $tcp_worker->db->beginTrans();
    $sql = "insert into user (uid,phone,password) values($uid,'$phone','$password');";
    $sql1 = "insert into user_money (uid,gold,vigour) values($uid,$init_user_config[gold],$init_user_config[vigour]);";
    $sql2 = "insert into user_sign (uid) values($uid);";
    $sql3 = "insert into user_bag (uid,equipmenting_item,having_item) values($uid,'$init_equipment_json','$init_equipment_having_json');";
    //$sql4 = "insert into bolaik_user.user_info(user_account,user_passwd,user_id,user_nick,user_equipment,login_type,b_phone_nu) values('$phone','$password',$uid,'',2,2,'$phone')";
    //echo $sql.$sql1.$sql2;

    $tcp_worker->db->query($sql);
    $tcp_worker->db->query($sql1);
    $tcp_worker->db->query($sql2);
    $tcp_worker->db->query($sql3);
    //$tcp_worker->db->query($sql4);


    if(!$tcp_worker->db->commitTrans())
    {
        $tcp_worker->db->rollBackTrans();
        return false;
    }// or $db1->rollBackTrans();


    return true;
//    return $db->insert('user')->cols(array(
//        'phone'=>$phone,
//        'uid'=>$uid,
//        'password'=>$password,
//    ))->query();
}
function db_update_password($phone,$password)
{
    global $tcp_worker;
    $tcp_worker->db->update('user')->cols(array('password'=>(string)$password))->where("phone='$phone'")->query();
}

function db_create_user($phone,$name,$gender,$constellation)
{
    global $tcp_worker;
    //默认模型id
    return $tcp_worker->db->update('user')->cols(array('name'=>(string)$name,'gender'=>$gender,'constellation'=>$constellation,'moxing_id'=>$gender?'100':'102'))->where("phone='$phone'")->query();
}

function db_get_user_by_verify($phone,$password)
{
    global $tcp_worker;
    //echo "select uid,name from user where phone = '$phone' and password = '$password'";
    return $tcp_worker->db->query("select uid,name from user where phone = '$phone' and password = '$password'");
}

function db_get_user_info_by_uid($uid)
{
    global $tcp_worker;
    //echo "SELECT * from `user`,user_money,user_sign where `user`.uid = $uid and `user`.uid = user_money.uid and `user`.uid = user_sign.uid";
    return $tcp_worker->db->query("SELECT * from `user`,user_money,user_sign where `user`.uid = $uid and `user`.uid = user_money.uid and `user`.uid = user_sign.uid");
}
function db_get_user_info_vip($uid)
{
    global $tcp_worker;
    global $web_user;
    return $tcp_worker->db->select('vip_num')->from("$web_user.user_info")->where("user_id= '$uid'")->row();
    //echo "SELECT * from `user`,user_money,user_sign where `user`.uid = $uid and `user`.uid = user_money.uid and `user`.uid = user_sign.uid";
    //return $tcp_worker->db->query("SELECT * from `user`,user_money,user_sign where `user`.uid = $uid and `user`.uid = user_money.uid and `user`.uid = user_sign.uid");
}
function db_get_user_bag_info_by_uid($uid)
{
    global $tcp_worker;
    //echo "select * from user_bag where uid = '$uid'";
    return $tcp_worker->db->query("select * from user_bag where uid = $uid");
}
function db_update_user_info_bAgent($isAgent,$uid)
{
    global $tcp_worker;
    return $tcp_worker->db->update('user')->cols(array('bAgent'=>$isAgent))->where("uid=$uid")->query();
}
function db_is_sign($uid)
{
    global $tcp_worker;
    //return $tcp_worker->db->query("select sign_date,updated from user_sign where uid = $uid");
    return $tcp_worker->db->select('is_sign')->from('user_sign')->where("uid= $uid ")->row();
}
//function db_is_sign($uid)
//{
//    global $tcp_worker;
//    //return $tcp_worker->db->query("select sign_date,updated from user_sign where uid = $uid");
//    return $tcp_worker->db->select('sign_date,updated')->from('user_sign')->where("uid= $uid ")->row();
//}
function db_user_sign($uid)
{

    global $tcp_worker;
    return $tcp_worker->db->query("update user_sign set is_sign=1 where uid= $uid");
}
//function db_user_sign($is_new,$uid)
//{
//
//    global $tcp_worker;
//    if($is_new)
//    {
//        return $tcp_worker->db->query("update user_sign set sign_date=1 where uid= $uid");
////    return $tcp_worker->db->insert('user_sign')->cols(array(
////        'uid'=>$uid,
////        'sign_date'=>1,
////     ))->query();
//    }
//    else
//    {
//        return $tcp_worker->db->query("update user_sign set sign_date=sign_date%7+1 where uid= $uid");
//    }
//}
function db_update_user_info_some($uid,$name,$gender,$type)
{
    global $tcp_worker;
    //echo "update user set name='$name',gender=$gender,constellation=$type where uid= $uid";
    return $tcp_worker->db->query("update user set name='$name',gender=$gender,constellation=$type where uid= $uid");
    //return $tcp_worker->db->update('user')->cols(array('name'=>(string)$name,'gender'=>$gender,'constellation'=>$type))->where("uid=$uid")->query();
}
function db_user_real_name($uid,$name,$code)
{
    global $tcp_worker;
        return $tcp_worker->db->insert('user_real_name')->cols(array(
        'uid'=>$uid,
        'real_name'=>(string)$name,
            'code'=>(string)$code
     ))->query();
}
function db_user_update_bRealName($uid)
{
    global $tcp_worker;
    //echo "update user set bRealName=1 where uid= $uid";
    return $tcp_worker->db->query("update user set bRealName=1 where uid= $uid");
}
function db_user_bWx_mark($uid)
{
    global $tcp_worker;
    //return $tcp_worker->db->query("select sign_date,updated from user_sign where uid = $uid");
    return $tcp_worker->db->select('bWx')->from('user')->where("uid= $uid")->row();
}
function db_user_is_bWx($uid)
{
    global $tcp_worker;
    //return $tcp_worker->db->query("select sign_date,updated from user_sign where uid = $uid");
    return $tcp_worker->db->select('openid')->from('user_wx')->where("uid= $uid")->row();
}
function db_user_bWx($uid,$openid,$unionid)
{
    global $tcp_worker;
    return $tcp_worker->db->insert('user_wx')->cols(array(
        'uid'=>$uid,
        'openid'=>(string)$openid,
        'unionid'=>(string)$unionid
    ))->query();
}

function db_user_update_bWx($uid)
{
    global $tcp_worker;
    //echo "update user set bWx=1 where uid= $uid";
    return $tcp_worker->db->query("update user set bWx=1 where uid= $uid");
}
function db_store_user_gps($uid,$X,$Y)
{
    global $tcp_worker;
    return $tcp_worker->db->insert('user_gps')->cols(array(
        'uid'=>$uid,
        'x'=>$X,
        'y'=>$Y
    ))->query();
}
function db_buy_item($uid,$user_info_bag,$buy_item)
{
    global $init_equipment_buy;
    $gold = 0;
    $items= array();
    $moxing_id=$buy_item->getMoxing();
    $equipmenting_item_arr=json_decode($user_info_bag['equipmenting_item'],true);
    $having_item_arr=json_decode($user_info_bag['having_item'],true);
    foreach ($equipmenting_item_arr as $key=>$item)
        if($key==$moxing_id)
        {
            foreach ($buy_item->getItemSlotIterator() as $value)
            {
                //echo 'xxoooooooo';
                //echo $value->getSlot();
                //echo '000000ooooo';
                $gold=$gold+$init_equipment_buy[$value->getItemid()];
                $items[]= $value->getItemid();
                $having_item_arr[]= $value->getItemid();
                $equipmenting_item_arr[$key][$value->getSlot()] =$value->getItemid();
            }
            break;
        }
    $equipmenting_item_json=json_encode($equipmenting_item_arr);
    $having_item_json=json_encode($having_item_arr);

    global $tcp_worker;
    if($moxing_id==99)
    {
        //echo 'xxxx';
        //var_dump($items);
        //echo 'xxxx';
        $tcp_worker->db->query("update user set changjing_id= $items[0] where uid = $uid");

    }
    else
    {
        $tcp_worker->db->query("update user set moxing_id= $moxing_id where uid = $uid");
    }
    if($tcp_worker->db->query("update user_bag set equipmenting_item= '$equipmenting_item_json',having_item='$having_item_json' where uid = $uid")==null)
    {
        return null;
    }
    else
    {
        gold_buy($uid,$gold);
        return $items;
    }

}
function db_equip_item($uid,$user_info_bag,$buy_item)
{

    $items= array();
    $equipmenting_item_arr=json_decode($user_info_bag['equipmenting_item'],true);
    foreach ($equipmenting_item_arr as $key=>$item)
        if($key==$buy_item->getMoxing())
        {
            foreach ($buy_item->getItemSlotIterator() as $value)
            {
                $items[]= $value->getItemid();
                $equipmenting_item_arr[$key][$value->getSlot()] =$value->getItemid();
            }
        }
    $equipmenting_item_json=json_encode($equipmenting_item_arr);

    global $tcp_worker;
    if($tcp_worker->db->query("update user_bag set equipmenting_item= '$equipmenting_item_json' where uid = $uid")==null)
    {
        return null;
    }
    else
    {
        return $items;
    }

}
function db_equip_item_changjing($uid,$user_info_bag,$buy_item)
{

    $items= array();
    $equipmenting_item_arr=json_decode($user_info_bag['equipmenting_item'],true);
    foreach ($equipmenting_item_arr as $key=>$item)
        if($key==99)
        {
            $equipmenting_item_arr[$key][7] =$buy_item->getChangjing();
            $items[]= $buy_item->getChangjing();
        }
    $equipmenting_item_json=json_encode($equipmenting_item_arr);

    global $tcp_worker;
    if($tcp_worker->db->query("update user_bag set equipmenting_item= '$equipmenting_item_json' where uid = $uid")==null)
    {
        return null;
    }
    else
    {
        return $items;
    }

}
function gold_buy($uid,$gold)
{
    global  $tcp_worker;
    if($gold>0)
    $tcp_worker->db->query("update user_money set gold =gold-$gold where uid =$uid");
    send_pack_gold_change($uid,-$gold);
}
function db_add_user_game_store($uid,$play_game_result)
{

    $gameid=$play_game_result->getGameid();
    $value1=$play_game_result->getValue1();
    $value2=$play_game_result->getValue2();
    $value3=$play_game_result->getValue3();
    $value4=$play_game_result->getValue4();
    $value5=$play_game_result->getValue5();
    $value6=$play_game_result->getValue6();
    global $tcp_worker;
    //echo "insert into user_game (uid,gameid,value1,value2, value3, value4, value5, value6)values($uid,$gameid,$value1,$value2,$value3,$value4,$value5,$value6)";
    $tcp_worker->db->query("insert into user_game (uid,gameid,value1,value2, value3, value4, value5, value6)values($uid,$gameid,$value1,$value2,$value3,$value4,$value5,$value6)");
}
function db_update_user_money($uid,$u_coin,$gold_coin,$strength)
{
    global  $tcp_worker;
    $tcp_worker->db->query("update user_money set BU=BU+$u_coin, gold =gold+$gold_coin, vigour = vigour+$strength where uid =$uid");
}
function db_get_task_config()
{
    global $tcp_worker;
    $sql="select * from func_system.task_config";
   // echo $sql;
    return $tcp_worker->db->query($sql);
}

function db_query($sql)
{
    global $tcp_worker;
    //echo $sql;
    return $tcp_worker->db->query($sql);
}

//用戶充值
function db_user_recharge_query($userid,$variable,$code)
{
    global $tcp_worker;
    $select_sql="select user_account,user_id,agent_level,agent_id from user_info where user_id = $userid";
    $result=$tcp_worker->db->query($select_sql);

    $tmp_agent_id=$result[0]["agent_id"];
    $tmp_agent_level=result[0]["agent_level"];
    $member_num = 0;
    $sql="update user_info set Member_num = $member_num, bMember = 1 where user_id= $userid";
    $tcp_worker->db->query($sql);

    $sql="insert into recharge_vip_log(order_id,user_id,code,b_phone_nu,rmb,type,u_coin,totalxsf,status) VALUES ()";
    $tcp_worker->db->query($sql);
}

//代理提現
function db_user_tixian_query($userid,$variable)
{
    global $tcp_worker;
    $sql="insert ";
    return $tcp_worker->db->query($sql);
}
