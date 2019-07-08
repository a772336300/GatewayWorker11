<?php

use user;
class room_base{
    private static $gtype;      //房间类型
    private static $starttime;   //开始时间
    private static $code;       //房间编号
    private static $number;     //当前人数
    private static $max;        //最大人数
    private static $users;      //用户容器
    private static $advanced;   //进阶比(1、2，3人进阶)
    private static $state;      //状态 0空 1有人 2满人 3满开
    public  static $room_type=['ddz','xzdd'];

    function __construct(){
        self::$users=null;
        self::$gtype=self::$room_type[0];
        self::$starttime=null;
        self::$code=0;
        self::$number=0;
        self::$max=0;
        self::$state=0;
    }

    function set_gtype($vale){
        self::$gtype=$vale;
    }

    function get_gtype(){
        return self::$gtype;
    }

    function set_advanced($vale){
        self::$advanced=$vale;
    }

    function get_advanced(){
        return self::$advanced;
    }

    function set_starttime($vale){
        self::$starttime=$vale;
    }

    function get_starttime(){
        return self::starttime;
    }

    function set_code($vale){
        self::$code=$vale;
    }

    function get_code(){
        return self::$code;
    }

    function set_max($vale){
        self::$max=$vale;
        for ($i=0;i<self::$max;$i++){
            self::$users[$i]=new user();
        }
    }

    function get_state(){
        return self::$state;
    }

    function get_max(){
        return self::$max;
    }

    function user_enter($vale){
        if (self::$number<self::$max){
            self::$users[self::$number]->userid=$vale[0]['userid'];
            self::$users[self::$number]->gender=$vale[0]['gender'];
            self::$users[self::$number]->position=self::$number;
            self::$users[self::$number]->integral=$vale[0]['integral'];
            self::$users[self::$number]->level=$vale[0]['level'];
            self::$number++;
            if (self::$number==self::$max){
                self::$state=2;
            }else{
                self::$state=1;
            }
        }
    }

    function user_reenter($vale){
        if (self::$users[$vale[0]['position']]){
            self::$users[$vale[0]['position']]->userid=$vale[0]['userid'];
            self::$users[$vale[0]['position']]->gender=$vale[0]['gender'];
            self::$users[$vale[0]['position']]->position=self::$number;
            self::$users[$vale[0]['position']]->integral=$vale[0]['integral'];
            self::$users[$vale[0]['position']]->level=$vale[0]['level'];
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
            if (self::$number==0){
                self::$state=0;
            }
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