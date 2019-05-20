<?php
function web_server_message_manager($data)
{
    global $task_sign_map;
    $dataArr =json_decode($data,true);
    util_log("收到Web端消息：user_id:".$dataArr['user_id'].",u_coin:".$dataArr['u_coin']."strength:".$dataArr['strength']);
    if($dataArr['f']=='signNotice')
    {
        task_udpate_once($dataArr['user_id'],$dataArr['task_id']);
        return;
    }
    if($dataArr['f']=='updateUserInfo')
    {
        $uid= $dataArr['user_id'];
        $u_coin = $dataArr['u_coin'];
        $gold_coin = $dataArr['gold_coin'];
        $strength = $dataArr['strength'];
        db_update_user_money($uid,$u_coin,$gold_coin,$strength);
        if($u_coin!=0)
        {
            //发送帐变
            send_pack_BU_change($uid,$u_coin);
        }
        if($strength!=0)
        {
            //发送体力
            send_pack_strength_change($uid,$strength);
        }

        return;
    }
    if($dataArr['f']=='refreshTable')
    {
        $dataArr['libName'];
        $dataArr['tableName'];
        $refresh = refreshUserInit();
        foreach ($refresh as $id=>$value)
        {
            send_notice_to_all($id,$value);
        }
    }

}