<?php
function redisInitRoom($playerIds,$channel,$channelNumber=-1){
    global $redis;
    //设置房间编号
    $tableId=$redis->incr('tableINCR');
    if($tableId<=1000000||$tableId>=10000000)
    {
        $redis->Set('tableINCR',1000000);
        $tableId=$redis->incr('tableINCR');
    }
    $redis->hSet($tableId,'channel',$channel);//房间类型
    //不同类型的房间
    switch ($channel){
        case 1:
            //经验
            $redis->hSet($tableId,'experienceLoser',100);
            $redis->hSet($tableId,'experienceSuccessor',200);
            //金币
            $redis->hSet($tableId,'baseScore',20);//底分
            $redis->hSet($tableId,'goldLimit',20000);//最高交易金币
            $redis->hSet($tableId,'rent',300);//房间使用费
            $redis->hSet($tableId,'capital',300);//最低本钱,锁定金币
            break;
        case 2:
            //经验
            $redis->hSet($tableId,'experienceLoser',400);
            $redis->hSet($tableId,'experienceSuccessor',800);
            //金币
            $redis->hSet($tableId,'baseScore',40);//底分
            $redis->hSet($tableId,'goldLimit',40000);//最高交易金币
            $redis->hSet($tableId,'rent',600);//房间使用费
            $redis->hSet($tableId,'capital',1000);//最低本钱,锁定金币
            break;
        case 3:
            //经验
            $redis->hSet($tableId,'experienceLoser',600);
            $redis->hSet($tableId,'experienceSuccessor',1600);
            //金币
            $redis->hSet($tableId,'baseScore',130);//底分
            $redis->hSet($tableId,'goldLimit',160000);//最高交易金币
            $redis->hSet($tableId,'rent',1600);//房间使用费
            $redis->hSet($tableId,'capital',10000);//最低本钱,锁定金币
            break;
        case 4:
            //私有频道需要私有编号
            $redis->hSet($tableId,'channelNumber',$channelNumber);
            //经验
            $redis->hSet($tableId,'experienceLoser',0);
            $redis->hSet($tableId,'experienceSuccessor',0);
            //金币
            $redis->hSet($tableId,'baseScore',20);//底分
            $redis->hSet($tableId,'goldLimit',160000);//最高交易金币
            $redis->hSet($tableId,'rent',0);//房间使用费
            $redis->hSet($tableId,'capital',0);//最低本钱,锁定金币
            break;
        default:
            //经验
            $redis->hSet($tableId,'experienceLoser',100);
            $redis->hSet($tableId,'experienceSuccessor',200);
            //金币
            $redis->hSet($tableId,'baseScore',20);//底分
            $redis->hSet($tableId,'goldLimit',20000);//最高交易金币
            $redis->hSet($tableId,'rent',300);//房间使用费
            $redis->hSet($tableId,'capital',300);//最低本钱,锁定金币
    }
    //房间玩家信息
    foreach ($playerIds as $playerId)
    {
        $redis->lPush($tableId.':playerIds',$playerId);
    }
    return $tableId;
}
function redisSetBeginner($tableId)
{
    global $redis;
    $random=mt_rand(0,2);
    for ($i=0;$i<$random;$i++)
    {
        $redis->rpoplpush($tableId.':playerIds', $tableId.':playerIds');
    }
}
function redisInitGame($tableId)
{
    global $redis;
    $redis->hIncrBy($tableId,'repeat',1);//游戏重复次数标记
    $redis->hSet($tableId,'ratio',0);//房间输赢方，1地主，-1农民，0还没结果
    $redis->hSet($tableId,'times','1');//房间倍数 ？和赔率重复
    $redis->hSet($tableId,'dizhugongqi','1');//地主红旗存在
    $redis->hSet($tableId,'beginTime','123');//游戏开始时间
    $redis->hSet($tableId,'timer_type','123');//当前时间类型
    $redis->hSet($tableId,'tick','1');//步次
    $redis->hSet($tableId,'turnerId','');
    $redis->hSet($tableId,'turner_beginTime','');//当前玩家开始时间
    $redis->hSet($tableId,'currant_value_owner','');//当前权力所有者
    $redis->hSet($tableId,'dizhu','');//地主id
    $redis->hSet($tableId,'game_start_time',time());//地主id
    $redis->sUnionStore($tableId.':cards','cardsModel',null);//牌
}
function redisInitPlayers($playerIds,$table_id){

    global $redis;
    foreach ($playerIds as $playerId)
    {
        $redis->delete($playerId.':cards');//牌
        // $redis->hSet($playerId,'role',$_SESSION('role'));
        // $redis->hSet($playerId,'role_level',$_SESSION('role_level'));
        //玩家身份标识，如果是1在线，且在房间中，如果是2在线且不在房间中，如果是3不在线且在房间中，，如果是4不房间中，如果不存在，则是没有游戏
        $redis->hSet($playerId,'status','1');
        $redis->hSet($playerId,'chance','1');
        $redis->hSet($playerId,'chuntianChance','1');
        $redis->hSet($playerId,'roomId',$table_id);
        $cardsId=$redis->incr('CardsINCR');
        $redis->hSet($playerId,'cards',$cardsId);
        $otherId=$redis->incr('otherINCR');
        $redis->hSet($playerId,'otherINCR',$otherId);
    }
}