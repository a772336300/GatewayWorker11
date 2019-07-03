<?php
use Workerman\Lib\Timer;
use GatewayWorker\Lib\Gateway;
use Events;
use room_base;
use user;

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
        switch ($game_type)
        {
            case room_base::$room_type[0]:
                $tmproom=new room_base();
                $tmproom->set_code(time());
                $tmproom->set_max(3);
                self::$rooms[$tmproom->get_code()]=$tmproom;
                break;
            case room_base::$room_type[1]:
                $tmproom=new room_base();
                $tmproom->set_code(time());
                $tmproom->set_max(4);
                self::$rooms[$tmproom->get_code()] = $tmproom;
                break;
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