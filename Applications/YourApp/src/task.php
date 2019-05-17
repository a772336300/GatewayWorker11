<?php

function send_to_task_server($data)
{
//    global $tcp_worker;
//    $index = $tcp_worker->taskServerConnectionsIndex%$tcp_worker->taskServerConnectionsCount;
//    if(array_key_exists($index,$tcp_worker->taskServerConnections))
//    {
//        $tcp_worker->taskServerConnections[$index]->send($data);
//        echo "send to task server! worker id: $tcp_worker->id\n";
//    }
//    else
//        echo "miss task server! worker id: $tcp_worker->id\n";
}

function task_manager($mid,$ProtoName='',$data=null)
{
    switch ($mid)
    {
        case 1006:
            {
                //游戏签到
                task_update(10001);
                break;
            }
        case 900:
            {
                //10局游戏
                task_update(10009);
                break;
            }
        case 703:
            {
                //手机号
                task_update(10012);
                break;
            }
        case 1012:
            {
                //微信
                task_update(10013);
                break;
            }
        case 1010:
            {
                //实名认证
                task_update(10015);
                break;
            }
    }

}
function task_update($behavierid)
{
    $task_event = new \Proto\SM_Task_Event();
    $task_event->setTaskType(\Proto\MY_TASK_TYPE::MY_UPDARE);
    $task_event->appendHandler($behavierid);
    send_to_task_server(my_pack_with_uid(535,$_SESSION['uid'],$task_event->serializeToString()));
}