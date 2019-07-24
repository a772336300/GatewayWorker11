<?php
use GatewayWorker\Lib\Gateway;
use Proto\Room_Type;
use Proto\Play_Data_Type;
use Workerman\Lib\Timer;
$waitingUser=array();
function game_join($client_id,$join)
{
    global $redis;
    global $waitingUser;

    if(!isset($_SESSION['uid']))
    {
        send_notice_by_client_id($client_id,1,"用户id错误");
        util_log("用户id错误！error：3000");
        return;
    }
    $playerId=$_SESSION['uid'];

    $gold=game_db_get_gold($playerId);
    if($redis->exists($playerId))
    {
        //如果当前角色和代理角色不一致,返回不能游戏
        //已经进去了房间，但需要获取房间信息
        //个人手牌信息，
        //其他玩家状态，
        //出牌记录
        //等等
        $redis->hSet($playerId,'connection',1);
        $roomId=$redis->hget($playerId,'roomId');
        Gateway::joinGroup($client_id,$roomId);
        //发送手牌到客户端
        $cards=$redis->Smembers($playerId.':cards');
        $cards=implode(',',$cards);
        game_send_cards($client_id,$cards);
        //Events::sendOutByProtectChannel($playerId,'selfCards','initCards','system',$cards);
        //房间信息
        $init=roomInfo($roomId);
        game_send_room_init($init,$roomId,$client_id);
        return ;
    }
    else
    {
        //遍历匹配数组队列，如果存在其中则返回已在匹配中
        foreach($waitingUser as $waitingUserItem)
            if(in_array($_SESSION['uid'],$waitingUserItem))
            {
                send_notice_by_client_id($client_id,1,"已在匹配中");
                //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"已在匹配中");
                return ;
            }
        switch ($join->getType())
        {
            //判断金币
            //加入等待队列
            case Room_Type::chuji:
                if($gold<300)
                {
                    send_notice_by_client_id($client_id,1,"金币不足");
                    //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                    return ;
                }
                game_db_lock_gold($playerId,300);
                $waitingUser[Room_Type::chuji][]=$_SESSION['uid'];
                break;
            case Room_Type::zhongji:
                if($gold<1000)
                {
                    send_notice_by_client_id($client_id,1,"金币不足");
                    //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                    return ;
                }
                game_db_lock_gold($playerId,300);
                $waitingUser[Room_Type::zhongji][]=$_SESSION['uid'];
                break;
            case Room_Type::gaoji:
                if($gold<10000)
                {
                    send_notice_by_client_id($client_id,1,"金币不足");
                    //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                    return ;
                }
                game_db_lock_gold($playerId,300);
                $waitingUser[Room_Type::gaoji][]=$_SESSION['uid'];
                break;
            case 4:
                $roomId=10000;
                $waitingUser[$roomId][]=$_SESSION['uid'];
                Events::sendOutByProtectChannel($_SESSION['uid'],'table','readying','system','等待其他玩家');
                if(count($waitingUser[$roomId])==3)
                {
                    roomInit($waitingUser[$roomId],4,$roomId);
                    $waitingUser[4]=array();
                }
                break;
            default:
                send_notice_by_client_id($client_id,1,"房间类型错误");
                //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"请求房间类型错误");
                return ;
        }
        game_send_join($client_id,$join->getType());
        //Events::sendOutByProtectChannel($_SESSION['uid'],'table','Join','system','等待其他玩家');
        if($join->getType()!=4&&count($waitingUser[$join->getType()])==3)
        {
            roomInit($waitingUser[$join->getType()],$join->getType());
            $waitingUser[$join->getType()]=array();
        }
        if(count($waitingUser[$join->getType()])>=3)
        {
            util_log("系统错误！error：3001");
            die();
        }
    }
}
function game_quit_join($client_id,$quit_join=null)
{
    global $waitingUser;
    //遍历匹配队列
    foreach($waitingUser as $key=>$value)
        if(($index=array_search($_SESSION['uid'],$waitingUser[$key]))!==false)
        {
            unset($waitingUser[$key][$index]);
            game_send_quit_join($client_id,$quit_join->getType());
            return ;
        }
        else
        {
            send_notice_by_client_id($client_id,1,"错误111");
            return ;
        }
}
function roomInfo($roomId)
{
    global $redis;
    $init=array();
    $playerIds=$redis->lRange($roomId.':playerIds',0,-1);
    $init['type']=$redis->hGet($roomId,'channel');
    $init['dizhu']=$redis->hGet($roomId,'dizhu');
    if($redis->hGet($roomId,'times'))
        $init['times']=$redis->hGet($roomId,'times');
    else
        $init['times']=null;
    if($redis->hGet($roomId,'game_start_time'))
        $init['gameStartTime']=$redis->hGet($roomId,'game_start_time');
    else
        $init['gameStartTime']=null;
    $init['currentValue'] = json_decode($redis->hGet($roomId,'currentValue'),true);
    if($redis->sCard($roomId.':cards')==3)
    {
        if($init['currentValue']['type']==Play_Data_Type::pai)
            $init['bottomCards']=$redis->sMembers($roomId.':cards');
        else
            $init['bottomCards']=null;
    }
    else
        $init['bottomCards']=null;
    foreach($playerIds as $playerId)
    {
        $init['playerInfo'][$playerId]['id']=$redis->hGet('info_'.$playerId,'id');
        $init['playerInfo'][$playerId]['step']=$redis->hGet('info_'.$playerId,'step');
        $init['playerInfo'][$playerId]['name']=$redis->hGet('info_'.$playerId,'name');
        $init['playerInfo'][$playerId]['gold']=$redis->hGet('info_'.$playerId,'gold');
        $init['playerInfo'][$playerId]['touxiang']=$redis->hGet('info_'.$playerId,'touxiang');
        $init['playerInfo'][$playerId]['level']=$redis->hGet('info_'.$playerId,'level');

        $init['playerInfo'][$playerId]['cardsCount']=$redis->sCard($playerId.':cards');
    }
    $init['playerIds']=$playerIds;
    if($redis->hGet($roomId,'turnerId')!='')
    {
        $init['turnerId']=$redis->hGet($roomId,'turnerId');
        $init['turnerLeftTime']=15+$redis->hGet($roomId,'turner_beginTime')-time();
    }
    else
    {
        $init['turnerId']=null;
        $init['turnerLeftTime']=null;
    }
    // $compareValue=$redis->hGet($roomId,'compareValue');
    //$compareValue=json_decode($compareValue,true);
    $init['currentValueOwner']=$redis->hGet($roomId,'currant_value_owner');
    return $init;
}
function roomInit($playerIds,$channel,$channelNumber=-1)
{
    global $redis;
    // TODO: Implement onmessage() method.
    //有状态
    shuffle($playerIds);
    $roomId=roomCreate($playerIds,$channel,$channelNumber);
    echo "房间创建成功\r\n";
    //设置房间消息发送器
    foreach ($playerIds as $playerId)
    {
        $client_ids=Gateway::getClientIdByUid($playerId);
        foreach ($client_ids as $client_id)
            Gateway::joinGroup($client_id,$roomId);
    }
    //房间初始化的信息
    //房间信息
    $init=roomInfo($roomId);
    game_send_room_init($init,$roomId);
    $redis->hSet($roomId,'open','1');
    GameStart($roomId,$playerIds);
}
function roomCreate($playerIds,$channel,$channelNumber=-1)
{

    return redisInitRoom($playerIds,$channel,$channelNumber);

}
function GameStart($roomId,$playerIds)
{
    //设置先出牌者
    //redisSetBeginner($roomId);
    //游戏信息初始化
    redisInitGame($roomId);
    //玩家游戏信息初始化
    redisInitPlayers($playerIds,$roomId);
    //洗牌
//    //#test
//    cardSend($roomId);
//    //$redis->hSet($roomId,'xCardController','1');
//    initRoomState($roomId,array('type'=>Play_Data_Type::jiaodizhu,'data'=>0),array('type'=>Play_Data_Type::jiaodizhu,'data'=>0));
//    roomTick($roomId,0,12);
//    //#test
    Timer::add(3, function()use($roomId,$playerIds)
    {
        //发牌
        Timer::add(3, function()use($roomId,$playerIds)
        {
            cardSend($roomId);
            //$redis->hSet($roomId,'xCardController','1');
            initRoomState($roomId,array('type'=>Play_Data_Type::jiaodizhu,'data'=>0),array('type'=>Play_Data_Type::jiaodizhu,'data'=>0));
            roomTick($roomId,0);

        },array(),false);
    },array(),false);
}
function cardSend($roomId)
{
    global $redis;
    $playerIds=$redis->lRange($roomId.':playerIds',0,-1);

    $cardsLeaved=$redis->Smembers($roomId.':cards');
    //洗牌一次
    shuffle($cardsLeaved);
    //根据剩余几张牌，插入到相应玩家(第二次发牌)
    $begin=0;
    foreach($playerIds as $playerId)
    {
        $redis->delete($playerId.':cards');
        $scope=$begin+17;
        //剩余几张牌，假设为16
        for($i=$begin;$i<$scope;$i++)
        {
            //从牌池移动到手牌
            $redis->sMove($roomId.':cards',$playerId.':cards',$cardsLeaved[$i]);
        }
        $begin=$scope;
        $cards=$redis->Smembers($playerId.':cards');
        $cards=implode(',',$cards);
        game_send_cards_by_uid($playerId,$cards);
    }

}
function initRoomState($roomId,$compareValue,$currentValue)
{
    global $redis;
    $redis->hSet($roomId,'compareValue',json_encode($compareValue));
    $redis->hSet($roomId,'currentValue',json_encode($currentValue));
}
function roomTick($roomId,$times,$timeSecond=1000000000000)
{
    global $redis;
    $tick=$redis->hIncrBy($roomId,'tick',$times);
    $turnerId=$redis->lIndex($roomId.':playerIds',($tick-1)%3);
    echo "轮到$turnerId\r\n";
    $redis->hSet($roomId,'turnerId',$turnerId);
    $redis->hSet($roomId,'turner_beginTime',time());

    if($redis->hGet($roomId,'currant_value_owner')==$redis->hGet($roomId,'turnerId')){
        $redis->hSet($roomId,'compareValue','{"type":'.Play_Data_Type::pai.',"data":{}}');
        $redis->hSet($roomId,'currentValue','{"type":'.Play_Data_Type::pai.',"data":""}');
    }
    $repeat = $redis->hGet($roomId,'repeat');
//    //#test
//    timerTrigger($repeat,$tick,$roomId);
//    //#test
    Timer::add($timeSecond, function()use($roomId,$repeat,$tick)
    {
        timerTrigger($repeat,$tick,$roomId);
    },array(),false);
    //game_send_turn($turnerId);
}
function timerTrigger($repeat,$currantTick,$roomId)
{
    global $redis;
    $compareValue = $redis->hGet($roomId,'compareValue');
    $compareValue = json_decode($compareValue,true);
    //获取当前出牌者
    $turnerId=$redis->hGet($roomId,'turnerId');
    //判断之前的步数是否已经走过
    if($repeat==$redis->hGet($roomId,'repeat')&&$currantTick==$redis->hGet($roomId,'tick'))
    {
        //如果没有走过，触发触发器
        //如果没有叫地主，则不叫地主
        if($compareValue['type']==Play_Data_Type::jiaodizhu&&$compareValue['data']==0){
            roomTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::jiaodizhu,'data'=>1));
        }
        else
            //如果时抢地主，则不抢
            if($compareValue['type']==Play_Data_Type::jiaodizhu||$compareValue['type']==Play_Data_Type::qiangdizhu){
                roomTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::qiangdizhu,'data'=>0));
            }
            else
                //如果是出牌
                if($compareValue['type']==Play_Data_Type::pai)
                {
                    //如果当前牌权是本人者出最小的一张牌
                    if ($redis->hGet($roomId, 'currant_value_owner') == $turnerId)
                    {
                        //@@获取手牌最小值
                        $data=preg_replace('/[rwyb*]/','',$redis->sMembers($turnerId.':cards'));
                        $begin = min($data);
                        $cards=null;
                        if($redis->sIsMember($turnerId.':cards','r'.$begin))
                            $cards='r'.$begin;
                        if($redis->sIsMember($turnerId.':cards','w'.$begin))
                            $cards='w'.$begin;
                        if($redis->sIsMember($turnerId.':cards','y'.$begin))
                            $cards='y'.$begin;
                        if($redis->sIsMember($turnerId.':cards','b'.$begin))
                            $cards='b'.$begin;
                        if($redis->sIsMember($turnerId.':cards','*'.$begin))
                            $cards='*'.$begin;
                        if($cards==null)
                        {
                            var_dump('自动出牌错误');
                            return ;
                        }
                        $value = array('type' => Play_Data_Type::pai, 'data' => $cards);
                        $valueCode =  ['type' => ['X' => 1, 'Y' => 0], 'begin' => $begin, 'wings' => array()];
                        roomTrigger($turnerId, $roomId, $value,$valueCode);
                    }
                    else
                    {
                        //取出最小牌
                        //if($compareValue['data']==null)
                        //{
                        //    Events::sendOutByProtectChannel($playerId, 'systemMessage', 'error', $playerId, '系统错误,当前牌拥有者出牌为空');
                        //    return;
                        //}
                        //$result=biggerCards($redis->sMembers($turnerId.':cards'),$compareValue['data']);
                        //if($result==null)
                        //    spaceTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::pai,'data'=>null));
                        //else
                        //    spaceTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::pai,'data'=>$result['body']),$result['code']);
                        roomTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::pai,'data'=>null));
                    }

                }
                //如果当前牌权不是本人则不出
                //如果比较牌有错误，则不出
                else
                    roomTrigger($turnerId,$roomId,array('type'=>Play_Data_Type::pai,'data'=>null));

    }
}
function roomTrigger($playerId,$roomId,$value,$valueCode=null)
{
    //划分出牌类型
    switch ($value['type'])
    {
        case Play_Data_Type::jiaodizhu:
            jiaodizhu($playerId,$roomId,$value,$valueCode);

            break;
        case Play_Data_Type::qiangdizhu:
            qiangdizhu($playerId,$roomId,$value,$valueCode);

            break;
        case Play_Data_Type::pai:
            pai($playerId,$roomId,$value,$valueCode);
            break;
        //$room->times=$room->times*2
        default:
            send_notice($playerId,1,"时间类型错误");

    }
}
function jiaodizhu($playerId,$roomId,$value,$valueCode=null)
{
    global $redis;
    //叫地主类型
    //说明还没人叫地主
    if ($value['data']){

        $redis->hSet($playerId, 'chance', false);
        //当前玩家权值及游戏其他信息更改
        //设置当前值所有者为当前出牌玩家
        if($redis->hGet($roomId,'times')<$value['data'])
        {
            $redis->hSet($roomId,'times',$value['data']);
        }

        $redis->hSet($roomId, 'currant_value_owner', $playerId);
        //设置地主为当前出牌玩家
        $redis->hSet($roomId, 'dizhu', $playerId);
        //下家是否有抢地主机会
        //如果没有，说明走了一圈只有本人叫 ，跳过抢地主，开始发牌
        //获取当前玩家的下一家
        $tick = $redis->hGet($roomId, 'tick');
        //通过步数和玩家队列来判断轮到谁
        $NextId = $redis->lIndex($roomId . ':playerIds', ((int)$tick) % 3);
        if ($redis->hGet($NextId, 'chance') == false||$value['data']==3) {
            beginPlayCard($playerId, $roomId, 3);
        } else {
            game_send_play($roomId,$playerId,Play_Data_Type::jiaodizhu,$value['data']);
            initRoomState($roomId,$value,$value);
            roomTick($roomId, 1);
        }

    } else {
        //当前玩家权值及游戏其他信息更改
        $redis->hSet($playerId, 'chance', false);
        //下家是否有抢地主机会
        //如果没有，说明走了一圈没人叫
        $tick = $redis->hGet($roomId, 'tick');
        //通过步数和玩家队列来判断轮到谁
        $NextId = $redis->lIndex($roomId . ':playerIds', ((int)$tick) % 3);
        //不叫
        game_send_play($roomId,$playerId,Play_Data_Type::jiaodizhu,0);
        if ($redis->hGet($NextId, 'chance') == false)
        {
            //没人叫地主重新发牌重新选人
            if($redis->hGet($roomId,'repeat')>=10)
            {
                gameOver($roomId);
            }
            else
            {
                GameStart($roomId, $redis->lRange($roomId . ':playerIds', 0, -1));
            }
        }
        else//如果下家有机会，当前玩家关闭，轮转玩家
        {
            initRoomState($roomId,$value,$value);
            roomTick($roomId,1);
        }

    }
}
function qiangdizhu($playerId,$roomId,$value,$valueCode=null)
{
    global $redis;
    //抢地主类型
    //已经有人叫地主
    //自己是否还有机会，有说明没不叫过地主或没不抢过地主
    if ($redis->hGet($playerId, 'chance'))
    {
        //如果抢地主
        if ($value['data']) {
            //当前玩家权值及游戏其他信息更改
            $redis->hSet($roomId, 'dizhu', $playerId);
            $redis->hSet($roomId, 'currant_value_owner', $playerId);
            $redis->hIncrBy($roomId, 'times', 2);
            //机会被使用
            $redis->hSet($playerId, 'chance', false);

            game_send_play($roomId,$playerId,Play_Data_Type::qiangdizhu,1);
            //房间倍数增加
            //Events::sendOutByPublicChannel($roomId,'xx','timesAdd','system',2);
            $redis->hSet($roomId,'times',$redis->hGet($roomId,'times')*2);
            /*setCompareValue($spaceRoom,array());
            app1_spaceinputmastar::onSpaceMessage('group','叫地主',spaceData::$data['index']);*/
            //走哪一步，如果是叫地主的玩家抢地主，则是最后一个抢地主，如果不是叫地主玩家抢地主则查找下一玩家是否有抢地主机会
            $isEnd = true;
            for ($i = 1; $i < 3; $i++) {
                $tick = $redis->hGet($roomId, 'tick');
                //通过步数和玩家队列来判断轮到谁
                $NextId = $redis->lIndex($roomId . ':playerIds', ((int)$tick + $i) % 3);
                if ($redis->hGet($NextId, 'chance') == true) {
                    $isEnd = false;
                    initRoomState($roomId,$value,$value);
                    roomTick($roomId,  $i);
                    break;
                }
            }
            if ($isEnd) {
                beginPlayCard($playerId, $roomId, 3);
            }

        } else {
            //当前玩家权值及游戏其他信息更改
            $redis->hSet($playerId, 'chance', false);

            game_send_play($roomId,$playerId,Play_Data_Type::qiangdizhu,0);
            $isEnd = true;
            for ($i = 1; $i < 3; $i++)
            {
                $tick = $redis->hGet($roomId, 'tick');
                //通过步数和玩家队列来判断轮到谁
                $NextId = $redis->lIndex($roomId . ':playerIds', ((int)$tick + $i) % 3);
                if ($redis->hGet($NextId, 'chance') == true)
                {
                    $isEnd = false;
                    //如果即是地主又有机会，则是叫地主玩家，且没人抢，默认它就是地主，直接进入出牌阶段
                    if ($NextId == $redis->hGet($roomId, 'dizhu'))
                    {
                        $isEnd = true;
                        beginPlayCard($NextId, $roomId, $i);
                        break;
                    }
                    initRoomState($roomId,json_decode($redis->hGet($roomId, 'compareValue'), true),json_decode($redis->hGet($roomId, 'currentValue'), true));
                    roomTick($roomId,$i);
                    break;
                }
                if ($NextId == $redis->hGet($roomId, 'dizhu'))
                {
                    beginPlayCard($NextId, $roomId, $i);
                    $isEnd = true;
                    break;
                }
            }
        }
    } else
        game_send_play($roomId,$playerId,Play_Data_Type::qiangdizhu,1);
}
function pai_type_for_task($valueCode)
{
    global $task_type;
    if($valueCode['type']['X']==3&&$valueCode['type']['Y']>=1)
    {
        return 'feiJi';
    }
    if(isG($valueCode))
    {
        return 'zhaDan';
    }
    if(isP($valueCode))
    {
        return 'huoJian';
    }
    if($valueCode['type']['Y']==11)
    {
        return $task_type['3DaoAShunZi'];
    }
    if($valueCode['type']['X']==3&&$valueCode['type']['Y']>=0&&$valueCode['wings']!=null)
    {
        return 'sanDaiYi';
    }
    return null;
}
function pai($playerId,$roomId,$value,$valueCode=null)
{
    global $redis;
    //出牌类型
    if ($value['data'] != null)
    {
        if (changeCard($playerId, $roomId, $value['data']))
        {
            if(($type=pai_type_for_task($valueCode))!==null)
            {
                game_set_tack($playerId,$type);
            }
//            if(!$redis->hGet($roomId, 'xCardController'))
//            {
//                $redis->hSet($playerId, 'xCardController','0');
//            }
            //玩家打出牌
            //不是,当前牌权所有者是否是自己,不是,当前牌权所有者有春天就改为没有春天
            $currant_value_owner=$redis->hGet($roomId, 'currant_value_owner');
            if($currant_value_owner!=$playerId&&$redis->hGet($currant_value_owner, 'chuntianChance'))
            {
                $redis->hSet($currant_value_owner, 'chuntianChance', '0');
            }
            //牌是否出完,没出完改下家
            game_send_play($roomId,$playerId,Play_Data_Type::pai,$value['data']);
            if ($redis->sGetMembers($playerId . ':cards') == array())
            {
                if($redis->hGet($playerId, 'chuntianChance'))
                {
                    // Events::sendOutByPublicChannel($roomId,'xx','chuntian','system','春天');
                    // Events::sendOutByPublicChannel($roomId,'xx','timesAdd','system',2);
                    $redis->hSet($roomId,'times',$redis->hGet($roomId,'times')*2);
                }
                gameOver($roomId, $playerId);
            }
            else
            {
                $redis->hSet($roomId, 'currant_value_owner', $playerId);
                initRoomState($roomId,['type' => Play_Data_Type::pai, 'data' => $valueCode],$value);
                roomTick($roomId, 1);
            }

        }
        else
            send_notice($playerId,1,"出牌错误");
    }
    else
    {
        if ($redis->hGet($roomId, 'currant_value_owner') == $playerId)
            send_notice($playerId,1,"需要出牌");
        else {
            game_send_play($roomId,$playerId,Play_Data_Type::pai,null);
            //玩家不出比较不变
            roomTick($roomId, 1);
        }
    }
}
function beginPlayCard($dizhu,$roomId,$times)
{
    global $redis;
    $cards=$redis->sMembers($roomId.':cards');
    //bottomCardTimes($roomId,$cards);
    $cards=implode(',',$cards);
    game_send_bottom_cards($roomId,$cards,$dizhu);
    $redis->sUnionStore($dizhu.':cards',$dizhu.':cards',$roomId.':cards');
    initRoomState($roomId,array('type'=>Play_Data_Type::pai,'data'=>array()),array('type'=>Play_Data_Type::pai,'data'=>''));
    roomTick($roomId,$times);
}
function gameOver($roomId,$winner=null)
{
    global $redis;
    $result=array();
    if($winner!=null)
    {
        //添加获胜者
        if($winner==$redis->hGet($roomId,'dizhu'))
        {
            $redis->hSet($roomId,'ratio',1);
        }
        else
        {
            $redis->hSet($roomId,'ratio',-1);
        }
        $result=experienceAndGold($roomId);

    }
    game_send_game_result($roomId,$result);
    // Gateway::leaveGroup();
    $playerIds=$redis->lRange($roomId.':playerIds',0,-1);
    $redis->multi(\Redis::PIPELINE);
    $redis->delete($roomId);
    $redis->delete($roomId.':playerIds');
    $redis->delete($roomId.':cards');
    foreach ($playerIds as $playerId)
    {
        $redis->delete($playerId);
        $redis->delete($playerId.':cards');
    }
    $redis->exec();
}
function experienceAndGold($roomId)
{
    global $redis;
    $result=array();
    $players=$redis->lRange($roomId.':playerIds',0,-1);
    $ratio=$redis->hGet($roomId,'ratio');
    $dizhu=$redis->hGet($roomId,'dizhu');
    foreach ($players as $player)
    {
        $result[$player]['level']=100;
        $result[$player]['cardsLeft']=100;
        if($player==$dizhu)
        {
            $result[$player]['gold']=100*$ratio;
            continue;
        }
        $result[$player]['gold']=(-1)*100*$ratio;

    }
    return $result;

}
//function experienceAndGold($roomId,$winner)
//{
//    global $redis;
//    //经验是由房间频道和赢输家玩家决定的
//    //经验
//    $experience=0;
//    //失败玩家经验
//    $experienceLoser=0;
//    //成功玩家经验
//    $experienceSuccessor=0;
//    //底分
//    $baseScore=0;
//    //金币顶值,输的值
//    $goldLimit=0;
//
//    //获取房间类型
//    //倍数
//    $goldResult=array();
//    $times=$redis->hGet($roomId,'times');
//    $channel=$redis->hGet($roomId,'channel');
//    switch ($channel)
//    {
//        case '1':
//            $recordBar='primary_record';
//            break;
//        case '2':
//            $recordBar='medium_record';
//            break;
//        case '3':
//            $recordBar='senior_record';
//            break;
//        default:
//            $recordBar='primary_record';
//            break;
//    }
//    $baseScore=$redis->hGet($roomId,'baseScore');
//    $goldLimit=$redis->hGet($roomId,'goldLimit');
//    $experienceLoser=$redis->hGet($roomId,'experienceLoser');
//    $experienceSuccessor=$redis->hGet($roomId,'experienceSuccessor');
//    $rent=$redis->hGet($roomId,'rent');
//    /* //底牌数
//     $baseCardsTimes=0;
//     //抢地主数
//     $bTimes=0;
//     //炸弹数
//     $zadanTimes=0;
//     //皇炸数
//     $huojianTiems=0;
//     $goldBase=$baseScore*($baseCardsTimes+$bTimes*2+$zadanTimes*2+$huojianTiems*2);*/
//    //or
//    //交易金币，系统设置为偶数
//    $goldTransaction=$baseScore*$times*2;
//    if($goldTransaction>$goldLimit)
//        $goldTransaction=$goldLimit;
//    $ratio=$redis->hGet($roomId,'ratio');
//    $players=$redis->lRange($roomId.':playerIds',0,-1);
//    $dizhu=$redis->hGet($roomId,'dizhu');
//    //须先扣除输家金币
//    //附加游戏次增加
//    //赢次数增加
//    foreach ($players as $player)
//    {
//        game_db_user_win_count_incr($player,1);
//        $role=$redis->hGet($player,'role');
//        $roleLevel=$redis->hGet($player,'role_level');
//        $agentIdentifier=$player.'_'.$role;
//        //如果农民输，当前是农民
//        //经验，金钱
//        if($ratio&&$player!=$dizhu)
//        {
//
//            //如果是-3-1 4 -1
//            // y=x+z x<0,z=-1 -1 x>=0,z=-1
//            //y=x+z x>0,z=1 1 x<=0,z=1
//            //输家游戏次数增加，还有连胜结束如果查看当前连胜次数当前连胜次和历史连胜次数，如果当前大于历史则更新历史，如果当前小于历史当前连胜为0
//            // Events::$db->query('update `person` set game_count=game_count+1 WHERE identifier=\''.$player.'\'');
//            //获取剩余金币，lock??
//            $goldCut=0;
//            $person=game_db_get_user_game_info($player,$recordBar);
//            if($person[$recordBar]>=0)
//            {
//                Events::$db->query("update `person` set $recordBar=-1 WHERE identifier='$player'");
//            }
//            else
//            {
//                Events::$db->query("update `person` set $recordBar=$recordBar-1 WHERE identifier='$player'");
//            }
//            $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            //经验对等级的影响
//            //每次经验的增加都会触发等级的增加，验证等级是否增加
//            //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
//            if($person['game_experience']+$experienceLoser>=$person['step']*1000)
//            {
//                $goldResult[$player]['levelUp']=true;
//                Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
//            }
//            else
//            {
//                Events::$db->query('update `person` set game_experience=game_experience+'.$experienceLoser.' WHERE identifier=\''.$player.'\'');
//            }
//            if($person_agent['experience']+$experienceLoser>=$person_agent['step']*1000)
//            {
//                $goldResult[$player]['roleLevelUp']=true;
//                Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            else
//            {
//                Events::$db->query("update `person_agent` set experience=experience+'$experienceLoser' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            if($person['gold']<$goldTransaction/2)
//            {
//                $goldCut=$person['gold'];
//            }
//            else
//                $goldCut=$goldTransaction/2;
//            //@@执行数据库金币修改
//            $goldResult[$player]['goldTransaction']=$goldCut*(-$ratio);
//            $goldResult[$player]['experience']=$experienceLoser;
//            $goldResult[$player]['times']=-$times;
//            $goldResult[$player]['cardsLeft']=$redis->sMembers($player.':cards');
//            //数据库修改金币和经验
//            //$personId=strstr( $player, '_',true);
//            $personId=$player;
//            //$role=strstr( $player, '_');
//            Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold+'.$goldCut*(-$ratio).' WHERE identifier=\''.$personId.'\'');
//            //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceLoser.'  WHERE identifier=\''.$personId.'\'');
//            //  $sql='INSERT INTO `person_'.$role.'` (identifier, experience) values(\''.$personId.'\',\''.$experienceLoser.'\') ON DUPLICATE KEY UPDATE experience=experience+'.$experienceLoser;
//            // Events::$db->query('update `person_agent` set (identifier, experience) values(\''.$personId.'\',\''.$experienceLoser.'\') ON DUPLICATE KEY UPDATE experience=experience+'.$experienceLoser);
//
//            //检验是否升级
//
//        }
//        //如果地主输,当前是地主
//        if($ratio==-1&&$player==$dizhu)
//        {
//            //输家游戏次数增加，还有连胜结束如果查看当前连胜次数当前连胜次和历史连胜次数，如果当前大于历史则更新历史，如果当前小于历史当前连胜为0
//            //获取剩余金币
//            $goldCut=0;
//            $person=Events::$db->row("SELECT gold,game_experience,step,$recordBar FROM `person` WHERE identifier='$player'");
//            if($person[$recordBar]>=0)
//            {
//                Events::$db->query("update `person` set $recordBar=-1 WHERE identifier='$player'");
//            }
//            else
//            {
//                Events::$db->query("update `person` set $recordBar=$recordBar-1 WHERE identifier='$player'");
//            }
//            $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            //经验对等级的影响
//            //每次经验的增加都会触发等级的增加，验证等级是否增加
//            //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
//            if($person['game_experience']+$experienceLoser>=$person['step']*1000)
//            {
//                $goldResult[$player]['levelUp']=true;
//                Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
//            }
//            else
//            {
//                Events::$db->query('update `person` set game_experience=game_experience+'.$experienceLoser.' WHERE identifier=\''.$player.'\'');
//            }
//            if($person_agent['experience']+$experienceLoser>=$person_agent['step']*1000)
//            {
//                $goldResult[$player]['roleLevelUp']=true;
//                Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            else
//            {
//                Events::$db->query("update `person_agent` set experience=experience+'$experienceLoser' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            if($person['gold']<$goldTransaction)
//            {
//                //如果是
//                if($person['gold']%2)
//                    $goldCut=$person['gold']-1;
//                else
//                    $goldCut=$person['gold'];
//            }
//            else
//                $goldCut=$goldTransaction;
//            //@@执行数据库金币修改
//            $goldResult[$player]['goldTransaction']=$goldCut*$ratio;
//            $goldResult[$player]['experience']=$experienceLoser;
//            $goldResult[$player]['times']=-$times*2;
//            $goldResult[$player]['cardsLeft']=$redis->sMembers($player.':cards');
//            //数据库修改金币和经验
//            $personId=strstr( $player, '_',true);
//            $role=strstr( $player, '_');
//            Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold+'.$goldCut*(-$ratio).' WHERE identifier=\''.$personId.'\'');
//            //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceLoser.'  WHERE identifier=\''.$personId.'\'');
//            //检验是否升级？
//        }
//    }
//    //输家金币给与赢家
//    $goldSum=array_sum($goldResult);
//    foreach ($players as $player)
//    {
//        //如果农民输，当前是地主
//        if($ratio&&$player==$dizhu)
//        {
//
//
//            $person=Events::$db->row("SELECT game_record,game_record_old,game_experience,step,$recordBar FROM `person` WHERE identifier='$player'");
//            $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            //经验对等级的影响
//            //每次经验的增加都会触发等级的增加，验证等级是否增加
//            //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
//            if($person['game_experience']+$experienceSuccessor>=$person['step']*1000)
//            {
//                $goldResult[$player]['levelUp']=true;
//                Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
//            }
//            else
//            {
//                Events::$db->query('update `person` set game_experience=game_experience+'.$experienceSuccessor.' WHERE identifier=\''.$player.'\'');
//            }
//            if($person_agent['experience']+$experienceSuccessor>=$person_agent['step']*1000)
//            {
//                $goldResult[$player]['roleLevelUp']=true;
//                Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            else
//            {
//                Events::$db->query("update `person_agent` set experience=experience+'$experienceSuccessor' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//
//
//            if(($person[$recordBar]+1)>$person['game_record_old'])
//            {
//                Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=$recordBar+1,game_record_old=game_record_old+1 WHERE identifier='$player'");
//            }
//            else
//            {
//                if($person[$recordBar]>=0)
//                {
//                    Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=$recordBar+1 WHERE identifier='$player'");
//                }
//                else
//                {
//                    Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=1 WHERE identifier='$player'");
//                }
//            }
//
//
//            $goldResult[$player]['goldTransaction']=-$goldSum;
//            $goldResult[$player]['experience']=$experienceSuccessor;
//            $goldResult[$player]['times']=$times*2;
//            $goldResult[$player]['cardsLeft']=$redis->sMembers($player.':cards');
//            //数据库添加金币和经验
//            // $personId=strstr( $player, '_',true);
//            $personId=$player;
//            $role='role1';
//            //$role=strstr( $player, '_');
//            Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold-'.$goldSum.' WHERE identifier=\''.$personId.'\'');
//            // Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceSuccessor.'  WHERE identifier=\''.$personId.'\'');
//            //检验是否升级？
//        }
//        //如果地主输，当前是农民
//        if($ratio==-1&&$player!=$dizhu)
//        {
//
//            $person=Events::$db->row('SELECT game_record,game_record_old,game_experience,step FROM `person` WHERE identifier=\''.$player.'\'');
//            $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            //经验对等级的影响
//            //每次经验的增加都会触发等级的增加，验证等级是否增加
//            //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
//            if($person['game_experience']+$experienceSuccessor>=$person['step']*1000)
//            {
//                $goldResult[$player]['levelUp']=true;
//                Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
//            }
//            else
//            {
//                Events::$db->query('update `person` set game_experience=game_experience+'.$experienceSuccessor.' WHERE identifier=\''.$player.'\'');
//            }
//            if($person_agent['experience']+$experienceSuccessor>=$person_agent['step']*1000)
//            {
//                $goldResult[$player]['roleLevelUp']=true;
//                Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//            else
//            {
//                Events::$db->query("update `person_agent` set experience=experience+'$experienceSuccessor' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
//            }
//
//
//            if(($person['game_record']+1)>$person['game_record_old'])
//            {
//                Events::$db->query('update `person` set game_record='.($person['game_record']+1).',game_record_old='.($person['game_record']+1).' WHERE identifier=\''.$player.'\'');
//            }
//            else
//            {
//                Events::$db->query('update `person` set game_record='.($person['game_record']+1).' WHERE identifier=\''.$player.'\'');
//            }
//
//            $goldResult[$player]['goldTransaction']=-$goldSum/2;
//            $goldResult[$player]['experience']=$experienceSuccessor;
//            $goldResult[$player]['times']=-$times;
//            $goldResult[$player]['cardsLeft']=$redis->sMembers($player.':cards');
//            //数据库添加金币和经验
//            $personId=strstr( $player, '_',true);
//            $role=strstr( $player, '_');
//            Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold-'.($goldSum/2).' WHERE identifier=\''.$personId.'\'');
//            //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceSuccessor.'  WHERE identifier=\''.$personId.'\'');
//            //检验是否升级？
//        }
//    }
//    return $goldResult;
//}
function changeCard($playerId,$roomId,$Cards)
{
    global $redis;
    $Cards=explode(',',$Cards);
    //判断牌的真实性
    foreach ($Cards as $card)
    {
        if(!$redis->sIsMember($playerId.':cards',$card))
            return false;
    }
    //出牌并判断是否为炸弹和对王
    $addTimes=0;
    $haveP=0;
    foreach ($Cards as $card)
    {
        $redis->sRem($playerId.':cards',$card);
        if($haveP)
            if($card=='*16'||$card=='*17')
            {
                $addTimes=2;
                continue;
            }
        if($card=='*16'||$card=='*17')
            $haveP=1;
    }
    $Cards=preg_replace('/[rwyb*]/','',$Cards);
    if(count($Cards)==4&&$Cards[0]==$Cards[1]&&$Cards[1]==$Cards[2]&&$Cards[2]==$Cards[3])
        $addTimes=2;
    if($addTimes)
    {
        // Events::sendOutByPublicChannel($roomId,'xx','timesAdd','system',$addTimes);
        $redis->hSet($roomId,'times',$redis->hGet($roomId,'times')+$addTimes);
    }
    // print_r($bar);
    return true;
}
function game_play($clientId,$payload_buff)
{
    $payload['type']=$payload_buff->getType();
    $payload['data']=$payload_buff->getData();
    global $redis;
    //获取本次适配的对象
    $playerId=$_SESSION['uid'];
    //对象是否存在游戏房间中
    //通过对象获取房间
    $roomId=$redis->hGet($playerId,'roomId');
    //如果没有房间则返回空
    if($roomId==null)
    {
        send_notice_by_client_id($clientId,1,"未找到房间");
        return ;
    }
    $TimerType=$payload['type'];
    //当前阶段，是否在该阶段
    //房间是否开放
    if($redis->hGet($roomId,'open'))
    {
        //使用任意牌
        if($TimerType=='x')
        {
            //使用任意牌控制器控制
            xCardSetter($roomId,$playerId);
        }
        //app1_spaceinputmastar::onSpaceMessage('group','房间开放的','1');
        //验证当前出牌者
        //验证出牌权值0.
        $owner=$redis->hGet($roomId,'turnerId');
        $value=$redis->hGet($roomId,'compareValue');
        $value=json_decode($value,true);
        if($playerId==$owner)
        {
            //  app1_spaceinputmastar::onSpaceMessage('client','轮到你',$client_id);
            if($TimerType==Play_Data_Type::jiaodizhu)
            {
                if(compareValueFordizhu($payload,$value))
                {
                    //  app1_spaceinputmastar::onSpaceMessage('client','地主环节',$client_id);
                    roomTrigger($playerId,$roomId,$payload);
                }
                else
                    send_notice_by_client_id($clientId,1,"类型不匹配");
                //   app1_spaceinputmastar::onSpaceMessage('client','类型不匹配1，需要'.$value['type'].'发出'.$TimerType,$client_id);
            }
            else
                if ($TimerType==Play_Data_Type::pai&&$TimerType==$value['type'])
                {
                    $realPayload=$payload;
                    $messageData =valueDecode($payload['data']);
                    if($messageData===false)
                    {
                        Gateway::sendToClient($clientId,'类型不匹配');
                        return ;
                    }
                    //app1_spaceinputmastar::onSpaceMessage('client', '出牌环节', $client_id);
                    if($cardMatch=existXCard($payload['data']))
                    {
                        $xCard=$redis->hGet($playerId,'xCard');
                        if($xCard==false)
                        {
                            send_notice_by_client_id($clientId,4,"类型不匹配1");
                            return ;
                        }
                        //如果只出一张牌不能有任意牌
                        $data=explode(',',$payload['data']);
                        if(count($data)==1)
                        {
                            send_notice_by_client_id($clientId,4,"类型不匹配2");
                            return ;
                        }
                        $cardMatchValue=substr($cardMatch,1);
                        $xCardValue=substr($xCard,1);
                        if($cardMatchValue==16||$cardMatchValue==17)
                        {
                            send_notice_by_client_id($clientId,4,"类型不匹配3");
                            return ;
                        }
                        if($messageData['begin']>$cardMatch&&$messageData['begin']+$messageData['begin']['Y']<$cardMatch)
                        {
                            send_notice_by_client_id($clientId,4,"类型不匹配4");
                            return ;
                        }
                        str_replace($cardMatch,$xCard,$realPayload['data']);
                    }
                    if(checkType($messageData))
                    {
                        switch (compareValue($messageData, $value['data']))
                        {
                            case 1:
                                // app1_spaceinputmastar::onSpaceMessage('client', '牌大', $client_id);
                                roomTrigger($playerId,$roomId,$realPayload,$messageData);
                                break;
                            /*  case -1:
                                  Events::sendOutByProtectChannel($playerId,'xx','error','system','牌小');
                                //  app1_spaceinputmastar::onSpaceMessage('client', '牌小', $client_id);
                                  break;*/
                            case 0:
                                send_notice_by_client_id($clientId,4,"牌小");
                                // app1_spaceinputmastar::onSpaceMessage('client', '牌型错误', $client_id);
                                break;
                            default:
                                echo '系统错误，app1_spaceinputmastar::main 报错，比较值出错';
                                //  app1_spaceinputmastar::onSpaceMessage('client', '系统错误', $client_id);
                                break;
                        }
                    }
                    else
                        send_notice_by_client_id($clientId,4,"非法类型");
                    //  app1_spaceinputmastar::onSpaceMessage('client','非法类型',$client_id);
                }
                else
                    send_notice_by_client_id($clientId,4,"阶段不匹配");
            // app1_spaceinputmastar::onSpaceMessage('client','阶段不匹配，需要'.$value['type'].'发出'.$TimerType,$client_id);

            /* else{
                 echo '系统错误，app1_spaceinputmastar::main 报错，轮流类型不匹配';
                 app1_spaceinputmastar::onSpaceMessage('client','系统错误',$client_id);
             }*/
        }
        else
            send_notice_by_client_id($clientId,1,"没轮到你");
        // app1_spaceinputmastar::onSpaceMessage('client','没轮到你',$client_id);

    }
    else
        send_notice_by_client_id($clientId,1,"房间未开放");
    //app1_spaceinputmastar::onSpaceMessage('client','没轮到你',$client_id);
    return ;

}
function xCardSetter($spaceIndex,$playerId)
{

    global $redis;
    if(!xCardUseGoods($spaceIndex,$playerId))
    {
        return false;
    }
    $effect=xCardLevelRoute($playerId);
    $cards=$redis->Smembers($playerId.':cards');
    if(count($cards)<10)
    {
        //牌数应大于特殊情况
        return ;
    }
    $xCard=xCardGetByEffect($spaceIndex,$cards,$effect);
    $redis->hSet($playerId,'xCard',$xCard);
    return $xCard;
}
function xCardGetByEffect($spaceIndex,$cards,$effect)
{
    //作用影响缩小拿到2和1的概率
    // $cards=$redis->Smembers($playerId.':cards');
    $index=mt_rand(0,count($cards)-1);
    $bar=$cards[$index];
    $unParent=substr($bar,1);
    $effectBar=(mt_rand(1,100)<=$effect);
    if($unParent=='16'||$unParent=='17'||($effectBar&&($unParent=='14'||$unParent=='15')))
    {
        //获取手牌
        $bar=xCardGetByEffect($spaceIndex,$cards,$effect);
    }
    return $bar;
}
function xCardLevelRoute($playerId){
    $person=Events::$db->row("select effect_range from person,x_card_effect where identifier=$playerId and xCardLevel=level");
    return $person['effect_range'];

}
function xCardUseGoods($spaceIndex,$playerId)
{
    global $redis;
    $xCardController=$redis->hGet($spaceIndex,'xCardController');
    // if(!$xCardController||$redis->hExists($playerId,'xCard'))
    if(!$xCardController)
    {
        return false;
    }
    $goods=Events::$db->row("select id,goods_count from person_pack where goods_id=32001 and identifier=$playerId");
    if(!$goods)
    {
        return false;
    }
    if($goods['goods_count']==1)
    {
        Events::$db->query("delete from person_pack where id=$goods[id]");
        return true;
    }
    Events::$db->query("update person_pack set goods_count=goods_count-1 where id=$goods[id]");

    return true;
}
function compareValueFordizhu($messageValue,$spacePlayerValue)
{
    if($spacePlayerValue['type']==Play_Data_Type::jiaodizhu&&$messageValue['type']==Play_Data_Type::jiaodizhu)
    {
        if($spacePlayerValue['data']<=$messageValue['data'])
            return 1;
        else
            return 0;
    }
    return 0;
}
function valueDecode($Data)
{
    //使用result转化结果？
    //直接返回结果
    if($Data==null)
        return null;
    if(is_array($Data)&&count($Data)&&is_array($Data[0])&&is_array($Data[1]))
    {
        $result=valueDecodePart($Data);
        return valueDecodePart($Data);
    }
    //$Data为出牌字符串
    //$index是否为数值？？ father ?mother
    //过滤花色
    $data=preg_replace('/[rwyb*]/','',$Data);
    $data=explode(',',$data);
    //rsort($data);
    //确定x,x最高优先级
    //确定begin和y，次高优先级
    //确定wings最后优先级
    if($data==null)
        return false;
    sort($data);
    //先去除重复的
    //存入哈希表
    //键名为牌数值，键值为牌数量
    $tmp=array();
    foreach ($data as $item)
    {
        if(array_key_exists($item,$tmp))
        {
            //如果存在则值加一
            $tmp[$item]++;
        }
        else
        {
            $tmp[$item]=1;
        }

    }
    if(count($data)>=8)
    {
        //先看是否是飞机，得出飞机转码
        $result=valueDecodeUp($tmp);
        if($result!=false)
            return $result;
    }
    $X=max($tmp);
    $Y=0;
    $begin=0;
    $wings=array();
    //识别一连二连三连四连 并可带翅膀,正确出牌应该只有一个最大区域
    foreach($tmp as $key=>$value)
    {
        //识别连值，设置第一个x区域开始值
        if($value==$X&&$begin==0)
        {
            $begin=$key;
        }
        //第一个x区域计数
        if($value==$X&&$key==$begin-$Y)
        {
            $Y++;
            continue;
        }
        //非第一个x连续区域，加入wings
        if(!array_key_exists('type',$wings))
        {
            $wings['type']=$value;
        }
        if($wings['type']!=$value)
            return false;
        $wings['data'][]=$key;
    }
    //取得充分条件
    //不能丢失牌数
    if(isset($wings['type'])&&$wings['type']==4)
    {
        $wings['type']=2;
        $wings['data'][]=$wings['data'][1];
    }
    //四带一对需要切
    if(isset($wings['type'])&&$X==4&&$wings['type']==2&&count($wings['data'])==1)
    {
        $wings['type']=1;
        $wings['data'][]=$wings['data'][1];
    }
    //飞机带炸弹？？12 4>16
    //寻找最大主体区域
    // 555 666 777 888 9999
    return array('type'=>['X'=>$X,'Y'=>$Y-1],'begin'=>$begin-$Y+1,'wings'=>$wings);
}
function valueDecodePart($Data)
{
    $body=$Data[0];
    $wings=$Data[1];
    $bodyCode=valueDecodePartBody($body);
    if($bodyCode!==false)
    {
        $wingsCode=valueDecodePartWings($bodyCode['type']['Y']-1,$wings);
        if($bodyCode!==false)
        {
            return array_merge($bodyCode,$wingsCode);
        }
    }
    return false;
}
function valueDecodePartBody($Data)
{

    if($Data==null)
        return false;
    //$Data为出牌字符串
    //$index是否为数值？？ father ?mother
    //过滤花色
    $data=preg_replace('/[rwyb*]/','',$Data);
    rsort($data);
    $data=explode(',',$data);
    //确定x,x最高优先级
    //确定begin和y，次高优先级
    //确定wings最后优先级
    if($data==null)
        return false;
    sort($data);
    //先去除重复的
    //存入哈希表
    //键名为牌数值，键值为牌数量
    $tmp=array();
    foreach ($data as $item)
    {
        if(array_key_exists($item,$tmp))
        {
            //如果存在则值加一
            $tmp[$item]++;
        }
        else
        {
            $tmp[$item]=1;
        }

    }
    if(count($Data)>=8)
    {
        //先看是否是飞机，得出飞机转码
        $result=valueDecodeUp($tmp);
        if($result!=false)
            return $result;
    }
    $X=max($tmp);
    $Y=0;
    $begin=0;
    //识别一连二连三连四连 并可带翅膀,正确出牌应该只有一个最大区域
    foreach($tmp as $key=>$value)
    {
        //识别连值，设置第一个x区域开始值
        if($value==$X&&$begin==0)
        {
            $begin=$key;
        }
        //第一个x区域计数
        if($value==$X&&$key==$begin-$Y)
        {
            $Y++;
            continue;
        }
        return false;
    }
    return array('type'=>['X'=>$X,'Y'=>$Y-1],'begin'=>$begin-$Y+1);
}
function valueDecodePartWings($bodyCount,$wingsData)
{
    $wings=[];
    if(count($wingsData)!=$bodyCount&&count($wingsData)!=$bodyCount*2)
    {
        return false;
    }
    if(count($wingsData)==$bodyCount)
    {
        $wings['type']=1;
        $wings['data']=$wingsData;
    }
    if(count($wingsData)==$bodyCount*2)
    {
        $wings['type']=2;
        rsort($wingsData);
        for($i=0;$i<count($wingsData);$i+=2)
        {
            if($wingsData[$i]!=$wingsData[$i+1])
            {
                return false;
            }
            $wings['data'][]=$wingsData[$i];
        }
    }
    return $wings;
}
//升级版
//正确的能全部转化
function valueDecodeUp($tmp)
{
    //最大主体不适用
    rsort($data);
    //小于8张不找最大面积
    $container=[0,0,0];
    $closed=1;
    $maxAreaX=0;
    $maxAreaY=0;
    $maxAreaFirst=0;
    //找3张的最大面积
    foreach($tmp as $key=>$value)
    {
        //循环体有哪些操作，最高的优先级是哪个
        //初始时操作
        //断点时操作
        //连续时操作
        //从新初始时操作
        if($closed=1&&$value>=3)
        {
            $closed=0;
            $maxAreaX=3;
            $maxAreaY=0;
            $maxAreaY++;
            $maxAreaFirst=$key;
            continue ;
        }
        //如果有不连续的数值则x y要重新换
        if($closed==0&&($value<=3||$key!=$maxAreaFirst-$maxAreaY))
        {
            $closed=1;
            if($maxAreaX*$maxAreaY>$container[0]*$container[1])
            {
                $container=[$maxAreaX,$maxAreaY,$maxAreaFirst];
            }
            $maxAreaX=0;
            $maxAreaY=0;
            $maxAreaFirst=0;
            continue ;
        }
        $maxAreaY++;
        continue;
    }
    $tmp1=[];
    $count=0;
    foreach($tmp as $key=>$value)
    {
        if($key>$container[3]||$key<$container[3]-$container[2])
        {
            $tmp1[$key]=$value;
            $count+=$value;
            continue;
        }
        if($value==4)
        {
            $tmp1[$key]=1;
            $count+=$value;
        }
    }
    $wings=[];
    if($count!=$container[2]&&$count!=$container[2]*2)
    {
        //可以补齐的去补齐
        if(($count+3)==($container[2]-1))
        {
            $index=$container[3]-$container[2]+1;
            $container[2]-=1;
            $count+=3;
            if(array_key_exists($index,$tmp1))
            {
                $tmp1[$index]+=3;
            }
            else
            {
                $tmp1[$index]=3;
            }
        }
        else
            if(($count+3)==($container[2]-1)*2)
            {
                $index=$container[3];
                if(array_key_exists($index,$tmp1))
                {
                    $container[3]-=1;
                    $count+=3;
                    $tmp1[$index]+=3;
                }
                else
                {
                    $index=$container[3]-$container[2]+1;
                    if(array_key_exists($index,$tmp1))
                    {
                        $container[2]-=1;
                        $count+=3;
                        $tmp1[$index]+=3;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            else
                if(($count+6)==($container[2]-2)*2)
                {
                    $index=$container[3];
                    if(array_key_exists($index,$tmp1))
                    {
                        $container[3]-=1;
                        $count+=3;
                        $tmp1[$index]+=3;
                        $index=$container[3];
                        if(array_key_exists($index,$tmp1))
                        {
                            $container[3]-=1;
                            $count+=3;
                            $tmp1[$index]+=3;
                        }
                        else
                        {
                            $index=$container[3]-$container[2]+1;
                            if(array_key_exists($index,$tmp1))
                            {
                                $container[2]-=1;
                                $count+=3;
                                $tmp1[$index]+=3;
                            }
                            else
                            {
                                return false;
                            }
                        }
                    }

                    else
                    {
                        $index=$container[3]-$container[2]+1;
                        if(array_key_exists($index,$tmp1))
                        {
                            $container[2]-=1;
                            $count+=3;
                            $tmp1[$index]+=3;
                            $index=$container[3]-$container[2]+1;
                            if(array_key_exists($index,$tmp1))
                            {
                                $container[2]-=1;
                                $count+=3;
                                $tmp1[$index]+=3;
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
                else
                {
                    return false;
                }
        //如果差3张试图去补，差6张去补
    }
    if($count==$container[2])
    {
        $wings['type'][]=1;
        foreach ($tmp1 as $key=>$value)
        {
            for ($i=0;$i<$value;$i++)
            {
                $wings['data'][]=$key;
            }
        }
    }
    if($count==$container[2]*2)
    {
        $wings['type'][]=2;
        foreach ($tmp1 as $key=>$value)
        {
            if(($value%2)!=0)
            {
                return false;
            }
            for ($i=0;$i<$value/2;$i++)
            {
                $wings['data'][]=$key;
            }
        }
    }
    return array('type'=>['X'=>$container[0],'Y'=>$container[1]-1],'begin'=>$container[2]-$container[1]+1,'wings'=>$wings);
}
function existXCard($data)
{
    preg_match_all('/x\d/',$data,$matches);
    if($matches!=null&&count($matches[0])==1)
    {
        return $matches[0][0] ;
    }
    return false;
}
function checkType($Value)
{
    if($Value==null)
        return 1;
    $X=$Value['type']['X'];
    $Y=$Value['type']['Y'];
    $begin=$Value['begin'];
    $wings=$Value['wings'];
    if($wings!=null)
    {
        //翅膀中不能同时包含大小王
        $pCount=0;
        foreach ($wings['data'] as $item)
        {
            if($pCount==1)
                if($item==16||$item==17)
                {
                    $pCount=2;
                    break;
                }
            if($item==16||$item==17)
                $pCount=1;
        }
        if($pCount==2)
        {
            return 0;
        }
    }
    switch ($X)
    {
        case 1:
            if($Y==1&&$begin==16&&$wings==null)
                return 1;
            if($Y==0&&$wings==null)
                return 1;
            if($Y>=4&&$Y<=14-$begin&&$wings==null)
                return 1;
            break;
        case 2:
            if($Y==0&&$wings==null)
                return 1;
            if($Y>=2&&$Y<=14-$begin&&$wings==null)
                return 1;
            break;
        case 3:
            if($Y==0&&$wings==null)
                return 1;
            if($Y==0&&$wings!=null && count($wings['data'])==1&&($wings['type']==1||$wings['type']==2))
                return 1;
            if($Y>=1&&$Y<=14-$begin&&$wings==null)
                return 1;
            if($Y>=1&&$Y<=14-$begin&&$wings!=null && count($wings['data'])==($Y+1)&&($wings['type']==1||$wings['type']==2))
                return 1;
            break;
        case 4:
            if($Y==0&&$wings==null)
                return 1;
            if($Y==0&&$wings!=null && count($wings['data'])==2&&($wings['type']==1||$wings['type']==2))
                return 1;
            break;
        case 5:
            if($Y==0&&$wings==null)
                return 1;
            break;
        default:
            return 0;
    }
    return 0;
}
function compareValue($messageValue,$spacePlayerValue)
{
    if ($messageValue == null)
        return 1;
    if($spacePlayerValue==null)
        return 1;
    if ($messageValue['type'] == $spacePlayerValue['type'])
    {
        if ($messageValue['wings'] == null &&$spacePlayerValue['wings']==null)
        {
            if ($messageValue['begin'] > $spacePlayerValue['begin'])
                return 1;
            else
                return 0;
        }

        if ($messageValue['wings'] != null &&$spacePlayerValue['wings']!=null)
            // if (count($messageValue['wings']['data']) == ($messageValue['type']['Y']+1)*$messageValue['wings']['type']  && $messageValue['wings']['type'] == $spacePlayerValue['wings']['type'])
            if ( $messageValue['wings']['type'] == $spacePlayerValue['wings']['type'])
            {
                if ($messageValue['begin'] > $spacePlayerValue['begin'])
                    return 1;
                else
                    return 0;
                //只有begin不同,没有相同
                /*   if ($messageValue['begin'] = $spacePlayerValue['begin']&& compareWings($messageValue['wings']['data'], $spacePlayerValue['wings']['data']) > 0)
                       return 1;*/
            }
    }
    if (isG($messageValue)){
        if(!isP($spacePlayerValue))
            return 1;
    }
    return 0;
}
function isG($Value)
{
    if($Value['type']==array('X'=>'4','Y'=>'0')&&$Value['wings']==array()){
        return 1;
    }
    else
        if($Value['type']==array('X'=>'1','Y'=>'1')&&$Value['begin']=='16'&&$Value['wings']==array()){
            return 1;
        }
        else
            return 0;
}
function isP($Value)
{
    if($Value['type']==array('X'=>'1','Y'=>'1')&&$Value['begin']=='16'&&$Value['wings']==array()){
        return 1;
    }
    else
        return 0;
}
function game_go_out($client_id,$go_out)
{
    global $redis;
    if(empty($go_out->getType()))
    {
        send_notice_by_client_id($client_id,1,"请求房间类型丢失");
        return ;
    }
    $playerId=$_SESSION['uid'];
    //判断类型
    if($redis->exists($playerId))
    {
        //已经进去了房间，但需要获取房间信息
        //个人手牌信息，
        $redis->hSet($playerId,'connection',0);
        $roomId=$redis->hGet($playerId,'roomId');
        game_send_go_out($client_id,$go_out->getType());
        Gateway::leaveGroup($client_id,$roomId);
        return ;
    }
    else
    {
        send_notice_by_client_id($client_id,1,"未找到进入的房间");
        return ;
    }


}
function game_is_gaming($client_id)
{
    global $waitingUser;
    //在游戏中,是否返回角色信息??
    $playerId=$_SESSION['uid'];
    if(Events::$redis->exists($playerId))
    {
        $roleOnGaming=Events::$redis->hGet($playerId,'role');
        $roleLevel=Events::$redis->hGet($playerId,'role_level');
        game_send_is_gaming($client_id,true);
        return ;
    }
    game_send_is_gaming($client_id,false);

}