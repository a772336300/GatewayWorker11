<?php
use Workerman\Connection\AsyncTcpConnection;

function user_wx_recharge_result($userid,$orderid,$gold)
{
    global $tcp_worker;
    $select_sql="select agent_id from user_info where user_id = $userid";
    $result0=$tcp_worker->db->query($select_sql);
    $agent=array(
        "orderid"=>$orderid,
        "userid"=>$userid,
        "num"=>$gold,
    );

    $select_sql="select user_id,agent_id from user_info where user_id = $result0[0]['agent_id']";
    $result1=$tcp_worker->db->query($select_sql);
    $agent=array(
        "sjid"=>$result1[0]["user_id"],
        "sjnum"=>$gold * 0.15,
    );

    $select_sql="select user_id,agent_level,agent_id from user_info where user_id = $result1[0]['agent_id']";
    $result2=$tcp_worker->db->query($select_sql);

    if ($result2[0]["agent_level"]<=3 && $result2[0]["agent_level"]>=1)
    {
        $agent=array(
            "ssjid"=>$result2[0]["user_id"],
            "ssjnum"=>$gold * 0.15,
        );
    }else{
        $agent=array(
            "ssjid"=>null,
            "ssjnum"=>0,
        );
    }

    $vip_num = 0;
    if ($gold==0.9)
    {
        $vip_num = 1;
    }else if ($gold==18){
        $vip_num = 30;
    }

    $sql="update user_info set vip_num = $vip_num, bMember = 1 where user_id= $userid";
    $tcp_worker->db->query($sql);

    $sql="insert into bolaik_order.recharge_vip_log(order_id,user_id,num,sjid,sjnum,ssjid,ssjnum,state) VALUES ($agent[0]['orderid'],$agent[0]['user_id'],$agent[0]['num'],$agent[0]['sjid'],$agent[0]['sjnum'],$agent[0]['ssjid'],$agent[0]['ssjnum'],1)";
    $tcp_worker->db->query($sql);
}