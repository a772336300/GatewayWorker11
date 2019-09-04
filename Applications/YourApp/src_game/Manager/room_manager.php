<?php

use Proto\CS_RoomInfoTable;
use Proto\Message_Id;
use Proto\RoomInfoTable;
use Proto\SC_Competition_Result;
use Proto\SC_Competition_Result_Competition_end;
use Proto\SC_ComPetition_Start;
use Proto\SC_CreateCardRoom;
use Proto\SC_RoomInfoTable;
use Proto\TimeInfo;
use Workerman\Lib\Timer;

require_once 'room_base.php';
require_once 'user.php';

//require_once 'xzdd\game_xzdd.php';

//global


final class room_manager
{
    /**
     * $rooms[game_type][index]
     */
    private $rooms;          //房间容器
    private static $ins;     //房间管理实例
    private $user_number;    //房间人数
    private $users;          //报名用户ID
    private $__time_id_read;
    private $__time_id_start;

    private function __construct()
    {
        echo sprintf("room manager construct %s\n",date("Y-m-d H:i:s"));
        //self::$ins=null;
        $this->user_number=0;
        $this->user_ids=null;
        $this->rooms=null;          //房间
        $this->__time_id_read=Timer::add(20,function ()
        {
            $this->room_loop();
        },true);
    }


    function __destruct()
    {
        //delete self::$ins;
        $this->user_number=0;
        Timer::del($this->__time_id_read);
        Timer::del($this->__time_id_start);
    }

    /**
     * @return 返回房间管理对象
     */
    static function singleton()
    {
        if (!isset(self::$ins))
        {
            self::$ins=new room_manager();
        }
        return self::$ins;
    }

    /**
     * 开始游戏房间
     */
    function start_game_room()
    {
        $this->__timer_id_read=Timer::add(20,function ()
        {
            if (isset($this->rooms))
            {
                //$competition_id = $this->rooms[competition_id]
                foreach ($this->rooms as $competition_id_key => $competition_id)
                {
                    //$room_type = $this->rooms[competition_id][room_type]
                    foreach ($competition_id as $room_type_key => $room_type)
                    {
                        //$config = $this->rooms[competition_id][room_type][['rooms_data'],['room_max'],['top_list'],['top_list_str']]
                        foreach ($room_type as $config_key => $config)
                        {
                            if ($config_key == 'rooms_data')
                            {
                                //$index = $this->rooms[competition_id][room_type]['rooms_data'][index]
                                foreach ($config as $index_key => $index)
                                {
                                    //$room = $this->rooms[competition_id][room_type]['rooms_data'][index][code]
                                    foreach ($index as $roomcode => $room)
                                    {
                                        if (isset($this->users[$competition_id_key][$room_type_key]['socket_id']) && is_array($this->users[$competition_id_key][$room_type_key]['socket_id']))
                                        {
                                            if ($room->get_bsend_start() == false)
                                            {
                                                if (count($this->users[$competition_id_key][$room_type_key]['socket_id']) == $this->rooms[$competition_id_key][$room_type_key]['room_max'][$index_key])
                                                {
                                                    $sc_star = new SC_ComPetition_Start();
                                                    $sc_star->setCompetitionId($room->get_competition_id());
                                                    $sc_star->setGameType($room->get_gtype());
                                                    //$users = $room->get_user_all();
                                                    echo sprintf("start_game_room %s\n",date("Y-m-d H:i:s"));
                                                    foreach ($this->users[$competition_id_key][$room_type_key]['socket_id'] as $playerid => $clientid)
                                                    {
                                                        \GatewayWorker\Lib\Gateway::sendToClient($clientid,my_pack(Message_Id::SC_ComPetition_Start_Id,$sc_star->serializeToString()));
                                                    }
                                                    $room->set_bsend_start(true);
                                                }
                                            }
                                            if ($room->get_bstart() == false)
                                            {
                                                if ($room->get_bnumber() == true)
                                                {  //人满开
                                                    $user_ids = array();
                                                    if (isset($this->users[$competition_id_key][$room_type_key]['socket_id']) && is_array($this->users[$competition_id_key][$room_type_key]['socket_id']))
                                                    {
                                                        foreach ($this->users[$competition_id_key][$room_type_key]['socket_id'] as $uid_key => $socket)
                                                        {
                                                            array_push($user_ids,$uid_key);
                                                            if (count($user_ids) == 3)
                                                            {
                                                                roomInit($user_ids,$room->get_gtype(), $room->get_code(), $room->get_competition_id(), $room->get_top_index());
                                                                $room->set_bstart(true);
                                                                $user_ids = array();
                                                            }
                                                        }
                                                    }
                                                }
                                                else
                                                {  //定时开
                                                    if ($room->get_bstart() == true || strtotime(date("Y-m-d H:i:s")) == strtotime($room->get_starttime()))
                                                    {
                                                        echo sprintf("start time: %s \n", $room->get_starttime());
                                                        if ($room->get_top_index() + 1 == count($room->get_top_list()))
                                                        {
                                                            $user_ids = $room->get_user_id_all();
                                                            roomInit($user_ids,$room->get_gtype(), $room->get_code(), $room->get_competition_id(), $room->get_top_index());
                                                            $room->set_bstart(true);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            elseif ($config_key == 'room_max')
                            {

                            }
                            elseif ($config_key == 'top_list')
                            {

                            }
                            elseif ($config_key == 'top_list_str')
                            {

                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * 读取数据库，查询赛制，建立房间
     */
    function room_loop()
    {
        echo sprintf("room_loop %s\n",date("Y-m-d H:i:s"));
        $collname='game_competition';
        $mongodb=mongo_db::singleton('func_system');
        $filter = [
                'starttime'  => ['$gt' => date('Y-m-d H:i:s')] //条件：大于当前时间
        ];
        $queryWriteOps = [
                'projection'    => ['_id'   =>0],//不输出_id字段
                'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
        ];
        $rs = $mongodb->query($collname,$filter,$queryWriteOps);
        foreach ($rs as $data)
        {
            if (!isset($this->rooms[$data->id]))
            {
                $data->index = 0;
                $this->create_room($data);
            }
        }
    }

    /**
     * @param $data =>[
     *                  'id'=>1,
     *                  'type'=>'ddz'/'xzdd',
     *                  'bnumber'=>false,
     *                  'number'=>100,
     *                  'advanced'=>1,
     *                  'max'=>3,
     *                  'top_index'=>0,
     *                  'top_list'=>'120,90,60,30,9,3',
     *                  'starttime'=>'2019-07-08 14:49:05'
     *                  ]
     */
    function create_room($data)
    {
        switch ($data->type)
        {
            case \Proto\Room_Type::bisai_dizhu:
                $count = intval($data->number/3);
                for ($i=0;$i<$count;$i++){
                    $tmproom = new room_base();
                    $tmproom->set_competition_id($data->id);
                    $tmproom->set_gtype($data->type);
                    $tmproom->set_code(time());
                    $tmproom->set_starttime($data->starttime);
                    $tmproom->set_max(3);
                    $tmproom->set_top_index($data->index);
                    $tmproom->set_room_max($data->max);
                    $tmproom->set_advanced($data->advanced);
                    $tmproom->set_bstart(false);
                    $tmproom->set_bnumber($data->number);
                    $tmproom->set_top_list($data->top_list);
                    $this->rooms[$data->id][$data->type]['rooms_data'][0][$tmproom->get_code()]=$tmproom;
                    $this->rooms[$data->id][$data->type]['room_max'][0] = $data->max;
                    $this->rooms[$data->id][$data->type]['top_list'] = explode(",",$data->top_list);
                    $this->rooms[$data->id][$data->type]['top_list_str'] = $data->top_list;
                }
                break;
            default:
                break;
        }
    }

    /**
     * @return 获取可用房间
     */
    function get_empty_room(){
        foreach ($this->rooms as $room){
            if ($room->get_state()<=1){
                return $room;
            }
        }
    }

    /**
     * 玩家报名
     * @param $user_data =>[
     *                      'competition_id'=>1,
     *                      'user_id'=>1,
     *                      'game_type'=>1,
     *                      ]
     */
    function competition_sign_up($competition_id,$room_type,$user_id,$client_id)
    {
        if (is_array($this->users[$competition_id][$room_type]['socket_id']))
        {
            $number = count($this->users[$competition_id][$room_type]['socket_id']);
            if (count($this->users[$competition_id][$room_type]['socket_id']) < $this->rooms[$competition_id][$room_type]['room_max'][0])
            {
                $this->users[$competition_id][$room_type]['socket_id'][$user_id] = $client_id;
                $this->users[$competition_id][$room_type]['integral'][$user_id] = 0;
                send_notice($user_id,1,"报名成功！");
            }
        }
        else
        {
            $this->users[$competition_id][$room_type]['socket_id'][$user_id] = $client_id;
            $this->users[$competition_id][$room_type]['integral'][$user_id] = 0;
            send_notice($user_id,1,"报名成功！");
        }
    }

    /**
     * 进入房间
     * @param $room_id
     * @param $user=>[
     *              'userid'=>12312,
     *              'gender'=>0/1,
     *              'position'=>1,
     *              'integral'=>0,
     *              'level'=>1
     *              ]
     */
    function enter_room($room_id,$user)
    {
        if (isset($this->rooms)&&isset($this->rooms[$room_id])) {
            $this->rooms[$room_id]->user_enter($user);
        }
    }

    /**
     * 重新进入房间
     * @param $room_id
     * @param $user=>[
     *              'userid'=>12312,
     *              'gender'=>0/1,
     *              'position'=>1,
     *              'integral'=>0,
     *              'level'=>1
     *              ]
     */
    function reenter_room($room_id,$user)
    {
        if (isset($this->rooms)&&isset($this->rooms[$room_id])){
            $this->rooms[$room_id]->user_reenter($user);
        }
    }

    function roomGame_Calculation($competition_id,$room_type,$room_id,$index,$data)
    {
        echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@\n";
        if (isset($data))
        {
            foreach ($data as $userid => $item){
                $this->users[$competition_id][$room_type]['integral'][$index][$userid] = $item->gold;
            }

            if (isset($this->users[$competition_id][$room_type]['socket_id']) && count($this->users[$competition_id][$room_type]['socket_id']) == $this->rooms[$competition_id][$room_type]['room_max'][$index])
            {
                arsort($this->users[$competition_id][$room_type]['integral'][$index]);
                $competition_result = new SC_Competition_Result();
                $begin = 0;
                foreach ($this->users[$competition_id][$room_type]['socket_id'] as $uid => $socket)
                {
                    $competition_result->setCompetitionId($competition_id); //competition_id
                    $competition_end = new SC_Competition_Result_Competition_end();
                    $competition_end->setPlayerId($uid);
                    $competition_end->appendLevelUp($begin);
                    $competition_end->appendLevelUp($this->rooms[$competition_id][$room_type]['top_list'][$index]);
                    if ($begin < $this->rooms[$competition_id][$room_type]['top_list'][$index + 1])
                    {
                        $competition_end->setToUp(true);
                    }
                    else
                    {
                        $competition_end->setToUp(false);
                    }
                    $competition_result->setCompetition($competition_end); //competition
                    $competition_result->setTopList($this->rooms[$competition_id][$room_type]['top_list_str']);

                    if ($index + 1 == count($this->rooms[$competition_id][$room_type]['top_list']))
                    { //over
                        $competition_result->setOver(true);
                    }
                    else
                    {
                        $competition_result->setOver(false);
                    }
                    \GatewayWorker\Lib\Gateway::sendToClient($socket,my_pack(Message_Id::SC_Competition_Result_Id,$competition_result->serializeToString()));
                }
            }
        }
    }

    function JoinTheRoom($playerid,$roomid)
    {

    }

    /*
     * 用户创建比赛
     */
    function CreateCardRoom($client_id,$CreateCardRoom_data)
    {
        $collname='user_create_competition';
        $code = time();
        $signUpTime = $CreateCardRoom_data->getSignUpTime();
        $beginningTime = $CreateCardRoom_data->getBeginningTime();
        $db=mongo_db::singleton('func_system');
        $rows = [['Player_id' => $CreateCardRoom_data->getPlayerid(),
            'gameState' => 0,
            'ROOMTYPE' => ['roomType' => $CreateCardRoom_data->getRoomType(),
                'GAMETYPE' => ['gameType' => $CreateCardRoom_data->getGameType(),
                    'CODE' => [
                        'code'          => $code,
                        'players'       => $CreateCardRoom_data->getPlayers(),
                        'numberOfGames' => $CreateCardRoom_data->getNumberOfGames(),
                        /*
                        'signUpTime'    => [
                                'year'  => $signUpTime->getYear(),
                                'month' => $signUpTime->getMonth(),
                                'day'   => $signUpTime->getDay(),
                                'hour'  => $signUpTime->getHour(),
                                'minute'=> $signUpTime->getMinute()
                            ],
                        'beginningTime' => [
                                'year'  => $beginningTime->getYear(),
                                'month' => $beginningTime->getMonth(),
                                'day'   => $beginningTime->getDay(),
                                'hour'  => $beginningTime->getHour(),
                                'minute'=> $beginningTime->getMinute()
                            ],
                        */
                        'roomName'      => $CreateCardRoom_data->getRoomName(),
                        'roomExplain'   => $CreateCardRoom_data->getRoomExplain()
                    ]
                ]
            ]
        ]];
        $rs = $db->insert($collname, $rows);
        $Reult = new SC_CreateCardRoom();
        $Reult->setResult(1);
        $roominfotable = new RoomInfoTable();
        $roominfotable->setRoomId($code);
        if ($CreateCardRoom_data->getRoomType()==1)
        {
            $roominfotable->setGameText('地主');
        }
        elseif ($CreateCardRoom_data->getRoomType()==2)
        {
            $roominfotable->setGameText('麻将');
        }
        $roominfotable->setNameText($CreateCardRoom_data->getRoomName());
        if ($CreateCardRoom_data->getGameType() == 1)
        {
            $roominfotable->setTypeText('晋级赛');
        }
        elseif ($CreateCardRoom_data->getGameType() == 2)
        {
            $roominfotable->setTypeText('积分赛');
        }
        $roominfotable->setPlayerNum(0);
        $roominfotable->setplayerMax($CreateCardRoom_data->getPlayers());
        //$roominfotable->setSignUpTime($CreateCardRoom_data->getSignUpTime());
        //$roominfotable->setBeginningTime($CreateCardRoom_data->getBeginningTime());
        $roominfotable->setGameState(0);
        $Reult->setRoomInfo($roominfotable);
        \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(Message_Id::SC_CreateCardRoom_Id,$Reult->serializeToString()));

    }

    /*
     * 初始化房间
     */
    function RoomInfoTable($client_id,$playerid)
    {
        $collname='user_create_competition';
        $mongodb=mongo_db::singleton('func_system');
        $filter = [
            'Player_id'  => $playerid //['$gt' => date('Y-m-d H:i:s')] //条件：大于当前时间
        ];
        $queryWriteOps = [
            'projection'    => ['_id'   =>0],//不输出_id字段
            'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
        ];
        $rs = $mongodb->query($collname,$filter,$queryWriteOps);
        $roominfotable_array = new SC_RoomInfoTable();
        foreach ($rs as $data)
        {
            $roominfo = new RoomInfoTable();
            if ($data->ROOMTYPE->roomType == 1)
            {
                $roominfo->setGameText('地主');
            }
            elseif ($data->ROOMTYPE->roomType == 2)
            {
                $roominfo->setGameText('麻将');
            }
            if ($data->ROOMTYPE->GAMETYPE->gameType == 1)
            {
                $roominfo->setTypeText('晋级赛');
            }
            elseif ($data->ROOMTYPE->GAMETYPE->gameType == 2)
            {
                $roominfo->setTypeText('积分赛');
            }
            $roominfo->setRoomId($data->ROOMTYPE->GAMETYPE->CODE->code);
            $roominfo->setPlayerNum(0);
            $roominfo->setPlayerMax($data->ROOMTYPE->GAMETYPE->CODE->players);
            /*
            $timeinfo = new TimeInfo();
            $timeinfo->setYear($data->ROOMTYPE->GAMETYPE->CODE->signUpTime->year);
            $timeinfo->setMonth($data->ROOMTYPE->GAMETYPE->CODE->signUpTime->month);
            $timeinfo->setDay($data->ROOMTYPE->GAMETYPE->CODE->signUpTime->day);
            $timeinfo->setHour($data->ROOMTYPE->GAMETYPE->CODE->signUpTime->hour);
            $timeinfo->setMinute($data->ROOMTYPE->GAMETYPE->CODE->signUpTime->minute);
            $roominfo->setSignUpTime($timeinfo);
            $timeinfo->setYear($data->ROOMTYPE->GAMETYPE->CODE->beginningTime->year);
            $timeinfo->setMonth($data->ROOMTYPE->GAMETYPE->CODE->beginningTime->month);
            $timeinfo->setDay($data->ROOMTYPE->GAMETYPE->CODE->beginningTime->day);
            $timeinfo->setHour($data->ROOMTYPE->GAMETYPE->CODE->beginningTime->hour);
            $timeinfo->setMinute($data->ROOMTYPE->GAMETYPE->CODE->beginningTime->minute);
            $roominfo->setBeginningTime($timeinfo);
            */
            $roominfo->setNameText($data->ROOMTYPE->GAMETYPE->CODE->roomName);
            $roominfo->setGameState($data->gameState);

            $roominfotable_array->appendRoomInfo($roominfo);
        }
        \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(Message_Id::SC_RoomInfoTable_Id,$roominfotable_array->serializeToString()));
    }
    /*
     * 删除房间
     */
    function delRoom($playerid,$roomid)
    {

    }
}

?>//php