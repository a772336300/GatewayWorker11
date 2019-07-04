<?php
use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;
use Events;
use room_base;
use user;
use mongo_db;

//global


class room_manager{
    /**
     * $rooms[game_type][index]
     */
    private static $rooms;          //房间容器
    private static $ins;            //房间管理实例
    private static $user_number;    //房间人数

    private function __construct() {
        self::$ins=null;
        self::$user_number=0;
        self::$rooms=null;          //房间
    }

    function __destruct() {
        //delete self::$ins;
        self::$user_number=0;
    }

    static function singleton()
    {
        if (!isset(self::$ins))
        {
            self::$ins=new room_manager();
        }
        return self::$ins;
    }

    //创建房间
    private function create_room($game_type)
    {
        $collname='gmae_Competition';
        $mongodb=mongo_db::singleton('func_system');

        switch ($game_type)
        {
            case room_base::$room_type[0]:
                $filter = [
                    "type" => ['$eq' => room_base::$room_type[0]]//查询条件 type 等于 ddz
                ];
                $queryWriteOps = [
                    "projection" => ["_id"=> 0],//不输出_id字段
                    "sort"       => ["id" => 1],//根据id字段排序 1是升序，-1是降序
                    "limit"      => 1
                ];
                $rs = $mongodb->query($collname, $filter, $queryWriteOps);
                for ($i=0;$i<$rs[0]['number'];$i++){
                    $tmproom=new room_base();
                    $tmproom->set_code(time());
                    $tmproom->set_max(3);
                    self::$rooms[$tmproom->get_code()]=$tmproom;
                }
                break;
            case room_base::$room_type[1]:
                $filter = [
                    "type" => ['$eq' => room_base::$room_type[1]]//查询条件 type 等于 xzdd
                ];
                $queryWriteOps = [
                    "projection" => ["_id"=> 0],//不输出_id字段
                    "sort"       => ["id" => 1],//根据id字段排序 1是升序，-1是降序
                    "limit"      => 1
                ];
                $rs = $mongodb->query($collname, $filter, $queryWriteOps);
                for ($i=0;$i<$rs[0]['number'];$i++){
                    $tmproom=new room_base();
                    $tmproom->set_code(time());
                    $tmproom->set_max(4);
                    self::$rooms[$tmproom->get_code()] = $tmproom;
                }
                break;
        }
    }

    //获取可用房间
    private function get_empty_room(){
        foreach (self::$rooms as $room){
            if ($room->get_state()<=1){
                return $room;
            }
        }
    }

    //进入房间
    private function enter_room($room_id,$user)
    {
        if (isset(self::$rooms)&&isset(self::$rooms[$room_id])) {
            self::$rooms[$room_id]->user_enter($user);
        }
    }

    //重新进入房间
    private function reenter_room($room_id,$user)
    {
        if (isset(self::$rooms)&&isset(self::$rooms[$room_id])){
            self::$rooms[$room_id]->user_reenter($user);
        }
    }
}

?>//php