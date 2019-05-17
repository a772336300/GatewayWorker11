<?php
function web_server_message_manager($data)
{
    global $task_sign_map;
    $dataArr =json_decode($data);
    if($dataArr['f']=='signNotice')
    {
        $task_event = new \Proto\SM_Task_Event();
        $uid= $dataArr['user_id'];
        $task_id = $dataArr['task_id'];
        $task_event->appendHandler($task_sign_map[$task_id]);
        $task_event->setTaskType(\Proto\MY_TASK_TYPE::MY_UPDARE);
        send_to_task_server(my_pack_with_uid(535,$_SESSION['uid'],$task_event->serializeToString()));
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

}