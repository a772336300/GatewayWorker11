<?php

use Proto\Message_Id;
use Proto\SC_Competition_Result_Competition_end_gold;
use Proto\SC_Competition_Result_Competition_end;
use Proto\SC_Competition_Result;
use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;

require_once 'room_base.php';
require_once 'user.php';

//require_once 'xzdd\game_xzdd.php';

//global


final class room_manager{
    /**
     * $rooms[game_type][index]
     */
    private $rooms;          //房间容器
    private static $ins;     //房间管理实例
    private $user_number;    //房间人数
    private $users;          //报名用户ID
    private $__time_id_read;
    private $__time_id_start;

    private function __construct() {
        echo sprintf("room manager construct %s\n",date("Y-m-d H:i:s"));
        //self::$ins=null;
        $this->user_number=0;
        $this->user_ids=null;
        $this->rooms=null;          //房间
        $this->__time_id_read=Timer::add(20,function (){
            $this->room_loop();
        },true);
    }


    function __destruct() {
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
    function start_game_room(){
        $this->__timer_id_read=Timer::add(20,function (){
            if (isset($this->rooms)) {
                //$competition_id = $this->rooms[competition_id]
                foreach ($this->rooms as $competition_id) {
                    //$room_type = $this->rooms[competition_id][room_type]
                    foreach ($competition_id as $room_type) {
                        //$config = $this->rooms[competition_id][room_type][['rooms_data'],['room_max'],['top_list'],['top_list_str']]
                        foreach ($room_type as $key => $config) {
                            if ($key == 'rooms_data') {
                                //$index = $this->rooms[competition_id][room_type]['rooms_data'][index]
                                foreach ($config as $index) {
                                    //$room = $this->rooms[competition_id][room_type]['rooms_data'][index][code]
                                    foreach ($index as $roomcode => $room){
                                        if ($room->get_bsend_start() == false) {
                                            if ($room->get_number() == $room->get_max()) {
                                                $sc_star = new \Proto\SC_ComPetition_Start();
                                                $sc_star->setCompetitionId($room->get_competition_id());
                                                $sc_star->setGameType($room->get_gtype());
                                                $users = $room->get_user_all();
                                                echo sprintf("start_game_room %s\n",date("Y-m-d H:i:s"));
                                                foreach ($users as $user) {
                                                    \GatewayWorker\Lib\Gateway::sendToClient($user->client_id,my_pack(Message_Id::SC_ComPetition_Start_Id,$sc_star->serializeToString()));
                                                }
                                                $room->set_bsend_start(true);
                                            }
                                        }
                                        if ($room->get_bstart() == false) {
                                            if ($room->get_bnumber() == true) {  //人满开
                                                if ($room->get_number() == $room->get_max()) {
                                                    //if ($m->get_top_index() + 1 == count($m->get_top_list())){
                                                    $user_ids = $room->get_user_id_all();
                                                    roomInit($user_ids,$room->get_gtype(), $room->get_code(), $room->get_competition_id(), $room->get_top_index());
                                                    $room->set_bstart(true);
                                                    //}
                                                }
                                                //roomInit()
                                            }else{  //定时开
                                                if ($room->get_bstart() == true || strtotime(date("Y-m-d H:i:s")) == strtotime($room->get_starttime())) {
                                                    echo sprintf("start time: %s \n", $room->get_starttime());
                                                    if ($room->get_top_index() + 1 == count($room->get_top_list())){
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
                            elseif ($key == 'room_max')
                            {

                            }
                            elseif ($key == 'top_list')
                            {

                            }
                            elseif ($key == 'top_list_str')
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
    function room_loop(){
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
        foreach ($rs as $data){
            if (!isset($this->rooms[$data->id])){
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
    function competition_sign_up($competition_id,$room_type,$user_id,$client_id){
        if (isset($this->rooms[$competition_id][$room_type][0])){
            if (count($this->users[$competition_id][$room_type][0]) == $this->rooms[$competition_id][$room_type][0]['room_max']){
                $this->users[$competition_id][$room_type][0]['socket_id'][$user_id] = $client_id;
                $this->users[$competition_id][$room_type][0]['integral'][$user_id] = 0;
                send_notice($user_id,1,"报名成功！");
            }
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
    function enter_room($room_id,$user){
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
    function reenter_room($room_id,$user){
        if (isset($this->rooms)&&isset($this->rooms[$room_id])){
            $this->rooms[$room_id]->user_reenter($user);
        }
    }

    function roomGame_Calculation($competition_id,$room_type,$room_id,$index,$data){
        if (isset($this->rooms[$competition_id][$room_type][$room_id])){
            foreach ($data as $userid => $item){
                $this->users[$competition_id][$room_type][$index]['integral'][$userid] = $item->gold;
            }

            if (count($this->users[$competition_id][$room_type][$index]['socket_id']) == $this->rooms[$competition_id][$room_type][$index]['room_max']){
                arsort($this->users[$competition_id][$room_type][$index]['integral']);
                /**
                 * message SC_Competition_Result
                {
                optional int32  Competition_id  = 1;
                message Competition_end
                {
                optional int32  playerId    = 1;
                repeated int32  levelUp     = 2;    //赛制
                optional bool   to_up       = 3;    //晋级
                message gold
                {
                optional int32  id      = 1;
                optional int32  number  = 2;
                }
                repeated gold  golds        = 4;    //奖励
                }
                optional Competition_end    competition = 2;
                optional string              top_list    = 3;
                optional bool               over        = 4;    //所有比赛结束
                }
                 */
                $competition_result = SC_Competition_Result();
                $begin = 0;
                foreach ($this->users[$competition_id][$room_type][$index]['integral'] as $uid => $integral){
                    $competition_end = SC_Competition_Result_Competition_end();
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
                }

                $gold = SC_Competition_Result_Competition_end_gold();
                $competition_result->setCompetitionId($competition_id);

                foreach ($this->users[$competition_id][$room_type][$index]['socket_id'] as $id => $socket){
                    //foreach ($this->rooms[$competition_id][$room_type]['to_list'] as $)
                    $competition_result->setCompetitionId($id); //competition_id


                    $competition_result->appendCompetition(); //competition

                    foreach ($this->rooms[$competition_id][$room_type]['top_list'] as $num){ //top_list
                        $competition_result->appendTopList($num);
                    }
                    if ($index + 1 == count($this->rooms[$competition_id][$room_type]['top_list'])){ //over
                        $competition_result->setOver(true);
                    }
                    else
                    {
                        $competition_result->setOver(false);
                    }
                    $begin++;
                    \GatewayWorker\Lib\Gateway::sendToClient($socket,my_pack(Message_Id::SC_Competition_Result_Id,$competition_result->serializeToString()));
                }


            }
            //unset($this->rooms[$competition_id][$room_type][$index][$room_id]);
        }
    }
}

?>//php