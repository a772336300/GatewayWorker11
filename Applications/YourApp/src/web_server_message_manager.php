<?php
function web_server_message_manager($data)
{
    global $task_sign_map;
    $dataArr =json_decode($data,true);
    if(!isset($dataArr['f']))
    {
        util_log("get bad pack from webserver!data:$data");
        return ;
    }
    util_log("收到Web端消息f：".$dataArr['f']);
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
            util_log("refreshTable notice,id:$id value:$value");
            send_notice_to_all($id,$value);
        }
    }
    if($dataArr['f']=='rechargeNotice')
    {
        $vip_day =0;
        if(isset($dataArr['vip_num'])&&$dataArr['vip_num']!=null&&$dataArr['vip_num']>0)
        {
            $vip_day = $dataArr['vip_num'];
        }
        util_log("rechargeNotice uid:$dataArr[user_id] vip_day:$vip_day");
        send_vip_day($dataArr['user_id'],$vip_day);

    }

}