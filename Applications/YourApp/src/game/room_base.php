<?php

use user;
class room_base{
    private static $gtype;      //房间类型
    private static $code;       //房间编号
    private static $number;     //当前人数
    private static $max;        //最大人数
    private static $users;      //用户容器
    public  static $room_type=['ddz','xzdd'];

    function __construct(){
        self::$users=null;
        self::$gtype=self::$room_type[0];
        self::$code=0;
        self::$number=0;
        self::$max=0;
    }

    function set_gtype($variable){
        self::$gtype=$variable;
    }

    function get_gtype(){
        return self::$gtype;
    }

    function set_code($variable){
        self::$code=$variable;
    }

    function get_code(){
        return self::$code;
    }

    function set_max($variable){
        self::$max=$variable;
        for ($i=0;i<self::$max;$i++){
            self::$users[$i]=new user();
        }
    }

    function get_max(){
        return self::$max;
    }

    function user_enter($variable){
        if (self::$number<self::$max){
            self::$users[self::$number]->userid=$variable[0]['userid'];
            self::$users[self::$number]->gender=$variable[0]['gender'];
            self::$users[self::$number]->position=self::$number;
            self::$users[self::$number]->integral=$variable[0]['integral'];
            self::$users[self::$number]->level=$variable[0]['level'];
            self::$number++;
        }
    }

    function user_reenter($variable){
        if (self::$users[$variable[0]['position']]){
            self::$users[$variable[0]['position']]->userid=$variable[0]['userid'];
            self::$users[$variable[0]['position']]->gender=$variable[0]['gender'];
            self::$users[$variable[0]['position']]->position=self::$number;
            self::$users[$variable[0]['position']]->integral=$variable[0]['integral'];
            self::$users[$variable[0]['position']]->level=$variable[0]['level'];
        }
    }

    function user_exit($position){
        if (self::$number>0){
            $tmpuser=self::$users[$position];
            self::$users[$position]->userid=-1;
            self::$users[$position]->gender=-1;
            self::$users[$position]->position=-1;
            self::$users[$position]->integral=-1;
            self::$users[$position]->level=-1;
            self::$number--;
            return $tmpuser;
        }
    }

    function get_number(){
        return self::$number;
    }

    function get_user($position){
        if ($position>self::$number||$position<0){
            return null;
        }else{
            return self::$users[$position];
        }
    }

    function get_user_all(){
        return self::$users;
    }

}