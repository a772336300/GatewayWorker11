<?php

function send_to_task_server($data)
{
    global $tcp_worker;
    $index = $tcp_worker->taskServerConnectionsIndex%$tcp_worker->taskServerConnectionsCount;
    if(array_key_exists($index,$tcp_worker->taskServerConnections))
    {
        $tcp_worker->taskServerConnections[$index]->send($data);
        echo "send to task server! worker id: $tcp_worker->id\n";
    }
    else
        echo "miss task server! worker id: $tcp_worker->id\n";
}
function task_sign_update()
{

}
function task_manager($mid,$ProtoName,$data)
{
    switch ($mid)
    {
        case 1006:
            {
                $task_event = new \Proto\SM_Task_Event();
                $task_event->setTaskType(\Proto\MY_TASK_TYPE::MY_UPDARE);
                $task_event->appendHandler(10001);
                send_to_task_server(my_pack_with_uid(535,$_SESSION['uid'],$task_event->serializeToString()));
                break;
            }

    }

}
//更新一次完成的任务
function task_udpate_once($uid,$task_id)
{
    //
    $sql="update func_system.user_task set done=1,num=1,state=3 where user_id=$uid and task_id=$task_id";
    db_query($sql);
    //通知客户端更新
    send_update_task_state($uid,$task_id,3,1);
}

function task_udpate_game($play_game_result,$uid)
{

    $gameId=$play_game_result->getGameid();
//    echo "gameId:".$gameId;
//    echo '/n';
    util_log('gameId:'.$gameId);
//    echo "play_game_result:".$play_game_result;
    switch ($gameId){
        case 1:////布娃娃打僵尸游戏
            $getScore=$play_game_result->getValue1();
            $gameTime=$play_game_result->getValue2();
            $killSmall=$play_game_result->getValue3();
            $killBig=$play_game_result->getValue4();
            if($getScore>0){
                $taskIds="(300200)";
                update($taskIds,$getScore,$uid);
            }
            if($killSmall>0){
                $taskIds="(300205)";
                update($taskIds,$killSmall,$uid);
            }
            if($killBig>0){
                $taskIds="(300211)";
                update($taskIds,$killBig,$uid);
            }
            if($gameTime>0){
                $taskIds="(300215)";
                update($taskIds,$gameTime,$uid);
            }
            break;

        case 2:////太空射击游戏
            $getScore=$play_game_result->getValue1();//220-223
            $gameTime=$play_game_result->getValue2();//232-235
            $feiji=$play_game_result->getValue3();//228-231
            $yunshi=$play_game_result->getValue4();//224-227
            if($getScore>0){
                $taskIds="(300222)";
                update($taskIds,$getScore,$uid);
            }
            if($gameTime>0){
                $taskIds="(300235)";
                update($taskIds,$gameTime,$uid);
            }
            if($feiji>0){
                $taskIds="(300229)";
                update($taskIds,$feiji,$uid);
            }
            if($yunshi>0){
                $taskIds="(300226)";
                update($taskIds,$yunshi,$uid);
            }
            break;
        case 3://僵尸跑酷
            $getScore=$play_game_result->getValue1();//244-247
            $killJiangSi=$play_game_result->getValue3();//252-255
            $getYingBi=$play_game_result->getValue4();//248-251
            $juli=$play_game_result->getValue5();//240-243
            if($getScore>0){
                $taskIds="(300247)";
                update($taskIds,$getScore,$uid);
            }
            if($killJiangSi>0){
                $taskIds="(300254)";
                update($taskIds,$killJiangSi,$uid);
            }
            if($getYingBi>0){
                $taskIds="(300251)";
                update($taskIds,$getYingBi,$uid);
            }
            if($juli>0){
                $taskIds="(300243)";
                update($taskIds,$juli,$uid);
            }
            break;
        case 4://弓与箭
            $getScore=$play_game_result->getValue1();//260-263
            $baxin=$play_game_result->getValue3();//264-267
            if($getScore>0){
                $taskIds="(300263)";
                update($taskIds,$getScore,$uid);
            }
            if($baxin>0){
                $taskIds="(300267)";
                update($taskIds,$baxin,$uid);
            }
            break;
        case 5://泡泡消除
            $getScore=$play_game_result->getValue1();//272-275
            if($getScore>0){
                $taskIds="(300275)";
                update($taskIds,$getScore,$uid);
            }
            break;
        case 6://切水果
            $getScore=$play_game_result->getValue1();//280-283
            $fengkuang=$play_game_result->getValue5();//284-287
            $bingdong=$play_game_result->getValue6();//288-291
            $koufen=$play_game_result->getValue4();//292-295
            $gameTime=$play_game_result->getValue2();//296-299
            util_log('切水果收到数据:getScore:'.$getScore.',fengkuang:'.$fengkuang.',bingdong:'.$bingdong.',koufen:'.$koufen.',gameTime:'.$gameTime);
            if($getScore>0){
                $taskIds="(300283)";
                update($taskIds,$getScore,$uid);
            }
            if($fengkuang>0){
                $taskIds="(300285)";
                update($taskIds,$fengkuang,$uid);
            }
            if($bingdong>0){
                $taskIds="(300288)";
                update($taskIds,$bingdong,$uid);
            }
            if($koufen>0){
                $taskIds="(300295)";
                update($taskIds,$koufen,$uid);
            }
//            if($gameTime>0){
//                $taskIds="(300296,300297,300298,300299)";
//                update($taskIds,$gameTime,$uid);
//            }
            break;
    }
}
function update($taskIds,$value,$uid){
    //更新分数任务
    //查询任务
    $sql="select * from func_system.user_task where user_id=$uid and task_id in $taskIds ";
    $user_tasks=db_query($sql);
    global $tcp_worker;
    $tcp_worker->db->beginTrans();
    foreach ($user_tasks as $user_task) {
        echo "state:".$user_task['state'];
        util_log('state:'.$user_task['state']);
        if($user_task['state']==2){
            $newNum=$user_task['num']+$value;
            if($newNum>=$user_task['total']){
                $sql="update func_system.user_task set num=$user_task[total],state=3 where task_id=$user_task[task_id] and user_id=$uid";
                util_log("uid:$uid game task update!");
                //通知客户端更新
                send_update_task_state($uid,$user_task['task_id'],3,$user_task['total']);
            }else{
                $sql="update func_system.user_task set num=$newNum where task_id=$user_task[task_id] and user_id=$uid";
                send_update_task_state($uid,$user_task['task_id'],2,$newNum);
            }
            util_log("更新任务：".$sql);
            db_query($sql);
        }
    }
    if(!$tcp_worker->db->commitTrans())
    {
        $tcp_worker->db->rollBackTrans();
        //util_log('初始化任务列表失败：user_id:'.$user_id);
        return false;
    }
}

//发送任务列表
function get_user_task_list($user_id){
    //send task_list
    //判断用户是否有任务列表
    $sql="select count(id) total from func_system.user_task where user_id=".$user_id;
    $total=db_query($sql)[0]['total'];
    if($total==0){
        //查询是否有老任务
        global $tcp_worker;
        $tcp_worker->db->beginTrans();
        $task_cofigs=db_get_task_config();
        foreach ($task_cofigs as $task_config) {
//            echo "task_id".$task_config["task_id"];
//            echo '/n';
            $state=2;
            $done=0;
            if($task_config["task_id"]==300032){
                $state=3;
                $done=1;
            }
            $sql="insert into func_system.user_task (user_id,task_id,state,done,total,task_name_type) values($user_id,$task_config[task_id],$state,$done,$task_config[total],$task_config[task_name_type])";
            db_query($sql);
        }

        if(!$tcp_worker->db->commitTrans())
        {
            $tcp_worker->db->rollBackTrans();
            util_log('初始化任务列表1失败：user_id:'.$user_id);
            return false;
        }
    }
    //查询玩家是普通玩家还是代理
    $sql="select user_type from bolaik_user.`user_info` where user_id='$user_id'";
    $user=db_query($sql);
    $isNormal=$user[0]['user_type']==1?1:0;
    //get user_taskList
    $sql="select ut.times,tc.id,ut.user_id, ut.task_id, ut.state, ut.num done, tc.total,ut.total total1,tc.task_name,tc.task_content,tc.task_name_type,tc.task_skip_type,tc.skip,tc.u_coin_first,tc.u_coin_agent,tc.u_coin_normal from func_system.user_task ut,func_system.task_config tc where ut.task_id=tc.task_id and ut.state<4 and ut.user_id=".$user_id." order by ut.state desc";
    $allDatas=db_query($sql);
    foreach ($allDatas as $key=>$allData) {
        if($allData['total']!=$allData['total1']){
            $sql="update func_system.user_task set total=".$allData['total'] ." where user_id=$user_id and task_id=".$allData['task_id'];
            db_query($sql);
        }
        if($allData['task_id']==299999){
//            if($allData['times']>0){
//                if($isNormal){
                    $allDatas[$key]['u_coin']=$allData['u_coin_normal'];
//                }else{
                    $allDatas[$key]['gold_coin']=$allData['u_coin_agent'];
//                }
//            }else{
//                //还未完成第一次领奖
//                $allDatas[$key]['u_coin']=$allData['u_coin_first'];
//                $allDatas[$key]['gold_coin']=0;
//            }
        }else{
            $allDatas[$key]['u_coin']=$allData['u_coin_normal'];
            $allDatas[$key]['gold_coin']=0;
        }


    }
//    $allDatas=[];
    send_pack_user_task_list($user_id,true,$allDatas);
}

function mytime()
{
    \Workerman\Lib\Timer::add(1,function (){

    });
}
function util_log($str){
    file_put_contents('log.txt', $str."\n", FILE_APPEND | LOCK_EX);
}



