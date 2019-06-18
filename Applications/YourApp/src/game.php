<?php
/**
 * Created by PhpStorm.
 * User: wish
 * Date: 2017/11/17
 * Time: 13:49
 */

require_once __DIR__ .'/redis.php';
use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;
use Events;
class Room
{
    public static $open=false;
    private static $_player_id;
    private static $_message;
    private static $waitingUser=[];//加入的匹配队列是和回话相关联的,一旦回话退出,匹配也退出,如果在队列肯定是该回话的队列
    public static function privateRoomCreate($client_id,$payload)
    {
        //获取创建者信息
        $playerId=$_SESSION['identifier'];
        if(Events::$redis->exists($playerId))
        {
            Gateway::sendToClient($client_id, json_encode([
                'type'=>'error',
                'status'=>417,
                'content'=>nl2br(htmlspecialchars("在其它房间中，不能创建新房间")),
                'time'=>date('Y-m-d H:i:s')
            ]));
            return ;
        }
        //分配占用的队列空间编号,并根据编号加入队列空间
        $queueIndex=0;
        while (true)//是否应该限制循环数
        {
            $queueIndex=mt_rand(10000,100000);
            if(Gateway::getClientCountByGroup($queueIndex)==0)
                break;
        }
        self::$waitingUser[$queueIndex]=[];
        Events::sendOutByProtectChannel($playerId,'table','privateRoomCreate','system',$queueIndex);
        //直接加入队列空间??已加入队列空间,1进入原队列空间2离开原队列空间进入新队列空间//队列空间为无状态,应该可任意更改故选2
        self::privateChannelJoin($client_id,$queueIndex,$playerId);
    }
    public static function privateRoomJoin($client_id,$payload)
    {
        //获取创建者信息
        $playerId=$_SESSION['identifier'];
        //如果在系统房间中，返回在其它房间中不能匹配
        //如果在非系统匹配的房间中
        if(Events::$redis->exists($playerId))
        {
            Gateway::sendToClient($client_id, json_encode([
                'type'=>'error',
                'status'=>417,
                'content'=>nl2br(htmlspecialchars("在其它房间中，不能加入新房间")),
                'time'=>date('Y-m-d H:i:s')
            ]));
            return ;
        }
        self::privateChannelJoin($client_id,$payload['data'],$playerId);
    }
    private static function privateChannelJoin($client_id,$channel,$playerId)
    {

        if(Events::$redis->hGet($playerId.':agent','tmpStatus')==2||Events::$redis->hGet($playerId.':agent','tmpStatus')==3)
        {
            Gateway::sendToClient($client_id, json_encode([
                'type'=>'error',
                'status'=>417,
                'content'=>nl2br(htmlspecialchars("在其它房间或准备中，不能加入新房间")),
                'time'=>date('Y-m-d H:i:s')
            ]));
            return ;
        }
        Gateway::leaveGroup($client_id,$channel);
        Gateway::joinGroup($client_id, $channel);
        $oldChannel=Events::$redis->hGet($playerId.':agent','tmpChannel');
        Events::$redis->lRem('privateRoom:'.$oldChannel,$playerId);
        Events::$redis->lPush('privateRoom:'.$channel,$playerId);
        Events::$redis->hSet($playerId.':agent','tmpChannel',$channel);
        Events::$redis->hSet($playerId.':agent','tmpGold',1000);
        Events::$redis->hSet($playerId.':agent','tmpStatus',1);
        $sessions=Gateway::getClientSessionsByGroup($channel);
        foreach ($sessions as $clientId=>$session)
        {
            Events::sendOutByProtectChannel($playerId,'table','privateRoomJoin','system',$session['identifier']);
        }
        Events::sendOutByPublicChannel($channel,'table','privateRoomJoin','system',$playerId);
    }
    public static function privateRoomGoOut($client_id)
    {
        $playerId=$_SESSION['identifier'];
        $tmpChannel=Events::$redis->hGet($playerId.':agent','tmpChannel');
        Events::sendOutByPublicChannel($tmpChannel,'xx','privateRoomGoOut','system',$playerId);
        Gateway::leaveGroup($client_id,$tmpChannel);
        Events::$redis->hDel($playerId.':agent','tmpChannel');
        //是否需要修改tmpChannel?
        Events::$redis->hDel($playerId.':agent','tmpGold');
        $playerIds=Events::$redis->lRange('privateRoom:'.$tmpChannel,0,-1);
        foreach ($playerIds as $playerId)
        {
            Events::$redis->hSet($playerId.':agent','tmpGold',1000);
            //privateChannelGoOut协议 content 退出的用户id 前端默认tmpGold变为1000
            //Events::sendOutByProtectChannel($session['identifier'],'table','privateChannelGoOut','system',$_SESSION['identifier']);
        }
    }
    public static function privateRoomReady($client_id,$payload)
    {
        /* if(empty($payload['type']))
         {
             Gateway::sendToClient($client_id, json_encode([
                 'type'=>'error',
                 'status'=>417,
                 'content'=>nl2br(htmlspecialchars("请求房间类型丢失")),
                 'time'=>date('Y-m-d H:i:s')
             ]));
             return ;
         }
         //获取创建者信息
         $playerId=$_SESSION['identifier'];
         //玩家状态改成准备状态
         if(Events::$redis->exists($playerId))
         {
             Gateway::sendToClient($client_id, json_encode([
                 'type'=>'error',
                 'status'=>417,
                 'content'=>nl2br(htmlspecialchars("在其它房间中，不能加入新房间")),
                 'time'=>date('Y-m-d H:i:s')
             ]));
             return ;
         }*/
        $tmpChannel=Events::$redis->hGet($_SESSION['identifier'].':agent','tmpChannel');
        if($tmpChannel==null)
        {
            Gateway::sendToClient($client_id, json_encode([
                'type'=>'error',
                'status'=>417,
                'content'=>nl2br(htmlspecialchars("你还没有加入私有房间,不能准备")),
                'time'=>date('Y-m-d H:i:s')
            ]));
            return ;
        }
        self::join($client_id,['type'=>4,'data'=>$tmpChannel]);
    }

    public static function isGaming($client_id,$payload)
    {
        //在游戏中,是否返回角色信息??
        $playerId=$_SESSION['identifier'];
        if(Events::$redis->exists($playerId))
        {
            $roleOnGaming=Events::$redis->hGet($playerId,'role');
            $roleLevel=Events::$redis->hGet($playerId,'role_level');
            Events::sendOutByProtectChannel($playerId,'xx','isGaming','system',['isGaming'=>1,'name'=>$roleOnGaming,'level'=>$roleLevel]);
            return ;
        }
        foreach(self::$waitingUser as $key=>$value)
            if(in_array($_SESSION['identifier'],self::$waitingUser[$key]))
            {
                Events::sendOutByProtectChannel($playerId,'xx','isGaming','system',['isGaming'=>2,'name'=>$_SESSION['role'],'level'=>$_SESSION['role_level']]);
                return ;
            }
        Events::sendOutByProtectChannel($playerId,'xx','isGaming','system',['isGaming'=>0]);

    }
    public static function join($client_id,$payload)
    {

        if(empty($payload['type']))
        {
            Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx1']));
            //Events::sendOutByPrivateChannel($client_id,'xx','error','system',"请求房间类型丢失");
            return ;
        }
        $playerId=$_SESSION['identifier'];
        $goldArr=Events::$db->row('SELECT gold FROM `person` WHERE identifier=\''.$playerId.'\'');
        $goldHave=$goldArr['gold'];
        if(Events::$redis->exists($playerId))
        {
            Events::$redis->hSet($playerId,'connection',1);
            $RoomId=Events::$redis->hget($playerId,'RoomId');
            Gateway::joinGroup($client_id,$RoomId);
            //发送手牌到客户端
            $cards=Events::$redis->Smembers($playerId.':cards');
            $cards=implode(',',$cards);
            Events::sendOutByProtectChannel($playerId,'selfCards','initCards','system',$cards);
            //房间信息
            $init=self::clientRoomInit($RoomId);
            $init['type']='InitRoom';
            Gateway::sendToClient($client_id, json_encode($init));
            return ;
        }
        else
        {
            //遍历匹配数组队列，如果存在其中则返回已在匹配中
            foreach(self::$waitingUser as $waitingUserItem)
                if(in_array($_SESSION['identifier'],$waitingUserItem))
                {
                    Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx2']));
                    //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"已在匹配中");
                    return ;
                }
            switch ($payload['type'])
            {
                //判断金币
                //加入等待队列
                case '1':
                    if($goldHave<300)
                    {
                        Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx3']));
                        //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                        return ;
                    }
                    Events::$db->row('update `person` set lock_gold=300,gold=gold-300 WHERE identifier=\''.$playerId.'\'');
                    self::$waitingUser['1'][]=$_SESSION['identifier'];
                    break;
                case '2':
                    if($goldHave<1000)
                    {
                        Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx3']));
                        //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                        return ;
                    }
                    Events::$db->row('update `person` set lock_gold=1000,gold=gold-1000 WHERE identifier=\''.$playerId.'\'');
                    self::$waitingUser['2'][]=$_SESSION['identifier'];
                    break;
                case '3':
                    if($goldHave<10000)
                    {
                        Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx3']));
                        //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"金币不足");
                        return ;
                    }
                    Events::$db->row('update `person` set lock_gold=10000,gold=gold-10000 WHERE identifier=\''.$playerId.'\'');
                    self::$waitingUser['3'][]=$_SESSION['identifier'];
                    break;
                case '4':
                    self::$waitingUser[$payload['data']][]=$_SESSION['identifier'];
                    Events::sendOutByProtectChannel($_SESSION['identifier'],'table','readying','system','等待其他玩家');
                    if(count(self::$waitingUser[$payload['data']])==3)
                    {
                        self::init(self::$waitingUser[$payload['data']],$payload['type'],$payload['data']);
                        self::$waitingUser[$payload['type']]=array();
                    }
                    break;
                default:
                    Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx4']));
                    //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"请求房间类型错误");
                    return ;
            }
            Gateway::sendToClient($client_id,json_encode(['type'=>'Join']));
            //Events::sendOutByProtectChannel($_SESSION['identifier'],'table','Join','system','等待其他玩家');
            if($payload['type']!=4&&count(self::$waitingUser[$payload['type']])==3)
            {
                self::init(self::$waitingUser[$payload['type']],$payload['type']);
                self::$waitingUser[$payload['type']]=array();
            }
            if(count(self::$waitingUser[$payload['type']])>=3)
            {
                Gateway::sendToClient($client_id,json_encode(['type'=>'Join','error'=>'errorxx5']));
                //Events::sendOutByPrivateChannel($client_id,'xx','Join','system',"系统错误,队列数");
            }
        }

    }
    //退出匹配队列
    public static function quitJoin($client_id,$payload=null)
    {
        //遍历匹配队列
        foreach(self::$waitingUser as $key=>$value)
            if(($index=array_search($_SESSION['identifier'],self::$waitingUser[$key]))!==false)
            {
                unset(self::$waitingUser[$key][$index]);
                Gateway::sendToClient($client_id,json_encode(['type'=>'QuitJoin']));
                //Events::sendOutByProtectChannel($_SESSION['identifier'],'table','QuitJoin','system','退出匹配');
                return ;
            }
            else
            {
                Gateway::sendToClient($client_id,json_encode(['type'=>'QuitJoin','error'=>'errorxx1']));
                //Events::sendOutByPrivateChannel($client_id,'table','QuitJoin','system','没有在匹配中');
                return ;
            }
    }
    //退出房间
    public static function goOut($client_id,$payload)
    {
        if(empty($payload['type']))
        {
            Events::sendOutByPrivateChannel($client_id,'xx','error','system',"请求房间类型丢失");
            return ;
        }
        $playerId=$_SESSION['identifier'];
        //判断类型
        if(Events::$redis->exists($playerId))
        {
            //已经进去了房间，但需要获取房间信息
            //个人手牌信息，
            //其他玩家状态，
            //出牌记录
            Events::$redis->hSet($playerId,'connection',0);
            $RoomId=Events::$redis->hGet($playerId,'RoomId');
            Events::sendOutByPublicChannel($RoomId,'xx','goOut','system',$playerId);
            Gateway::leaveGroup($client_id,$RoomId);
            return ;
        }
        else
        {
            Events::sendOutByPrivateChannel($client_id,'xx','error','system',"未找到进入的房间");
            return ;
        }


    }
    private static function init($playerIds,$channel,$channelNumber=-1)
    {
        // TODO: Implement onmessage() method.
        //有状态
        shuffle($playerIds);
        $RoomId=self::RoomCreate($playerIds,$channel,$channelNumber);
        echo "房间创建成功\r\n";
        //设置房间消息发送器
        foreach ($playerIds as $playerId)
        {
            $client_ids=Gateway::getClientIdByUid($playerId);
            foreach ($client_ids as $client_id)
                Gateway::joinGroup($client_id,$RoomId);
        }
        echo "玩家接收器以连接\r\n";
        //\Events::$redis->subscribe([$RoomId],'self::onRoomMessage');
        //匹配加入房间成功后返回房间基本信息给所有玩家
        //订阅房间频道，发布房间频道：redis??or sessionGroup  房间频道即group频道 。session是被自动订阅的，绑定的是clientID
        Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','进入房间');
        //房间初始化的信息
        //房间信息
        $init=self::clientRoomInit($RoomId);
        $init['type']='InitRoom';
        Gateway::sendToGroup($RoomId, json_encode($init));
        //进入游戏阶段
        Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','游戏即将开始');
        Events::$redis->hSet($RoomId,'open','1');
        self::GameStart($RoomId,$playerIds);
    }
    //无状态
    /*  private static function cardSend($RoomId,$playerIds){

        foreach ($playerIds as $playerId){
            $redis=new \Redis();
            Events::$redis->sMove($RoomId.':cardPool',$playerId.':cards',);
            $cards=redisDriver::RoomGet($playerId,'cards')=array_splice(redisDriver::RoomGet($RoomId,['cardRandom']),0,17);
            arsort($cards);
            app1_Roominputmastar::onRoomCardsMessage('client',implode(" ",$cards),$playerId);
        }
        //array_chunk(RoomData::$data['cardmodel'],17)
    }*/
    private static function GameStart($RoomId,$playerIds)
    {
        //设置先出牌者
        redisDriver::setBeginner($RoomId);
        //游戏信息初始化
        redisDriver::initGame($RoomId);
        //玩家游戏信息初始化
        redisDriver::initPlayers($playerIds,$RoomId);
        Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','洗牌开始');
        //洗牌3秒时间，有状态
        Timer::add(3, function()use($RoomId,$playerIds)
        {
            //发牌
            echo "洗牌结束\r\n";
            Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','洗牌结束');
            // self::cardSend($RoomId);
            //发牌结束
            //redisDriver::RoomSet($RoomId.':cardRandom',$cardRandom);
            //group输出
            //  Gateway::sendToGroup($RoomId,'发牌结束');
            Timer::add(3, function()use($RoomId,$playerIds)
            {
                Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','发牌开始');
                echo "开始发牌\r\n";
                self::cardSend($RoomId);
                echo "发牌结束\r\n";
                //发牌结束
                //redisDriver::RoomSet($RoomId.':cardRandom',$cardRandom);
                //group输出
                Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','发牌结束');
                //结束发牌
                //app1_Roominputmastar::onRoomMessage('group','发牌结束',$RoomId,$playerIds);
                // self::$open=true;
                //走入第一步,值设为空，轮转到第一个玩家,并返回当前所处步数
                //任意牌控制器打开
                Events::$redis->hSet($RoomId,'xCardController','1');
                self::RoomTick($RoomId,array('type'=>'a','data'=>0),0,array('type'=>'a','data'=>0),12);
                //发出消息
                // $session=\GatewayWorker\Lib\Gateway::getSession(RoomData::$data['turnerIds'][0]);
                //  app1_Roominputmastar::onRoomMessage('group',$session['client_name'].'可以叫地主',$RoomId,$playerIds);
            },array(),false);
        },array(),false);
    }
    private static function onRoomMessage($type,$message,$Id,$clintIds=null)
    {
        // echo $type.'onRoomMessage';
        $new_message = array(
            'type'=>'say',
            'from_client_id'=>00000000000,
            'from_client_name' =>'system',
            'to_client_id'=>'all',
            'content'=>nl2br(htmlspecialchars($message)),
            'time'=>date('Y-m-d H:i:s'),
        );
        if($type=='group')
            \GatewayWorker\Lib\Gateway::sendToGroup($Id,json_encode($new_message));
        else
            if($type=='client')
                \GatewayWorker\Lib\Gateway::sendToClient($Id,json_encode($new_message));
            else
                if ($type=='group_create')
                {
                    foreach ($clintIds as $clintId)
                        self::joinGroup($clintId,$Id);
                    \GatewayWorker\Lib\Gateway::sendToGroup($Id,json_encode($new_message));
                }
    }
    private  static function RoomCreate($playerIds,$channel,$channelNumber=-1)
    {
        //创建玩家代理
        //创建房间代理
        return redisDriver::initRoom($playerIds,$channel,$channelNumber);

    }
    private static function clientRoomInit($RoomId)
    {
        $init=array();
        $playerIds=Events::$redis->lRange($RoomId.':playerIds',0,-1);
        $init['roomType']=Events::$redis->hGet($RoomId,'channel');
        $init['dizhu']=Events::$redis->hGet($RoomId,'dizhu');
        if(Events::$redis->hGet($RoomId,'game_start_time'))
            $init['gameStartTime']=Events::$redis->hGet($RoomId,'game_start_time');
        $init['currentValue']=json_decode(Events::$redis->hGet($RoomId,'currentValue'),true);
        if(Events::$redis->sCard($RoomId.':cards')==3)
        {
            if($init['currentValue']['type']=='c')
                $init['bottomCards']=Events::$redis->sMembers($RoomId.':cards');
            foreach ($playerIds as $playerId)
            {
                $init['cardsCount'][$playerId]=Events::$redis->sCard($playerId.':cards');
            }
        }
        foreach ($playerIds as $playerId)
        {
            $init['playerInfo'][$playerId]['id']=Events::$redis->hGet('info_'.$playerId,'id');
            $init['playerInfo'][$playerId]['step']=Events::$redis->hGet('info_'.$playerId,'step');
            $init['playerInfo'][$playerId]['name']=Events::$redis->hGet('info_'.$playerId,'name');
            switch ($init['roomType'])
            {
                case 1:
                    $init['playerInfo'][$playerId]['win_continue_max']=Events::$redis->hGet('info_'.$playerId,'game_primary_record');
                    break;
                case 2:
                    $init['playerInfo'][$playerId]['win_continue_max']=Events::$redis->hGet('info_'.$playerId,'game_medium_record');
                    break;
                case 3:
                    $init['playerInfo'][$playerId]['win_continue_max']=Events::$redis->hGet('info_'.$playerId,'game_senior_record');
                    break;
                default:
                    break;
            }
            $init['playerInfo'][$playerId]['gold']=Events::$redis->hGet('info_'.$playerId,'gold');
        }
        $init['playerIds']=$playerIds;
        if(Events::$redis->hGet($RoomId,'turnerId')!='')
        {
            $init['turnerId']=Events::$redis->hGet($RoomId,'turnerId');
            $init['turnerLeftTime']=15+Events::$redis->hGet($RoomId,'turner_beginTime')-time();
        }
        // $compareValue=Events::$redis->hGet($RoomId,'compareValue');
        //$compareValue=json_decode($compareValue,true);
        $init['currentValueOwner']=Events::$redis->hGet($RoomId,'currant_value_owner');
        return $init;
    }

    private static function RoomTick($RoomId,$compareValue,$times,$currentValue=null,$timeSecond=21)
    {
        // print_r($compareValue);
        //步数加一
        $tick=Events::$redis->hIncrBy($RoomId,'tick',$times);
        //通过步数和玩家队列来判断轮到谁
        $turnerId=Events::$redis->lIndex($RoomId.':playerIds',$tick%3);
        //设置当前房间的轮到者
        Events::$redis->hSet($RoomId,'turnerId',$turnerId);
        //设置轮到者开始时间
        Events::$redis->hSet($RoomId,'turner_beginTime',time());
        if($compareValue){
            echo   '比较值为：';
            // print_r($compareValue);
            if(($ownerId=Events::$redis->hGet($RoomId,'currant_value_owner'))!=''){
                echo '所有者为:'.$ownerId;
            }
            if(($message1=Events::$redis->hGet($RoomId,'dizhu'))!=''){
                echo '预备地主为'.$message1;
            }
            if($turnerId!=''){
                echo '应出牌者为'.$turnerId;
            }
            //设定当前牌权，如果当前牌权属于当前出牌者，则当前出牌者可以出任意牌，即需要将牌权放为0，然后准备当前出牌者出牌，如果当前牌权不属于当前出牌者，即需要出
            if(Events::$redis->hGet($RoomId,'currant_value_owner')==Events::$redis->hGet($RoomId,'turnerId')){
                Events::$redis->hSet($RoomId,'compareValue','{"type":"c","data":{}}');
                Events::$redis->hSet($RoomId,'currentValue','{"type":"c","data":""}');
                //self::setCompareValue($RoomId,array('type'=>'c','data'=>array()));
                //为该步设置时限，定时没有就需要自动走？还是定时检查tick变动?定时器走AI程序，Ai需要比较的值为当前比较的值
                self::timerTrigger(Events::$redis->hGet($RoomId,'repeat'),Events::$redis->hGet($RoomId,'tick'),$RoomId,array('type'=>'c','data'=>array()),$timeSecond);
            }
            else{
                Events::$redis->hSet($RoomId,'compareValue',json_encode($compareValue));
                Events::$redis->hSet($RoomId,'currentValue',json_encode($currentValue));
                self::timerTrigger(Events::$redis->hGet($RoomId,'repeat'),Events::$redis->hGet($RoomId,'tick'),$RoomId,$compareValue,$timeSecond);
            }

        }
        else{
            self::timerTrigger(Events::$redis->hGet($RoomId,'repeat'),Events::$redis->hGet($RoomId,'tick'),$RoomId,$compareValue,$timeSecond);
        }
        Events::sendOutByPublicChannel($RoomId,'xx','turned','system',$turnerId);
        //Events::sendOutByProtectChannel($turnerId,'xx','turned','system','轮到你出牌');
        // return Events::$redis->hGet($RoomId,'tick');
    }
    private static function setCompareValue($RoomRoom,$compareValue)
    {
        if($compareValue)
            RoomData::$data['compareValue']=$compareValue;
    }
    private static function playerTurn($RoomRoom,$times)
    {
        $index=$times%3;
        if($index==1){
            array_push(RoomData::$data['turnerIds'],RoomData::$data['turnerIds'][0]);
            array_splice(RoomData::$data['turnerIds'],0,1);
        }
        if($index==2){
            array_push(RoomData::$data['turnerIds'],RoomData::$data['turnerIds'][0],RoomData::$data['turnerIds'][1]);
            array_splice(RoomData::$data['turnerIds'],0,2);
        }
        $message=RoomData::$data['turnerIds'][0];
        $session=\GatewayWorker\Lib\Gateway::getSession($message);
        app1_Roominputmastar::onRoomMessage('group','轮到'.$session['client_name'],RoomData::$data['index']);
    }

    private  static function timerTrigger($repeat,$currantTick,$RoomId,$compareValue,$timeSecond)
    {
        //todo
    }
    private static function RoomTrigger($playerId,$RoomId,$value,$valueCode=null)
    {
        echo '输入值为：';
        print_r($value);
        $message = Events::$redis->hGet($RoomId, 'turnerId');
        echo '出牌者为' . $message;
        //划分出牌类型
        switch ($value['type'])
        {
            case 'a':
                //叫地主类型
                //说明还没人叫地主
                if ($value['data']) {
                    //当前玩家权值及游戏其他信息更改
                    //设置当前值所有者为当前出牌玩家
                    Events::$redis->hSet($RoomId, 'currant_value_owner', $playerId);
                    //设置地主为当前出牌玩家
                    Events::$redis->hSet($RoomId, 'dizhu', $playerId);
                    //下家是否有抢地主机会
                    //如果没有，说明走了一圈只有本人叫 ，跳过抢地主，开始发牌
                    //获取当前玩家的下一家
                    $tick = Events::$redis->hGet($RoomId, 'tick');
                    //通过步数和玩家队列来判断轮到谁
                    $NextId = Events::$redis->lIndex($RoomId . ':playerIds', ((int)$tick + 1) % 3);
                    if (Events::$redis->hGet($NextId, 'chance') == false) {
                        self::beginPlayCard($playerId, $RoomId, 3);
                    } else {
                        Events::sendOutByPublicChannel($RoomId, 'table', 'a', $playerId, '叫地主:1');
                        self::RoomTick($RoomId, $value, 1,$value,12);
                    }

                } else {
                    //当前玩家权值及游戏其他信息更改
                    Events::$redis->hSet($playerId, 'chance', false);
                    //下家是否有抢地主机会
                    //如果没有，说明走了一圈没人叫
                    $tick = Events::$redis->hGet($RoomId, 'tick');
                    //通过步数和玩家队列来判断轮到谁
                    $NextId = Events::$redis->lIndex($RoomId . ':playerIds', ((int)$tick + 1) % 3);
                    //不叫
                    Events::sendOutByPublicChannel($RoomId, 'table', 'a', $playerId, '不叫:0');
                    if (Events::$redis->hGet($NextId, 'chance') == false)
                    {
                        //没人叫地主重新发牌重新选人
                        if(Events::$redis->hGet($RoomId,'repeat')>=10)
                        {
                            self::gameOver($RoomId);
                        }
                        else
                        {
                            Events::sendOutByPublicChannel($RoomId, 'table', 'systemMessage', 'system', '没有人叫地主，重新洗牌');
                            self::GameStart($RoomId, Events::$redis->lRange($RoomId . ':playerIds', 0, -1));
                        }
                    } else//如果下家有机会，当前玩家关闭，轮转玩家
                    {
                        self::RoomTick($RoomId, $value, 1,$value,12);
                    }

                }
                break;
            case 'b':
                //抢地主类型
                //已经有人叫地主
                //自己是否还有机会，有说明没不叫过地主或没不抢过地主
                if (Events::$redis->hGet($playerId, 'chance'))
                {
                    //如果抢地主
                    if ($value['data']) {
                        //当前玩家权值及游戏其他信息更改
                        Events::$redis->hSet($RoomId, 'dizhu', $playerId);
                        Events::$redis->hSet($RoomId, 'currant_value_owner', $playerId);
                        Events::$redis->hIncrBy($RoomId, 'times', 2);
                        //机会被使用
                        Events::$redis->hSet($playerId, 'chance', false);
                        Events::sendOutByPublicChannel($RoomId, 'table', 'b', $playerId, '抢地主:1');
                        //房间倍数增加
                        //Events::sendOutByPublicChannel($RoomId,'xx','timesAdd','system',2);
                        Events::$redis->hSet($RoomId,'times',Events::$redis->hGet($RoomId,'times')*2);
                        /*self::setCompareValue($RoomRoom,array());
                        app1_Roominputmastar::onRoomMessage('group','叫地主',RoomData::$data['index']);*/
                        //走哪一步，如果是叫地主的玩家抢地主，则是最后一个抢地主，如果不是叫地主玩家抢地主则查找下一玩家是否有抢地主机会
                        $isEnd = true;
                        for ($i = 1; $i < 3; $i++) {
                            $tick = Events::$redis->hGet($RoomId, 'tick');
                            //通过步数和玩家队列来判断轮到谁
                            $NextId = Events::$redis->lIndex($RoomId . ':playerIds', ((int)$tick + $i) % 3);
                            if (Events::$redis->hGet($NextId, 'chance') == true) {
                                $isEnd = false;
                                self::RoomTick($RoomId, $value, $i,$value,12);
                                break;
                            }
                        }
                        if ($isEnd) {
                            self::beginPlayCard($playerId, $RoomId, 3);
                        }

                    } else {
                        //当前玩家权值及游戏其他信息更改
                        Events::$redis->hSet($playerId, 'chance', false);
                        Events::sendOutByPublicChannel($RoomId, 'table', 'b', $playerId, '不抢地主:0');
                        $isEnd = true;
                        for ($i = 1; $i < 3; $i++)
                        {
                            $tick = Events::$redis->hGet($RoomId, 'tick');
                            //通过步数和玩家队列来判断轮到谁
                            $NextId = Events::$redis->lIndex($RoomId . ':playerIds', ((int)$tick + $i) % 3);
                            if (Events::$redis->hGet($NextId, 'chance') == true)
                            {
                                $isEnd = false;
                                //如果即是地主又有机会，则是叫地主玩家，且没人抢，默认它就是地主，直接进入出牌阶段
                                if ($NextId == Events::$redis->hGet($RoomId, 'dizhu'))
                                {
                                    $isEnd = true;
                                    self::beginPlayCard($NextId, $RoomId, $i);
                                    break;
                                }
                                self::RoomTick($RoomId, json_decode(Events::$redis->hGet($RoomId, 'compareValue'), true), $i,json_decode(Events::$redis->hGet($RoomId, 'currentValue'), true),12);
                                break;
                            }
                            if ($NextId == Events::$redis->hGet($RoomId, 'dizhu'))
                            {
                                self::beginPlayCard($NextId, $RoomId, $i);
                                $isEnd = true;
                                break;
                            }
                        }
                    }
                } else
                    Events::sendOutByPublicChannel($RoomId, 'table', 'b', $playerId, '抢地主:1');
                break;
            case 'c':
                //出牌类型
                if ($value['data'] != null)
                {
                    if (self::changeCard($playerId, $RoomId, $value['data']))
                    {
                        if(!Events::$redis->hGet($RoomId, 'xCardController'))
                        {
                            Events::$redis->hSet($playerId, 'xCardController','0');
                        }
                        //玩家打出牌
                        //不是,当前牌权所有者是否是自己,不是,当前牌权所有者有春天就改为没有春天
                        $currant_value_owner=Events::$redis->hGet($RoomId, 'currant_value_owner');
                        if($currant_value_owner!=$playerId&&Events::$redis->hGet($currant_value_owner, 'chuntianChance'))
                        {
                            Events::$redis->hSet($currant_value_owner, 'chuntianChance', '0');
                        }
                        //牌是否出完,没出完改下家
                        Events::sendOutByPublicChannel($RoomId, 'table', 'c', $playerId, $value['data']);
                        if (Events::$redis->sGetMembers($playerId . ':cards') == array())
                        {
                            if(Events::$redis->hGet($playerId, 'chuntianChance'))
                            {
                                // Events::sendOutByPublicChannel($RoomId,'xx','chuntian','system','春天');
                                // Events::sendOutByPublicChannel($RoomId,'xx','timesAdd','system',2);
                                Events::$redis->hSet($RoomId,'times',Events::$redis->hGet($RoomId,'times')*2);
                            }
                            self::gameOver($RoomId, $playerId);
                            Events::sendOutByPublicChannel($RoomId, 'table', 'systemMessage', 'system', '游戏结束');
                        }
                        else
                        {
                            Events::$redis->hSet($RoomId, 'currant_value_owner', $playerId);
                            self::RoomTick($RoomId, ['type' => 'c', 'data' => $valueCode], 1,$value);
                        }

                    }
                    else
                        Events::sendOutByProtectChannel($playerId, 'systemMessage', 'error', $playerId, '出牌错误:cpcw');
                }
                else
                {
                    if (Events::$redis->hGet($RoomId, 'currant_value_owner') == $playerId)
                        Events::sendOutByProtectChannel($playerId, 'systemMessage', 'warning', 'system', '你的出牌权，需要出牌:xycp');
                    else {
                        Events::sendOutByPublicChannel($RoomId, 'table', 'c', $playerId, '不出');
                        //玩家不出比较不变
                        self::RoomTick($RoomId, json_decode(Events::$redis->hGet($RoomId, 'compareValue'), true), 1,json_decode(Events::$redis->hGet($RoomId, 'currentValue')));
                    }
                }
                break;
            //$room->times=$room->times*2
            default:
                echo 'input TimerType error';

        }
    }
    private static function beginPlayCard($dizhu,$RoomId,$times)
    {
        $cards=Events::$redis->sMembers($RoomId.':cards');
        self::bottomCardTimes($RoomId,$cards);
        $cards=implode(',',$cards);
        Events::sendOutByPublicChannel($RoomId,'selfCards','bottomCardsPublic','system',$cards);
        Events::sendOutByProtectChannel($dizhu,'selfCards','bottomCards','system',$cards);
        Events::$redis->sUnionStore($dizhu.':cards',$dizhu.':cards',$RoomId.':cards');
        self::RoomTick($RoomId,array('type'=>'c','data'=>array()),$times,array('type'=>'c','data'=>''),26);
        Events::sendOutByPublicChannel($RoomId,'table','systemMessage','system','开始出牌');
    }
    private static function bottomCardTimes($RoomId,$cards)
    {
        $timesAdd=0;
        foreach ($cards as $card)
        {
            if($timesAdd!=0)
                if($card=='*16'||$card=='*17')
                {
                    $timesAdd=4;
                    break;
                }
            if($card=='*16')
                $timesAdd=2;
            if ($card=='*17')
                $timesAdd=3;

        }
        $cards=preg_replace('/[rwyb*]/','',$cards);
        if($cards[0]==$cards[1]&&$cards[1]==$cards[2])
            $timesAdd=2;
        if($timesAdd)
        {
            // Events::sendOutByPublicChannel($RoomId,'xx','timesAdd','system',$timesAdd);
            Events::$redis->hSet($RoomId,'times',Events::$redis->hGet($RoomId,'times')*$timesAdd);
        }
    }
    public static function changeCard($playerId,$RoomId,$Cards)
    {
        $Cards=explode(',',$Cards);
        //判断牌的真实性
        foreach ($Cards as $card)
        {
            if(!Events::$redis->sIsMember($playerId.':cards',$card))
                return false;
        }
        //出牌并判断是否为炸弹和对王
        $addTimes=0;
        $haveP=0;
        foreach ($Cards as $card)
        {
            Events::$redis->sRem($playerId.':cards',$card);
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
            // Events::sendOutByPublicChannel($RoomId,'xx','timesAdd','system',$addTimes);
            Events::$redis->hSet($RoomId,'times',Events::$redis->hGet($RoomId,'times')*$addTimes);
        }
        // print_r($bar);
        return true;
    }



    private static function valueDecode($Data)
    {
        return null;
    }
    public static function adapter($clientId,$payload)
    {
        //获取本次适配的对象
        $playerId=$_SESSION['identifier'];
        //对象是否存在游戏房间中
        //通过对象获取房间
        $RoomId=Events::$redis->hGet($playerId,'RoomId');
        //如果没有房间则返回空
        if($RoomId==null)
        {
            Gateway::sendToClient($clientId, json_encode([
                'type'=>'error',
                'status'=>417,
                'content'=>nl2br(htmlspecialchars("未找到房间")),
                'time'=>date('Y-m-d H:i:s')
            ]));
            return ;
        }
        $TimerType=$payload['type'];
        if(Events::$redis->hGet($RoomId,'open'))
        {
            //使用任意牌
            if($TimerType=='x')
            {
                //使用任意牌控制器控制
                self::xCardSetter($RoomId,$playerId);
            }
            //app1_Roominputmastar::onRoomMessage('group','房间开放的','1');

            $owner=Events::$redis->hGet($RoomId,'turnerId');
            $value=Events::$redis->hGet($RoomId,'compareValue');
            $value=json_decode($value,true);
            if($playerId==$owner)
            {
                //  app1_Roominputmastar::onRoomMessage('client','轮到你',$client_id);
                if($TimerType=='a'||$TimerType=='b')
                {
                    if(self::compareValueFordizhu($payload,$value))
                    {
                        //  app1_Roominputmastar::onRoomMessage('client','地主环节',$client_id);
                        self::RoomTrigger($playerId,$RoomId,$payload);
                    }
                    else
                        Gateway::sendToGroup($RoomId,'类型不匹配');
                    //   app1_Roominputmastar::onRoomMessage('client','类型不匹配1，需要'.$value['type'].'发出'.$TimerType,$client_id);
                }
                else
                    if ($TimerType=='c'&&$TimerType==$value['type'])
                    {
                        $realPayload=$payload;
                        $messageData =self::valueDecode($payload['data']);
                        if($messageData===false)
                        {
                            Gateway::sendToClient($clientId,'类型不匹配');
                            return ;
                        }
                        //app1_Roominputmastar::onRoomMessage('client', '出牌环节', $client_id);
                        if($cardMatch=self::existXCard($payload['data']))
                        {
                            $xCard=Events::$redis->hGet($playerId,'xCard');
                            if($xCard==false)
                            {
                                Gateway::sendToClient($clientId,json_encode(['type'=>'Adapter','error'=>'error']));
                                return ;
                            }
                            //如果只出一张牌不能有任意牌
                            $data=explode(',',$payload['data']);
                            if(count($data)==1)
                            {
                                Gateway::sendToClient($clientId,json_encode(['type'=>'Adapter','error'=>'error']));
                                return ;
                            }
                            $cardMatchValue=substr($cardMatch,1);
                            $xCardValue=substr($xCard,1);
                            if($cardMatchValue==16||$cardMatchValue==17)
                            {
                                Gateway::sendToClient($clientId,json_encode(['type'=>'Adapter','error'=>'error']));
                                return ;
                            }
                            if($cardMatchValue==$xCardValue)
                            {
                                //如果是炸弹
                            }
                            if($messageData['begin']>$cardMatch&&$messageData['begin']+$messageData['begin']['Y']<$cardMatch)
                            {
                                Gateway::sendToClient($clientId,json_encode(['type'=>'Adapter','error'=>'error3']));
                                return ;
                            }
                            str_replace($cardMatch,$xCard,$realPayload['data']);
                        }
                        if(self::checkType($messageData))
                        {
                            switch (self::compareValue($messageData, $value['data']))
                            {
                                case 1:
                                    // app1_Roominputmastar::onRoomMessage('client', '牌大', $client_id);
                                    self::RoomTrigger($playerId,$RoomId,$realPayload,$messageData);
                                    break;
                                /*  case -1:
                                      Events::sendOutByProtectChannel($playerId,'xx','error','system','牌小');
                                    //  app1_Roominputmastar::onRoomMessage('client', '牌小', $client_id);
                                      break;*/
                                case 0:
                                    Events::sendOutByProtectChannel($playerId,'xx','error','system','牌小');
                                    // app1_Roominputmastar::onRoomMessage('client', '牌型错误', $client_id);
                                    break;
                                default:
                                    echo '系统错误，app1_Roominputmastar::main 报错，比较值出错';
                                    //  app1_Roominputmastar::onRoomMessage('client', '系统错误', $client_id);
                                    break;
                            }
                        }
                        else
                            Events::sendOutByProtectChannel($playerId,'xx','error','system','非法类型');
                        //  app1_Roominputmastar::onRoomMessage('client','非法类型',$client_id);
                    }
                    else
                        Events::sendOutByProtectChannel($playerId,'xx','error','system','阶段不匹配');
                // app1_Roominputmastar::onRoomMessage('client','阶段不匹配，需要'.$value['type'].'发出'.$TimerType,$client_id);

                /* else{
                     echo '系统错误，app1_Roominputmastar::main 报错，轮流类型不匹配';
                     app1_Roominputmastar::onRoomMessage('client','系统错误',$client_id);
                 }*/
            }
            else
                Events::sendOutByProtectChannel($playerId,'xx','error','system','没轮到你');
            // app1_Roominputmastar::onRoomMessage('client','没轮到你',$client_id);

        }
        else
            Events::sendOutByProtectChannel($playerId,'xx','error','system','房间未开放');
        //app1_Roominputmastar::onRoomMessage('client','没轮到你',$client_id);


        return ;

    }
    /*
     * 比较牌大小模块
     * 包含 compareValue compareWings isG isP
     * */
    //比较牌叫地主抢地主大小
    private static function compareValueFordizhu($messageValue,$RoomPlayerValue)
    {
        if($RoomPlayerValue['type']=='a'&&$messageValue['type']=='a')
        {
            if(($messageValue['data']==0||$messageValue['data']==1)&&$RoomPlayerValue['data']==0)
                return 1;
            else
                return 0;
        }
        if($RoomPlayerValue['type']=='a'&&$messageValue['type']=='b')
        {
            if($RoomPlayerValue['data']==1)
                return 1;
            else
                return 0;
        }
        if($RoomPlayerValue['type']=='b'&&$messageValue['type']=='b')
        {
            return 1;
        }
        return 0;
    }
    //比较牌大小
    private static function compareValue($messageValue,$RoomPlayerValue)
    {
        return 1;
    }

    //是否为炸弹和火箭 compareValue调用
    private static function isG($Value)
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

    private static function checkType($Value)
    {
        return 0;
    }
    //无状态，只执行一次
    private static function cardSend($RoomId)
    {
        $playerIds=Events::$redis->lRange($RoomId.':playerIds',0,-1);
        //发送玩家定位牌
        foreach ($playerIds as $playerId)
        {
            //清空手牌，重新洗牌可能有剩余
            Events::$redis->delete($playerId.':cards');
            $roleId=Events::$redis->hGet('info_'.$playerId,'id');
            //$role=Events::$redis->hGet($playerId,'role');
            //$roleLevel=Events::$redis->hGet($playerId,'role_level');
            $getCards=self::usePower($playerId,$roleId);
            foreach ($getCards as $getCard)
            {
                Events::$redis->sMove($RoomId.':cards',$playerId.':cards',$getCard);
            }
        }
        //发剩余的牌
        //获取剩余的牌
        $cardsLeaved=Events::$redis->Smembers($RoomId.':cards');
        //洗牌一次
        shuffle($cardsLeaved);
        //根据剩余几张牌，插入到相应玩家(第二次发牌)
        $begin=0;
        foreach($playerIds as $playerId)
        {
            $scope=$begin+17-Events::$redis->sCard($playerId.':cards');
            //剩余几张牌，假设为16
            for($i=$begin;$i<$scope;$i++)
            {
                //从牌池移动到手牌
                Events::$redis->sMove($RoomId.':cards',$playerId.':cards',$cardsLeaved[$i]);
            }
            $begin=$scope;
            //发送到客户端
            //
            $cards=Events::$redis->Smembers($playerId.':cards');
            $cards=implode(',',$cards);
            Events::sendOutByProtectChannel($playerId,'selfCards','initCards','system',$cards);
        }
        //发牌结束
        /*$cardRandom=array();
        $pattern = $cards;
        for($i=0;$i<count($cards);$i++)
        {
            $index=mt_rand(0,53-$i);
            $cardRandom[]= $pattern[$index]; //生成php随机数
            array_splice($pattern,$index);
        }*/
    }
    //经验
    private static function gameOver($RoomId,$winner=null)
    {
        $result=array();
        if($winner!=null)
        {
            //添加获胜者
            if($winner==Events::$redis->hGet($RoomId,'dizhu'))
            {
                Events::$redis->hSet($RoomId,'ratio',1);
            }
            else
            {
                Events::$redis->hSet($RoomId,'ratio',-1);
            }
            //结算经验和金币，返回经验结果和金币结果

            $channel=Events::$redis->hGet($RoomId,'channel');
            if($channel==4)
            {
                $result=self::privateExperienceAndGold($RoomId,$winner);
            }
            else
            {
                $result=self::experienceAndGold($RoomId,$winner);
            }

        }
        //游戏记录,存入文档或数据库
        //清除房间缓存和玩家信息
        Events::sendOutByPublicChannel($RoomId,'xx','GameResult','system',$result);
        //抽奖设置
        $chanceMap=[15,70,60];
        $result=self::reward($chanceMap,1,'admin1');
        Events::sendOutByPublicChannel($RoomId,'xx','reward','system',$result);
        // Gateway::leaveGroup();
        $playerIds=Events::$redis->lRange($RoomId.':playerIds',0,-1);
        Events::$redis->multi(\Redis::PIPELINE);
        Events::$redis->delete($RoomId);
        Events::$redis->delete($RoomId.':playerIds');
        Events::$redis->delete($RoomId.':cards');
        foreach ($playerIds as $playerId)
        {
            Events::$redis->delete($playerId);
            Events::$redis->delete($playerId.':cards');
        }
        Events::$redis->exec();
    }
    //
    private static function experienceAndGold($RoomId,$winner)
    {
        //经验是由房间频道和赢输家玩家决定的
        //经验
        $experience=0;
        //失败玩家经验
        $experienceLoser=0;
        //成功玩家经验
        $experienceSuccessor=0;
        //底分
        $baseScore=0;
        //金币顶值,输的值
        $goldLimit=0;

        //获取房间类型
        //倍数
        $goldResult=array();
        $times=Events::$redis->hGet($RoomId,'times');
        $channel=Events::$redis->hGet($RoomId,'channel');
        switch ($channel)
        {
            case '1':
                $recordBar='primary_record';
                break;
            case '2':
                $recordBar='medium_record';
                break;
            case '3':
                $recordBar='senior_record';
                break;
            default:
                $recordBar='primary_record';
                break;
        }
        $baseScore=Events::$redis->hGet($RoomId,'baseScore');
        $goldLimit=Events::$redis->hGet($RoomId,'goldLimit');
        $experienceLoser=Events::$redis->hGet($RoomId,'experienceLoser');
        $experienceSuccessor=Events::$redis->hGet($RoomId,'experienceSuccessor');
        $rent=Events::$redis->hGet($RoomId,'rent');
        /* //底牌数
         $baseCardsTimes=0;
         //抢地主数
         $bTimes=0;
         //炸弹数
         $zadanTimes=0;
         //皇炸数
         $huojianTiems=0;
         $goldBase=$baseScore*($baseCardsTimes+$bTimes*2+$zadanTimes*2+$huojianTiems*2);*/
        //or
        //交易金币，系统设置为偶数
        $goldTransaction=$baseScore*$times*2;
        if($goldTransaction>$goldLimit)
            $goldTransaction=$goldLimit;
        $ratio=Events::$redis->hGet($RoomId,'ratio');
        $players=Events::$redis->lRange($RoomId.':playerIds',0,-1);
        $dizhu=Events::$redis->hGet($RoomId,'dizhu');
        //须先扣除输家金币
        //附加游戏次增加
        //赢次数增加
        foreach ($players as $player)
        {
            Events::$db->query('update `person` set game_count=game_count+1 WHERE identifier=\''.$player.'\'');
            $role=Events::$redis->hGet($player,'role');
            $roleLevel=Events::$redis->hGet($player,'role_level');
            $agentIdentifier=$player.'_'.$role;
            //如果农民输，当前是农民
            //经验，金钱
            if($ratio&&$player!=$dizhu)
            {

                //如果是-3-1 4 -1
                // y=x+z x<0,z=-1 -1 x>=0,z=-1
                //y=x+z x>0,z=1 1 x<=0,z=1
                //输家游戏次数增加，还有连胜结束如果查看当前连胜次数当前连胜次和历史连胜次数，如果当前大于历史则更新历史，如果当前小于历史当前连胜为0
                // Events::$db->query('update `person` set game_count=game_count+1 WHERE identifier=\''.$player.'\'');
                //获取剩余金币，lock??
                $goldCut=0;
                $person=Events::$db->row("SELECT gold,game_experience,step,$recordBar FROM `person` WHERE identifier='$player'");
                if($person[$recordBar]>=0)
                {
                    Events::$db->query("update `person` set $recordBar=-1 WHERE identifier='$player'");
                }
                else
                {
                    Events::$db->query("update `person` set $recordBar=$recordBar-1 WHERE identifier='$player'");
                }
                $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                //经验对等级的影响
                //每次经验的增加都会触发等级的增加，验证等级是否增加
                //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
                if($person['game_experience']+$experienceLoser>=$person['step']*1000)
                {
                    $goldResult[$player]['levelUp']=true;
                    Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
                }
                else
                {
                    Events::$db->query('update `person` set game_experience=game_experience+'.$experienceLoser.' WHERE identifier=\''.$player.'\'');
                }
                if($person_agent['experience']+$experienceLoser>=$person_agent['step']*1000)
                {
                    $goldResult[$player]['roleLevelUp']=true;
                    Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                else
                {
                    Events::$db->query("update `person_agent` set experience=experience+'$experienceLoser' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                if($person['gold']<$goldTransaction/2)
                {
                    $goldCut=$person['gold'];
                }
                else
                    $goldCut=$goldTransaction/2;
                //@@执行数据库金币修改
                $goldResult[$player]['goldTransaction']=$goldCut*(-$ratio);
                $goldResult[$player]['experience']=$experienceLoser;
                $goldResult[$player]['times']=-$times;
                $goldResult[$player]['cardsLeft']=Events::$redis->sMembers($player.':cards');
                //数据库修改金币和经验
                //$personId=strstr( $player, '_',true);
                $personId=$player;
                //$role=strstr( $player, '_');
                Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold+'.$goldCut*(-$ratio).' WHERE identifier=\''.$personId.'\'');
                //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceLoser.'  WHERE identifier=\''.$personId.'\'');
                //  $sql='INSERT INTO `person_'.$role.'` (identifier, experience) values(\''.$personId.'\',\''.$experienceLoser.'\') ON DUPLICATE KEY UPDATE experience=experience+'.$experienceLoser;
                // Events::$db->query('update `person_agent` set (identifier, experience) values(\''.$personId.'\',\''.$experienceLoser.'\') ON DUPLICATE KEY UPDATE experience=experience+'.$experienceLoser);

                //检验是否升级

            }
            //如果地主输,当前是地主
            if($ratio==-1&&$player==$dizhu)
            {
                //输家游戏次数增加，还有连胜结束如果查看当前连胜次数当前连胜次和历史连胜次数，如果当前大于历史则更新历史，如果当前小于历史当前连胜为0
                //获取剩余金币
                $goldCut=0;
                $person=Events::$db->row("SELECT gold,game_experience,step,$recordBar FROM `person` WHERE identifier='$player'");
                if($person[$recordBar]>=0)
                {
                    Events::$db->query("update `person` set $recordBar=-1 WHERE identifier='$player'");
                }
                else
                {
                    Events::$db->query("update `person` set $recordBar=$recordBar-1 WHERE identifier='$player'");
                }
                $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                //经验对等级的影响
                //每次经验的增加都会触发等级的增加，验证等级是否增加
                //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
                if($person['game_experience']+$experienceLoser>=$person['step']*1000)
                {
                    $goldResult[$player]['levelUp']=true;
                    Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
                }
                else
                {
                    Events::$db->query('update `person` set game_experience=game_experience+'.$experienceLoser.' WHERE identifier=\''.$player.'\'');
                }
                if($person_agent['experience']+$experienceLoser>=$person_agent['step']*1000)
                {
                    $goldResult[$player]['roleLevelUp']=true;
                    Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                else
                {
                    Events::$db->query("update `person_agent` set experience=experience+'$experienceLoser' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                if($person['gold']<$goldTransaction)
                {
                    //如果是
                    if($person['gold']%2)
                        $goldCut=$person['gold']-1;
                    else
                        $goldCut=$person['gold'];
                }
                else
                    $goldCut=$goldTransaction;
                //@@执行数据库金币修改
                $goldResult[$player]['goldTransaction']=$goldCut*$ratio;
                $goldResult[$player]['experience']=$experienceLoser;
                $goldResult[$player]['times']=-$times*2;
                $goldResult[$player]['cardsLeft']=Events::$redis->sMembers($player.':cards');
                //数据库修改金币和经验
                $personId=strstr( $player, '_',true);
                $role=strstr( $player, '_');
                Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold+'.$goldCut*(-$ratio).' WHERE identifier=\''.$personId.'\'');
                //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceLoser.'  WHERE identifier=\''.$personId.'\'');
                //检验是否升级？
            }
        }
        //输家金币给与赢家
        $goldSum=array_sum($goldResult);
        foreach ($players as $player)
        {
            //如果农民输，当前是地主
            if($ratio&&$player==$dizhu)
            {


                $person=Events::$db->row("SELECT game_record,game_record_old,game_experience,step,$recordBar FROM `person` WHERE identifier='$player'");
                $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                //经验对等级的影响
                //每次经验的增加都会触发等级的增加，验证等级是否增加
                //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
                if($person['game_experience']+$experienceSuccessor>=$person['step']*1000)
                {
                    $goldResult[$player]['levelUp']=true;
                    Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
                }
                else
                {
                    Events::$db->query('update `person` set game_experience=game_experience+'.$experienceSuccessor.' WHERE identifier=\''.$player.'\'');
                }
                if($person_agent['experience']+$experienceSuccessor>=$person_agent['step']*1000)
                {
                    $goldResult[$player]['roleLevelUp']=true;
                    Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                else
                {
                    Events::$db->query("update `person_agent` set experience=experience+'$experienceSuccessor' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }


                if(($person[$recordBar]+1)>$person['game_record_old'])
                {
                    Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=$recordBar+1,game_record_old=game_record_old+1 WHERE identifier='$player'");
                }
                else
                {
                    if($person[$recordBar]>=0)
                    {
                        Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=$recordBar+1 WHERE identifier='$player'");
                    }
                    else
                    {
                        Events::$db->query("update `person` set game_win_count=game_win_count+1,$recordBar=1 WHERE identifier='$player'");
                    }
                }


                $goldResult[$player]['goldTransaction']=-$goldSum;
                $goldResult[$player]['experience']=$experienceSuccessor;
                $goldResult[$player]['times']=$times*2;
                $goldResult[$player]['cardsLeft']=Events::$redis->sMembers($player.':cards');
                //数据库添加金币和经验
                // $personId=strstr( $player, '_',true);
                $personId=$player;
                $role='role1';
                //$role=strstr( $player, '_');
                Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold-'.$goldSum.' WHERE identifier=\''.$personId.'\'');
                // Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceSuccessor.'  WHERE identifier=\''.$personId.'\'');
                //检验是否升级？
            }
            //如果地主输，当前是农民
            if($ratio==-1&&$player!=$dizhu)
            {

                $person=Events::$db->row('SELECT game_record,game_record_old,game_experience,step FROM `person` WHERE identifier=\''.$player.'\'');
                $person_agent= Events::$db->query("SELECT experience,step FROM `person_agent` where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                //经验对等级的影响
                //每次经验的增加都会触发等级的增加，验证等级是否增加
                //如何根据等级的增加去验证经验的增加，增加后的经验和当前升级的经验进行比较如果如果当前经验减升职经验大于0则升级，并把结果套入下次升级经验，重复执行
                if($person['game_experience']+$experienceSuccessor>=$person['step']*1000)
                {
                    $goldResult[$player]['levelUp']=true;
                    Events::$db->query('update `person` set game_experience=0,step=step+1 WHERE identifier=\''.$player.'\'');
                }
                else
                {
                    Events::$db->query('update `person` set game_experience=game_experience+'.$experienceSuccessor.' WHERE identifier=\''.$player.'\'');
                }
                if($person_agent['experience']+$experienceSuccessor>=$person_agent['step']*1000)
                {
                    $goldResult[$player]['roleLevelUp']=true;
                    Events::$db->query("update `person_agent` set experience=0,step=step+1 where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }
                else
                {
                    Events::$db->query("update `person_agent` set experience=experience+'$experienceSuccessor' where agent_identifier='$agentIdentifier' and role_level='$roleLevel'");
                }


                if(($person['game_record']+1)>$person['game_record_old'])
                {
                    Events::$db->query('update `person` set game_record='.($person['game_record']+1).',game_record_old='.($person['game_record']+1).' WHERE identifier=\''.$player.'\'');
                }
                else
                {
                    Events::$db->query('update `person` set game_record='.($person['game_record']+1).' WHERE identifier=\''.$player.'\'');
                }


                $goldResult[$player]['goldTransaction']=-$goldSum/2;
                $goldResult[$player]['experience']=$experienceSuccessor;
                $goldResult[$player]['times']=-$times;
                $goldResult[$player]['cardsLeft']=Events::$redis->sMembers($player.':cards');
                //数据库添加金币和经验
                $personId=strstr( $player, '_',true);
                $role=strstr( $player, '_');
                Events::$db->query('update `person` set lock_gold=0,gold=gold+lock_gold-'.($goldSum/2).' WHERE identifier=\''.$personId.'\'');
                //Events::$db->row('update `person_'.$role.'` set experience=experience+'.$experienceSuccessor.'  WHERE identifier=\''.$personId.'\'');
                //检验是否升级？
            }
        }
        return $goldResult;
    }
    //金币和经验计算和执行
    private static function privateExperienceAndGold($RoomId,$winner)
    {
        $goldResult=array();
        $channelNumber=Events::$redis->hGet($RoomId,'channelNumber');
        //私有房间,金币计算通过私有通道计算
        //首先计算赢家和输赢应得失的金币,然后加入到相应的通道中
        //计算方式是低分*倍数
        if($channelNumber!=-1) {
            $times = Events::$redis->hGet($RoomId, 'times');
            $baseScore = Events::$redis->hGet($RoomId, 'baseScore');
            $baseGold = $baseScore * $times;
            $dizhu = Events::$redis->hGet($RoomId, 'duzhu');
            $ratio = Events::$redis->hGet($RoomId, 'ratio');
            $dizhuGold = $ratio * $baseGold;
            $sessons = Events::$redis->lRange('privateRoom:'.$channelNumber,0,-1);
            //遍历通道
            $limit = 0;
            //循环一遍,看是否有有大于上限的
            foreach ($sessons as $sesson) {
                if ($sesson== $dizhu) {
                    Events::$redis->hIncrBy($sesson.':agent', 'tmpGold',$ratio * $baseGold * 2);
                    $goldResult[$sesson]['goldTransaction']=$ratio * $baseGold * 2;
                    $goldResult[$sesson]['times']=$times*$ratio ;
                } else {
                    Events::$redis->hIncrBy($sesson.':agent', 'tmpGold',$ratio * $baseGold*(-1));
                    $goldResult[$sesson]['goldTransaction']=$ratio * $baseGold*(-1);
                    $goldResult[$sesson]['times']=$times*$ratio*(-1);
                }
                if ( Events::$redis->hGet($sesson.':agent', 'tmpGold')>= 100000) {
                    $limit = 1;
                    break;
                }
                $goldResult[$sesson]['experience']=0;
                //新协议,tmpGold content tmpGold 问题 是谁的呢???
                Events::sendOutByPublicChannel($channelNumber,'xx','tmpGold','system',[$sesson,Events::$redis->hGet($sesson.':agent', 'tmpGold')]);
            }
            //如果超过限制,循环第二遍,改写数值
            if ($limit == 1)
            {
                foreach ($sessons as $sesson)
                {
                    Events::$redis->hSet($sesson.':agent', 'tmpGold',1000);
                    //新协议,tmpGoldRewrite 临时货币从写 content tmpGold 问题 是谁的呢???
                    Events::sendOutByPublicChannel($channelNumber,'xx','tmpGold','system',[$sesson,1000]);
                }
            }
        }
        return $goldResult;
    }
    //无状态
    private static function reward($chanceMap,$channel,$identifier)
    {
        $chance=$chanceMap[$channel-1];
        if(self::barRandom($chance))
        {
            return self::goodsRandom($channel,$identifier);
        }
        return 0;
    }
    private static function goodsRandom($channel,$identifier)
    {
        // $playerId=substr($agent_identifier,0,strpos($agent_identifier,'_'));
        $randomMap=[116,70,60];
        $random=mt_rand(1,$randomMap[0]);
        $row=Events::$db->row("select goods_id from goods_random where channel=$channel and random>=$random order by random");
        if(($goodsId=$row['goods_id'])>0)
        {
            $CardNormalBar=self::createCardNormalBar();
            //执行商品特色属性normal_card_bar
            Events::$db->query("insert into `agent_pack` (agent_identifier,type,goods_id,goods_count,effect_normal_bar) values('$identifier','equipment',$goodsId,1,$CardNormalBar)");
            return $goodsId;
        }
        if(($goodsId=$row['goods_id'])<0)
        {
            $goldMap=[[[100,1000],[1001,5000]],[[500,2000],[2001,10000]],[[1000,8000],[8001,60000]]];
            $gold=mt_rand($goldMap[$channel-1][-1-$goodsId][0],$goldMap[$channel-1][-1-$goodsId][1]);
            Events::$db->query("update `person` set gold=gold+$gold where identifier='$identifier'");
            return ['goodsId'=>$goodsId,'gold'=>$gold];
        }
        return 0;
    }
    protected static function createCardNormalBar()
    {
        return mt_rand (3,14);
    }
    private static function equipmentEffect($channel,$agent_identifier)
    {
        $db=new MysqlModel();
        $agent_equipment=$db->query("select * from equipment_effect,agent_pack where equipment_effect.goods_id=agent_pack.goods_id and agent_identifier=$agent_identifier");
        $db->row("select * from ");
        $chanceMap=[80,70,60];
        $chance=$chanceMap[$channel];
        if(self::barRandom($chance))
        {

        }
    }
    //角色装备起作用
    public static function usePower($identifier,$roleId)
    {
        $roleEffect=Events::$db->row("select effect_dawang,effect_xiaowang,effect_2,effect_normal,effect_zhadan,effect_sanzhang,effect_normal_bar from role_agent_effect,person_agent where person_agent.goods_id=$roleId and identifier='$identifier' and role_agent_effect.goods_id=person_agent.goods_id");
        //如果为空,返回错误
        if($roleEffect==null)
        {
            \GatewayWorker\Lib\Gateway::sendToClient('client_id',json_encode(['type'=>'','error'=>'illegal operation']));
            return ;
        }
        //循环遍历数组中的可用的项目
        $effectList=['effect_dawang'=>0,'effect_xiaowang'=>0,'effect_2'=>0,'effect_zhadan'=>0,'effect_sanzhang'=>0];
        $effectSingle[$roleEffect['effect_normal_bar']]=$roleEffect['effect_normal'];
        foreach ($roleEffect as $key=>$value)
        {
            if(array_key_exists($key,$effectList)&&$value!=null)
            {
                $effectList[$key]+=$value;
            }
        }
        //角色有一个概率,角色装备的每个装备也有一个概率
        //获取某一角色下的所有装备列表
        $equipmentSum=Events::$db->query("select effect_dawang,effect_xiaowang,effect_2,effect_zhadan,effect_sanzhang,effect_normal,effect_normal_bar from person_pack,equipment_effect where identifier='$identifier' and agent_id=$roleId and person_pack.goods_id=equipment_effect.goods_id");
        foreach ($equipmentSum as $equipment)
        {
            if(array_key_exists($equipment['effect_normal_bar'],$effectSingle))
                $effectSingle[$equipment['effect_normal_bar']]+=$equipment['effect_normal'];
            else
                $effectSingle[$equipment['effect_normal_bar']]=$equipment['effect_normal'];
            foreach ($equipment as $key=>$value)
            {
                if(array_key_exists($key,$effectList)&&$value!=null)
                {
                    $effectList[$key]+=$value;
                }
            }
        }
        $getEffect=[];
        foreach ($effectList as $key=>$value)
        {
            if($value!=null&&$value>0)
                if(self::barRandom($value))
                {
                    $getEffect[]=$key;
                }
        }
        $getSingleEffect=[];
        foreach ($effectSingle as $key=>$value)
        {
            if($value!=null&&$value>0)
                if(self::barRandom($value))
                {
                    $getSingleEffect[]=$key;
                }
        }
        $getCards=[];
        foreach ($getEffect as $item)
        {
            switch ($item)
            {
                case 'effect_dawang':
                    $getCards[]='*17';
                    break;
                case 'effect_xiaowang':
                    $getCards[]='*16';
                    break;
                case 'effect_zhadan':
                    $getCards=array_merge($getCards,self::getCardZhaDan());
                    break;
                case 'effect_sanzhang':
                    $getCards=array_merge($getCards,self::getCardThree());
                    break;
                case 'effect_2':
                    $getCards[]=self::getCardNormalSingle('15');
                    break;
            }
        }
        foreach ($getSingleEffect as $item)
        {
            $getCards[]=self::getCardNormalSingle($item);
        }
        return $getCards;
    }
    //确定花色
    //大小王不用确定花色
    //是否中奖
    private static function getCardNormalSingle($item)
    {
        $colorMap=['w','r','y','b'];
        $random=mt_rand(0,3);
        return $colorMap[$random].$item;
    }
    //确定选哪个炸弹
    private static function getCardZhaDan()
    {
        $random=mt_rand(3,15);
        return ['w'.$random,'r'.$random,'y'.$random,'b'.$random];
    }
    private static function getCardThree()
    {
        $item=mt_rand(3,15);
        $colorMap=['w','r','y','b'];
        $random=mt_rand(0,3);
        $result=[];
        foreach ($colorMap as $key=>$color)
        {
            if($key==$random)
                continue;
            $result[]=$color.$item;
        }
        return $result;
    }
    private static function barRandom($chance)
    {
        $random=mt_rand(1,100);
        if($random<=$chance)
        {
            return 1;
        }
        return 0;
    }
    private static function existXCard($data)
    {
        preg_match_all('/x\d/',$data,$matches);
        if($matches!=null&&count($matches[0])==1)
        {
            return $matches[0][0] ;
        }
        return false;
    }
    public static function xCardSetter($RoomId,$playerId)
    {

        if(!self::xCardUseGoods($RoomId,$playerId))
        {
            return false;
        }
        $effect=self::xCardLevelRoute($playerId);
        $cards=Events::$redis->Smembers($playerId.':cards');
        if(count($cards)<10)
        {
            //牌数应大于特殊情况
            return ;
        }
        $xCard=self::xCardGetByEffect($RoomId,$cards,$effect);
        Events::$redis->hSet($playerId,'xCard',$xCard);
        return $xCard;
    }
    private static function xCardGetByEffect($RoomId,$cards,$effect)
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
            $bar=self::xCardGetByEffect($RoomId,$cards,$effect);
        }
        return $bar;
    }
    private static function xCardLevelRoute($playerId){
        $person=Events::$db->row("select effect_range from person,x_card_effect where identifier=$playerId and xCardLevel=level");
        return $person['effect_range'];

    }
    private static function xCardUseGoods($RoomId,$playerId)
    {
        $xCardController=Events::$redis->hGet($RoomId,'xCardController');
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
}