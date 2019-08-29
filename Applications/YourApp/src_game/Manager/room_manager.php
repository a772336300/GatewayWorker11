<?php

use Proto\Message_Id;
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
                foreach ($this->rooms as $room) {
                    foreach ($room as $tmp) {
                        foreach ($tmp as $m) {
                            if ($m->get_bsend_start() == false) {
                                if ($m->get_number() == $m->get_max()) {
                                    $sc_star = new \Proto\SC_ComPetition_Start();
                                    $sc_star->setCompetitionId($m->get_gtype());
                                    $sc_star->setGameType($m->get_gtype());
                                    $users = $m->get_user_all();
                                    echo sprintf("start_game_room %s\n",date("Y-m-d H:i:s"));
                                    foreach ($users as $user) {
                                        \GatewayWorker\Lib\Gateway::sendToClient($user->client_id,my_pack(Message_Id::SC_ComPetition_Start_Id,$sc_star->serializeToString()));
                                    }
                                    $m->set_bsend_start(true);
                                }
                            }
                            if ($m->get_bstart() == false) {
                                if ($m->get_bnumber() == true) {  //人满开
                                    if ($m->get_number() == $m->get_max()) {
                                        //if ($m->get_top_index() + 1 == count($m->get_top_list())){
                                            $user_ids = $m->get_user_id_all();
                                            roomInit($user_ids,$m->get_gtype());
                                            $m->set_bstart(true);
                                        //}
                                    }
                                    //roomInit()
                                }else{  //定时开
                                    if ($m->get_bstart() == true || strtotime(date("Y-m-d H:i:s")) == strtotime($m->get_starttime())) {
                                        echo sprintf("start time: %s \n", $tmp->get_starttime());
                                        if ($m->get_top_index() + 1 == count($m->get_top_list())){
                                            roomInit($m->get_user_id_all(),$m->get_gtype());
                                            $m->set_bstart(true);
                                        }
                                    }
                                }
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
                    $tmproom->set_gtype($data->type);
                    $tmproom->set_code(time());
                    $tmproom->set_starttime($data->starttime);
                    $tmproom->set_max(3);
                    $tmproom->set_advanced($data->advanced);
                    $tmproom->set_bstart(false);
                    $tmproom->set_bnumber($data->number);
                    $this->rooms[$data->id][$data->type][$tmproom->get_code()]=$tmproom;
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
        if (isset($this->rooms[$competition_id][$room_type])){
            /*
            $collname='game_competition';
            $mongodb=mongo_db::singleton('func_system');
            $filter = [
                    'id' => $competition_id
            ];
            $queryWriteOps = [
                'projection'    => ['_id'   =>0],//不输出_id字段
                'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
            ];
            $rs = $mongodb->query($collname,$filter,$queryWriteOps);
            */
            foreach ($this->rooms[$competition_id][$room_type] as $room) {
                if ($room->get_number() < $room->get_max()) {
                    $room->user_enter($user_id,$client_id);
                    send_notice($user_id,1,"报名成功！");
                    break;
                }
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
}

?>//php