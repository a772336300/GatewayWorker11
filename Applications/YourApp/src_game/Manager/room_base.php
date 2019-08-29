<?php

require_once 'user.php';
class room_base{
    private $gtype;     //房间类型
    private $starttime; //开始时间
    private $code;      //房间编号
    private $number;    //当前人数
    private $max;       //最大人数
    private $users;     //用户容器
    private $advanced;  //进阶比(1、2，3人进阶)
    private $state;     //状态 0空 1有人 2满人 3满开
    private $bstart;    //是否开始
    private $bnumber;   //是否是人满开
    private $top_list;  //进阶列表
    private $top_index; //进阶索引
    private $bsend_start;   //是否开始通知

    function __construct(){
        $this->users=null;
        $this->gtype=\Proto\Room_Type::bisai_dizhu;
        $this->starttime=null;
        $this->code=0;
        $this->number=0;
        $this->max=0;
        $this->state=0;
        $this->bstart=false;
        $this->top_list=[120,90,60,30,9,3,1];
        $this->top_index=0;
        $this->bsend_start=false;
    }

    function set_bsend_start($vale){
        $this->bsend_start=$vale;
    }

    function get_bsend_start(){
        return $this->bsend_start;
    }

    function set_bnumber($vale){
        $this->bnumber=$vale;
    }

    function get_bnumber(){
        return $this->bnumber;
    }

    function set_top_list($vale){
        $this->top_list=$vale;
    }

    function get_top_list(){
        return $this->top_list;
    }

    function set_top_index($vale){
        $this->top_index=$vale;
    }

    function get_top_index(){
        return $this->top_index;
    }

    function set_gtype($vale){
        $this->gtype=$vale;
    }

    function get_gtype(){
        return $this->gtype;
    }

    function set_bstart($vale){
        $this->bstart=$vale;
    }

    function get_bstart(){
        return $this->bstart;
    }

    function set_advanced($vale){
        $this->advanced=$vale;
    }

    function get_advanced(){
        return $this->advanced;
    }

    function set_starttime($vale){
        $this->starttime=$vale;
    }

    function get_starttime(){
        return $this->starttime;
    }

    function set_code($vale){
        $this->code=$vale;
    }

    function get_code(){
        return $this->code;
    }

    function set_max($vale){
        $this->max=$vale;
        for ($i=0;$i<$this->max;$i++){
            $this->users[$i]=new user();
        }
    }

    function get_state(){
        return $this->state;
    }

    function get_max(){
        return $this->max;
    }

    /**
     * @param $vale =>[
     *                  'userid',   //用户ID
     *                  'gender',   //性别
     *                  'position', //坐位
     *                  'integral', //积分
     *                  'level'     //等级
     *                  ]
     */
    function user_enter($user_id,$client_id){
        if ($this->number < $this->max){
            foreach ($this->users as $user){
                if ($user->userid == $user_id){
                    return;
                }
            }
            $this->users[$this->number]->client_id  = $client_id;
            $this->users[$this->number]->userid     = $user_id;
            /*
            $this->users[$this->number]->userid=$vale['userid'];
            $this->users[$this->number]->gender=$vale['gender'];
            $this->users[$this->number]->position=$this->number;
            $this->users[$this->number]->integral=$vale['integral'];
            $this->users[$this->number]->level=$vale['level'];
            */
            $this->number++;
            if ($this->number==$this->max){
                $this->state=2;
            }else{
                $this->state=1;
            }
        }
    }

    /**
     * @param $vale =>[
     *                  'userid',   //用户ID
     *                  'gender',   //性别
     *                  'position', //坐位
     *                  'integral', //积分
     *                  'level'     //等级
     *                  ]
     */
    function user_reenter($vale){
        if ($this->users[$vale['position']]){
            $this->users[$vale['position']]->userid=$vale['userid'];
            $this->users[$vale['position']]->gender=$vale['gender'];
            $this->users[$vale['position']]->position=$this->number;
            $this->users[$vale['position']]->integral=$vale['integral'];
            $this->users[$vale['position']]->level=$vale['level'];
        }
    }

    /**
     * @param $position 玩家在桌子中的位置
     * @return 退出玩家信息
     */
    function user_exit($position){
        if ($this->number>0){
            $tmpuser=$this->users[$position];
            $this->users[$position]->userid=-1;
            $this->users[$position]->gender=-1;
            $this->users[$position]->position=-1;
            $this->users[$position]->integral=-1;
            $this->users[$position]->level=-1;
            $this->number--;
            if ($this->number==0){
                $this->state=0;
            }
            return $tmpuser;
        }
    }

    /**
     * @return 返回当前人数
     */
    function get_number(){
        return $this->number;
    }

    /**
     * @param $position 玩家在桌子中的位置
     * @return 玩家信息
     */
    function get_user($position){
        if ($position>$this->number||$position<0){
            return null;
        }else{
            return $this->users[$position];
        }
    }

    /**
     * @return 所有玩家信息
     */
    function get_user_all(){
        return $this->users;
    }

    function get_user_id_all(){
        $userids = [];
        foreach ($this->users as $user){
            array_push($userids,$user->userid);
        }
        return $userids;
    }

}