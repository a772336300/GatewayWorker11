<?php
use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;
use Events;
use room_base;
use user;
use mongo_db;
use game_xzdd;

//global


class room_manager{
    /**
     * $rooms[game_type][index]
     */
    private static $rooms;          //房间容器
    private static $ins;            //房间管理实例
    private static $user_number;    //房间人数
    private static $__timer_id_read;
    private static $__time_id_start;

    private function __construct() {
        self::$ins=null;
        self::$user_number=0;
        self::$rooms=null;          //房间
        self::$__timer_id_read=Timer::add(20,function (){
            $this->room_loop();
        },true);
    }

    function __destruct() {
        //delete self::$ins;
        self::$user_number=0;
        Timer::del(self::$__timer_id_read);
        Timer::del(self::$__time_id_start);
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
    private function start_game(){
        self::$__timer_id_read=Timer::add(20,function (){
            foreach (self::$rooms as $room){
                foreach ($room as $tmp){
                    if (strtotime(date("Y-m-d H:i:s")) == strtotime($tmp['starttime'])){
                        //此处添加游戏启动代码
                        /**
                         * @var $params = [
                         *           'is_last_card' => 1,
                         *           'is_zi_mo' => 1,
                         *           'is_gang_mo_pai' => 0,
                         *           'is_qiang_gang_hu' => 0,
                         *           'ming_gang_count' => 0,
                         *           'an_gang_count' => 0,
                         *           'is_hu_jue_zhang' => 0,
                         *           'men_fen' => 2,
                         *           'quan_fen' => 1,
                         *           'hu_card' => 11,
                         *           'is_ting' => 0,
                         *           'flower_count' => 1,
                         *           'mj_type' => 1,
                         *           'play_count =>4
                         *      ]
                         */
                        $game = new game_xzdd();
                    }
                }
            }
        });
    }

    /**
     * 读取数据库，查询赛制，建立房间
     */
    private function room_loop(){
        $collname='gmae_competition';
        $mongodb=mongo_db::singleton('func_system');
        $filter = [
                'starttime'  => ['$gt' => date('Y-m-d H:i:s')] //条件：大于当前时间
        ];
        $queryWriteOps = [
                'projection'    => ['_id'   =>0],//不输出_id字段
                'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
        ];
        $rs = $mongodb->query($collname,$filter,$queryWriteOps);
        foreach ($rs[0] as $data){
            if (!isset(self::$rooms[$data['id']])){
                $this->create_room($data);
            }
        }
    }

    /**
     * @param $data =>[
     *                  'id'=>1,
     *                  'type'=>'ddz'/'xzdd',
     *                  'bnumber'=>0/1
     *                  'number'=>100,
     *                  'advanced'=>1,
     *                  'max'=>5,
     *                  'starttime'=>'2019-07-08 14:49:05'
     *                  ]
     */
    private function create_room($data)
    {
        switch ($data['type'])
        {
            case room_base::$room_type[0]:
                $count = $data['number']/3;
                for ($i=0;$i<$count;$i++){
                    $tmproom = new room_base();
                    $tmproom->set_code(time());
                    $tmproom->set_starttime($data['starttime']);
                    $tmproom->set_max(3);
                    $tmproom->set_advanced($data['advanced']);
                    self::$rooms[$data['id']][$tmproom->get_code()]=$tmproom;
                }
                break;
            case room_base::$room_type[1]:
                $count = $data['number']/4;
                for ($i=0;$i<$count;$i++){
                    $tmproom = new room_base();
                    $tmproom->set_code(time());
                    $tmproom->set_starttime($data['starttime']);
                    $tmproom->set_max(4);
                    $tmproom->set_advanced($data['advanced']);
                    self::$rooms[$data['id']][$tmproom->get_code()] = $tmproom;
                }
                break;
        }
    }

    /**
     * @return 获取可用房间
     */
    private function get_empty_room(){
        foreach (self::$rooms as $room){
            if ($room->get_state()<=1){
                return $room;
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
    private function enter_room($room_id,$user)
    {
        if (isset(self::$rooms)&&isset(self::$rooms[$room_id])) {
            self::$rooms[$room_id]->user_enter($user);
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
    private function reenter_room($room_id,$user)
    {
        if (isset(self::$rooms)&&isset(self::$rooms[$room_id])){
            self::$rooms[$room_id]->user_reenter($user);
        }
    }
}

?>//php