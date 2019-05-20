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
                $taskIds="(300200,300201,300202,300203)";
                update($taskIds,$getScore,$uid);
            }
            if($killSmall>0){
                $taskIds="(300204,300205,300206,300207)";
                update($taskIds,$killSmall,$uid);
            }
            if($killBig>0){
                $taskIds="(300208,300209,300210,300211)";
                update($taskIds,$killBig,$uid);
            }
            if($gameTime>0){
                $taskIds="(300212,300213,300214,300215)";
                update($taskIds,$gameTime,$uid);
            }
            $taskIds="(300216,300217,300218,300219)";
            update($taskIds,1,$uid);
            break;

        case 2:////太空射击游戏
            $getScore=$play_game_result->getValue1();//220-223
            $gameTime=$play_game_result->getValue2();//232-235
            $feiji=$play_game_result->getValue3();//228-231
            $yunshi=$play_game_result->getValue4();//224-227
            if($getScore>0){
                $taskIds="(300220,300221,300222,300223)";
                update($taskIds,$getScore,$uid);
            }
            if($gameTime>0){
                $taskIds="(300232,300233,300234,300235)";
                update($taskIds,$gameTime,$uid);
            }
            if($feiji>0){
                $taskIds="(300228,300229,300230,300231)";
                update($taskIds,$feiji,$uid);
            }
            if($yunshi>0){
                $taskIds="(300224,300225,300226,300227)";
                update($taskIds,$yunshi,$uid);
            }
            $taskIds="(300236,300237,300238,300239)";
            update($taskIds,1,$uid);
            break;
        case 3://僵尸跑酷
            $getScore=$play_game_result->getValue1();//244-247
            $killJiangSi=$play_game_result->getValue3();//252-255
            $getYingBi=$play_game_result->getValue4();//248-251
            $juli=$play_game_result->getValue5();//240-243
            if($getScore>0){
                $taskIds="(300244,300245,300246,300247)";
                update($taskIds,$getScore,$uid);
            }
            if($killJiangSi>0){
                $taskIds="(300252,300253,300254,300255)";
                update($taskIds,$killJiangSi,$uid);
            }
            if($getYingBi>0){
                $taskIds="(300248,300249,300250,300251)";
                update($taskIds,$getYingBi,$uid);
            }
            if($juli>0){
                $taskIds="(300240,300241,300242,300243)";
                update($taskIds,$juli,$uid);
            }
            $taskIds="(300256,300257,300258,300259)";
            update($taskIds,1,$uid);
            break;
        case 4://弓与箭
            $getScore=$play_game_result->getValue1();//260-263
            $baxin=$play_game_result->getValue3();//264-267
        echo "getScore:".$getScore.",baxin:".$baxin;
        echo '/n';
            if($getScore>0){
                $taskIds="(300260,300261,300262,300263)";
                update($taskIds,$getScore,$uid);
            }
            if($baxin>0){
                $taskIds="(300264,300265,300266,300267)";
                update($taskIds,$baxin,$uid);
            }
            $taskIds="(300268,300269,300270,300271)";
            update($taskIds,1,$uid);
            break;
        case 5://泡泡消除
            $getScore=$play_game_result->getValue1();//272-275
            if($getScore>0){
                $taskIds="(300272,300273,300274,300275)";
                update($taskIds,$getScore,$uid);
            }
            $taskIds="(300276,300277,300278,300279)";
            update($taskIds,1,$uid);
            break;
        case 6://切水果
            $getScore=$play_game_result->getValue1();//280-283
            $fengkuang=$play_game_result->getValue5();//284-287
            $bingdong=$play_game_result->getValue6();//288-291
            $koufen=$play_game_result->getValue4();//292-295
            $gameTime=$play_game_result->getValue2();//296-299
            util_log('切水果收到数据:getScore:'.$getScore.',fengkuang:'.$fengkuang.',bingdong:'.$bingdong.',koufen:'.$koufen.',gameTime:'.$gameTime);
            if($getScore>0){
                $taskIds="(300280,300281,300282,300283)";
                update($taskIds,$getScore,$uid);
            }
            if($fengkuang>0){
                $taskIds="(300284,300285,300286,300287)";
                update($taskIds,$fengkuang,$uid);
            }
            if($bingdong>0){
                $taskIds="(300288,300289,300290,300291)";
                update($taskIds,$bingdong,$uid);
            }
            if($koufen>0){
                $taskIds="(300292,300293,300294,300295)";
                update($taskIds,$koufen,$uid);
            }
            if($gameTime>0){
                $taskIds="(300296,300297,300298,300299)";
                update($taskIds,$gameTime,$uid);
            }
            $taskIds="(300300,300301,300302,300303)";
            update($taskIds,1,$uid);
            break;
    }
    $taskIds="(300031)";
    update($taskIds,1,$uid);
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
                file_put_contents('log.txt', "uid:$uid game task update!", FILE_APPEND | LOCK_EX);
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
        if($user_id<10000000){
            foreach ($task_cofigs as $task_config) {
                $state=2;
                $done=0;
                if($task_config["task_id"]>=300200&&$task_config["task_id"]<=300303){
                    $sql="insert into func_system.user_task (user_id,task_id,state,done,total,task_name_type) values($user_id,$task_config[task_id],$state,$done,$task_config[total],$task_config[task_name_type])";
                    db_query($sql);
                }else{
                    $sql="select state,done from func_system.user_task_beifen where uid=$user_id and task_id=$task_config[task_id]";
                    $old_user_task=db_query($sql);
                    $old_state=$old_user_task[0]['state'];
                    $num=$old_user_task[0]['done'];
                    if($old_state==5){
                        $state=4;
                    }else if($old_state==3){
                        $state=3;
                    }
                    $sql="insert into func_system.user_task (user_id,task_id,state,done,total,task_name_type,num,times) values($user_id,$task_config[task_id],$state,$done,$task_config[total],$task_config[task_name_type],$num,1)";
                    db_query($sql);
                }
            }
        }else{
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
    $sql="select ut.times,tc.id,ut.user_id, ut.task_id, ut.state, ut.num done, ut.total,tc.task_name,tc.task_content,tc.task_name_type,tc.task_skip_type,tc.skip,tc.u_coin_first,tc.u_coin_agent,tc.u_coin_normal from func_system.user_task ut,func_system.task_config tc where ut.task_id=tc.task_id and ut.state<4 and ut.user_id=".$user_id." order by ut.state desc";
    $allDatas=db_query($sql);
    foreach ($allDatas as $key=>$allData) {
        if(($allData['task_id']>=300000&&$allData['task_id']<=300021)||($allData['task_id']>=300090&&$allData['task_id']<=300112)){
            if($allData['times']>0){
//                if($isNormal){
                    $allDatas[$key]['u_coin']=$allData['u_coin_normal'];
//                }else{
                    $allDatas[$key]['gold_coin']=$allData['u_coin_agent'];
//                }
            }else{
                //还未完成第一次领奖
                $allDatas[$key]['u_coin']=$allData['u_coin_first'];
                $allDatas[$key]['gold_coin']=0;
            }
        }else{
            $allDatas[$key]['u_coin']=$allData['u_coin_normal'];
            $allDatas[$key]['gold_coin']=0;
        }


    }
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



