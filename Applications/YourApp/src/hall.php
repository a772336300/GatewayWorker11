<?php
use MongoDB\BSON\ObjectID;
use \Workerman\Lib\Timer;
require_once 'util.php';
function hall_message_switch($mid,$data){
//    $_SESSION['uid']=8823;
    $uid=$_SESSION['uid'];
    echo "获取大厅信息mid：$mid--uid--$uid\n";
    $hall_config = mongo_db::singleton("hall_config");
    $hall_log = mongo_db::singleton("hall_log");
    switch ($mid){
        //修改头像信息
        case 20001:
            $user_touxiang = new \Proto\CS_User_TouXiang_Update();
            $user_touxiang->parseFromString($data);
            $touxiang=$user_touxiang->getTouxiang();
            $sql="update user set touxiang='$touxiang' where uid=$uid";
            $is_success = true;
            if(db_query($sql)==null){
                $is_success = false;
            }
            send_pack_user_touxiang_update($uid,$is_success);
            break;
        //获取邮件
        case 20003:
            //查询有效期内的系统邮件
            //获取系统时间
            $nowTime=date('Y-m-d h:i:s', time());
            $a=time();
            echo "\n---------- 查询系统邮件数据 -----------\n";
            $filter = [
                "start_time" => ['$lt' => $a],//查询条件 开始时间 大于 当前时间
                "end_time" => ['$gt' => $a],//查询条件 结束时间 小于 当前时间
                "uid" => ""//
            ];
            $queryWriteOps = [
                "projection" => ["_id"=> 0],//不输出_id字段
                "sort"       => ["add_time" => -1],//根据添加时间字段排序 1是升序，-1是降序
            ];
            $collname='sys_mail';
            $rs = $hall_config->query($collname, $filter, $queryWriteOps);
            $collname='user_mail';
            $rows=array();
            foreach ($rs as $r) {
                $filter = [
                    "sid" => $r->id,
                    "uid" => $uid,
                ];
                $queryWriteOps = [
                    "projection" => ["_id"=> 0],//不输出_id字段
                ];
                $rmsg = $hall_log->query($collname, $filter, $queryWriteOps);
                print_r($rmsg);
                if(count($rmsg)==0){
                    echo "\n------------ 插入邮件数据 ---------\n";
                    $newArr=["sid" => $r->id,"title"=>$r->title,"content"=>$r->content,"start_time"=>$r->start_time,"end_time"=>$r->end_time,'attach'=>$r->attach,'isread'=>0,'isdelete'=>false,'get_attach'=>false,'uid'=>$uid];
                    array_push($rows,$newArr);
                }
            }
            if(count($rows)>0){
                $rs = $hall_log->insert($collname, $rows);
            }
            //获取所有未删除和没过期的邮件
            $filter = [
                "start_time" => ['$lt' => $a],//查询条件 开始时间 小于 当前时间
                "end_time" => ['$gt' => $a],//查询条件 结束时间 大于 当前时间
                "isdelete" => false,
                "uid" => $uid,
            ];
            $queryWriteOps = [
                "sort"       => ["isread" => 1],//根据id字段排序 1是升序，-1是降序
            ];
            $rmsg = $hall_log->query($collname, $filter, $queryWriteOps);
            echo "最终输出：\n";
            print_r($rmsg);
            send_pack_get_user_mail($uid,true,$rmsg);
            break;
        //已读邮件
        case 20005:
            $user_mail_read = new \Proto\CS_User_Mail_Read();
            $user_mail_read->parseFromString($data);
            $_id=$user_mail_read->getId();
            $updates = [
                [
                    "q"     => ["_id" => new ObjectId($_id)],
                    "u"     => ['$set' => ["isread" => 1]],
                    'multi' => false, 'upsert' => false
                ]
            ];
            $collname="user_mail";
            $rs = $hall_log->update($collname, $updates);
            print_r($rs->toArray());
            send_pack_user_mail_read($uid,true);
            break;
        //一键删除邮件
        case 20007:
            $user_mail_delete = new \Proto\CS_User_Mail_Delete();
            $user_mail_delete->parseFromString($data);
            $_ids=$user_mail_delete->getId();
            $collname="user_mail";
            foreach ($_ids as $id) {
                $updates = [
                    [
                        "q"     => ["_id" => new ObjectId($id)],
                        "u"     => ['$set' => ["isdelete" => true]],
                        'multi' => false, 'upsert' => false
                    ]
                ];
                $rs = $hall_log->update($collname, $updates);
                print_r($rs->toArray());
            }
            send_pack_user_mail_delete($uid,true);
            break;
        //获取排行榜
        case 20009:
            $get_rank_type = new \Proto\CS_User_Get_Rank();
            $get_rank_type->parseFromString($data);
            $type=$get_rank_type->getType();
            $start_time=get_today_zero_time();
            if($type==2){//获取本周排行
                $start_time=get_week_zero_time();
            }else if($type==3){//获取本月排行
                $start_time=get_month_zero_time();
            }
            //查询前100名

            $cmd = [
                'aggregate' => 'game_log',
                'pipeline' => [
                    ['$match' => [ 'game_time' => ['$gte'=>$start_time],'score'=>['$gt'=>0]]],
                    ['$group' => [ '_id' => ['uid'=>'$uid'], 'win_num' => ['$sum'=>1] ] ],
                    ['$limit' => 100],
                    ['$project'=>['uid'=>'$_id.uid','win_num'=>'$win_num']],
                    ['$sort'=>['win_num'=>-1]]
                ],
                'cursor' => new \stdClass,
            ];
            $cursor = $hall_log->aggregate($cmd);
            echo "----";
            $i=1;
            $obj = new stdClass;
            $obj->rank=0;
            foreach ($cursor as $document) {
                print_r($document);
                $document->rank=$i;
                $sql="select name,touxiang from bolaik_db.user where uid=$document->uid";
                $user_info=db_query($sql)[0];
                $document->name=$user_info['name'];
                $document->touxiang=$user_info['touxiang'];
                if($document->uid==$uid){
                    $obj->rank=$i;
                    $obj->uid=$document->uid;
                    $obj->name=$document->name;
                    $obj->touxiang=$document->touxiang;
                    $obj->win_num=$document->win_num;
                }
                $i++;
            }
            echo "cursor:";
            print_r($cursor);
            //
            if($obj->rank==0){
                //查询用户基本信息
                $sql="SELECT uid,name,touxiang FROM `bolaik_db`.`user` where uid=$uid";
                $userInfo=db_query($sql);
                $obj->rank=0;
                $obj->uid=$userInfo[0]['uid'];
                $obj->name=$userInfo[0]['name'];
                $obj->touxiang=$userInfo[0]['touxiang'];
                //查询用户胜局
                $win_num=0;
                $cmd = [
                    'aggregate' => 'game_log',
                    'pipeline' => [
                        ['$match' => [ 'uid'=>$uid,'game_time' => ['$gte'=>$start_time],'score'=>['$gt'=>0]]],
                        ['$project'=>['win_num'=>['$sum'=>1]]],
                    ],
                    'cursor' => new \stdClass,
                ];
                $cursor_count = $hall_log->aggregate($cmd);
                if(count($cursor_count)>0){
                    $win_num=$cursor_count[0]->win_num;
                }
                $obj->win_num=$win_num;
            }
            send_pack_user_rank($uid,$obj,$cursor);
            break;
        //获取活动
        case 20011:
            //获取系统时间
            $a=time();
            echo "\n---------- 查询活动数据 -----------\n";
            $filter = [
                "start_time" => ['$lt' => $a],//查询条件 开始时间 小于 当前时间
                "end_time" => ['$gt' => $a]//查询条件 结束时间 大于 当前时间
            ];
            $queryWriteOps = [
                "sort"       => ["add_time" => -1],//根据添加时间字段排序 1是升序，-1是降序
            ];
            $collname='active_config';
            $rs = $hall_config->query($collname, $filter, $queryWriteOps);
            $collname='user_active';
            $rows=array();
            foreach ($rs as $r) {
                $filter = [
                    "active_id" => $r->_id,
                    "uid" => $uid,
                ];
                $queryWriteOps = [
                    "projection" => ["_id"=> 0],//不输出_id字段
                ];
                $rmsg = $hall_log->query($collname, $filter, $queryWriteOps);
                print_r($rmsg);
                if(count($rmsg)==0){
                    echo "\n------------ 插入活动数据 ---------\n";
                    $newArr=["active_id" => $r->_id,"uid"=>$uid,"totoal_step"=>$r->totoal_step,"step"=>0,"attach"=>$r->attach,'state'=>0];
                    array_push($rows,$newArr);
                    $r->step=0;
                    $r->state=0;
                }else{
                    $r->step=$rmsg[0]->step;
                    $r->state=$rmsg[0]->state;
                }
            }
            if(count($rows)>0){
                $rs = $hall_log->insert($collname, $rows);
            }
            echo "最终输出：\n";
            print_r($rs);
            send_pack_get_user_active($uid,$rs);
            break;
        //获取商城信息
        case 20013:
            echo "\n---------- 查询商城信息 -----------\n";
            $filter = [
                "mall_type" => ['$gt' => 0],//查询条件 结束时间 大于 当前时间
                "mall_type" => ['$lt' => 8],//查询条件 结束时间 大于 当前时间
            ];
            $queryWriteOps = [
                "sort"       => ["mall_type" => -1],//根据添加时间字段排序 1是升序，-1是降序
            ];
            $collname='prop_config';
            $rs = $hall_config->query($collname, $filter, $queryWriteOps);
            echo "最终输出：\n";
            print_r($rs);
            send_pack_get_goods_info($uid,$rs);
            break;
        //获取用户背包信息
        case 20015:
            echo "\n---------- 查询用户背包信息 -----------\n";
            //清除过期的活动道具和其他道具
            $a=time();
            echo $a."\n";
            $delets = [
                ["q" => ["uid"=>$uid,'over_time'=>['$lt'=>$a,'$gt'=>0]
                    ],
                    "limit" => 0]
            ];
            $collname="user_packet";
            $rs = $hall_log->del($collname, $delets);

            $filter = [
                "uid" => $uid
            ];
            $queryWriteOps = [
//                "projection" => ["duidie"=> 0],//不输出_id字段
            ];
            $rs = $hall_log->query($collname, $filter, $queryWriteOps);
            echo "最终输出：\n";
//            echo $rs[0]->_id."----\n";
            print_r($rs);
            send_pack_user_packet($uid,$rs);
            break;
        //购买商品
        case 20017:
            $goods = new \Proto\CS_User_Buy_Goods();
            $goods->parseFromString($data);
            $_id=$goods->getId();
//            $_id='5d258eda6a4819cceeb909d7';
            $collname="prop_config";
            $filter = [
                "_id" => new ObjectId($_id)
            ];
            $queryWriteOps = [
            ];
            $rs = $hall_config->query($collname, $filter, $queryWriteOps);
            $code=0;
            if(count($rs)>0){
                $good=$rs[0];
                $price_type=$good->price_type;
                $money=0;
                //价格类型0-不需要，1-联欢币，2-BU币，3-RMB
                if($price_type==1){
                    $sql="select * from user_money where uid=$uid";
                    $rs=db_query($sql);
                    $money=$rs[0]['gold'];
                    if($money<$good->price){
                        $code=2;
                    }else{
                        $sql="update user_money set gold=gold-$good->price where uid=$uid";
                        if(!db_query($sql)){
                            $code=3;
                        }
                    }
                }
                else if($price_type==2){
//                    $_SESSION['phone']='15025383863';
                    //获取BU信息
                    $money=getBuRemain($_SESSION['phone']);
                    if($money<$good->price){
                        $code=2;
                    }else{
                        if(!deal($_SESSION['phone'],$good->price)){
                            $code=3;
                        }
                    }
                }
//                else if($price_type==3){
//
//                }
                if($code==0){
                    add_user_packet($good->prop_id,$uid,$_SESSION['phone'],"商城购买商品");
                }
            }else{
                $code=1;
            }
            if($code==0){
                //查询玩家货币信息
                send_user_coin_change($uid,$_SESSION['phone']);
                //添加购买记录

            }
            $is_success=$code==0?true:false;
            send_user_buy_goods($uid,$is_success,$code);
            break;
        //使用道具
        case 20019:
            $user_packet = new \Proto\CS_User_Use_Goods();
            $user_packet->parseFromString($data);
            $_id=$user_packet->getId();
            $code=0;
            $collname="user_packet";
            //查询道具是否存在
            $filter = [
                "_id" => new ObjectId($_id)
            ];
            $queryWriteOps = [
            ];
            $packet_good=null;
            $rs = $hall_log->query($collname, $filter, $queryWriteOps);
            if(count($rs)>0&&$rs[0]->num>=$user_packet->getNum()){
                $packet_good=$rs[0];
                $use_type=$packet_good->use_type;
                if ($use_type==1){
                    //打开电话输入框
                    if(recharge($uid,$user_packet->getPhone(),$packet_good->detail)==false){
                        $code=2;
                    }
                }else if ($use_type==2){
                    //打开收货人输入框
                    use_shiwuquan($uid,$packet_good,$user_packet->getName(),$user_packet->getPhone(),$user_packet->getAddress());
                }else if ($use_type==3){
                    //获得的物品ID（多个用英文逗号分开）
                    $details=$packet_good->detail;
                    $detail = explode(',',$details);

                    for($index=0;$index<count($detail);$index++){
                        $prop_id=$detail[$index];
                        add_user_packet($prop_id,$uid,$_SESSION['phone'],"使用道具");
                    }
                }else if ($use_type==4){
                    //跳转UI 如：比赛场门票，点报名后数量-num

                }
            }else{
                $code=1;
            }
            if($code==0){
                //使用后数量-num，是0就直接删除
                //加数量
                $packet_good->num=$packet_good->num-$user_packet->getNum();
                if($packet_good->num==0){
                    //删除道具
                    $delets = [
                        ["q" => ["uid"=>$uid,'prop_id'=>$packet_good->prop_id],"limit" => 0]
                    ];
                    $hall_log->del($collname, $delets);
                    //1添加，2修改，3删除
                    send_user_packet_update($uid,$packet_good,3);
                }else{
                    //修改道具数量
                    $updates = [
                        [
                            "q"     => ["prop_id" => $packet_good->prop_id,
                                'uid'=>$uid],
                            "u"     => ['$set' => ['num'=>$packet_good->num]],
                            'multi' => false, 'upsert' => false
                        ]
                    ];
                    $hall_log->update($collname, $updates);
                    //1添加，2修改，3删除
                    send_user_packet_update($uid,$packet_good,2);
                }
                //添加道具使用记录
                $nowTime=date('Y-m-d h:i:s', time());
                $rows=[['uid'=>$uid,'phone'=>$_SESSION['phone'],'prop_id'=>$packet_good->prop_id,'name'=>$packet_good->name,'num'=>$user_packet->getNum(),'add_time'=>$nowTime,'times'=>time()]];
                $hall_log->insert("use_goods_log", $rows);
            }
            send_user_use_goods($uid,$code);
            break;
        //领取附件
        case 20021:
            $attach_data = new \Proto\CS_User_Get_Attach();
            $attach_data->parseFromString($data);
            $_id=$attach_data->getId();
            $type=$attach_data->getType();
            $code=0;
            $collname="user_mail";
            if($type==1){
                //活动附件
                $collname="user_active";
            }
            $filter = [
                "_id" => new ObjectId($_id)
            ];
            $rs = $hall_log->query($collname, $filter, []);
            if(count($rs)>0){
                if($type==2){
                    if($rs[0]->get_attach){
                        $code=1;
                    }
                }else if($type==1){
                    if($rs[0]->state!=1){
                        $code=1;
                    }
                }
            }else{
                $code=2;
            }
            if($code==0){
                //修改状态
                if($type==1){
                    $updates = [
                        [
                            "q"     => ["_id" => new ObjectId($_id)],
                            "u"     => ['$set' => ['state'=>2]],
                            'multi' => false, 'upsert' => false
                        ]
                    ];
                    $hall_log->update($collname, $updates);
                }else{
                    $updates = [
                        [
                            "q"     => ["_id" => new ObjectId($_id)],
                            "u"     => ['$set' => ['get_attach'=>true]],
                            'multi' => false, 'upsert' => false
                        ]
                    ];
                    $hall_log->update($collname, $updates);
                }

                //添加背包信息
                $prop_ids=$rs[0]->attach;
                foreach ($prop_ids as $prop_id) {
                    add_user_packet($prop_id,$uid,$_SESSION['phone'],"领取附件");
                }
            }
            send_user_get_attach($uid,$code);
            break;
        //领取任务奖励
        case 20023:
            $task_award = new \Proto\CS_User_Get_Task_Award();
            $task_award->parseFromString($data);
            $task_id=$task_award->getTaskId();
            $code=get_award($task_id,$uid);
            send_user_get_task_award($uid,$code);
            break;
        //绑定邀请码
        case 20025:
            $bind_invited_code = new \Proto\CS_User_Bind_Invited_Code();
            $bind_invited_code->parseFromString($data);
            $agent_id=$bind_invited_code->getAgentId();
            $code=0;
			if($uid==$agent_id){
                return 1;
            }
            $sql="SELECT ui.agent_level, ui.agent_id, ui.user_id,ui.user_type,ui.b_phone_nu FROM bolaik_user.user_info AS ui WHERE ui.user_id = '$uid'";
            //查询用户信息
            $user = db_query($sql)[0];
			if($user["agent_id"]==""){
                //特殊代理不能绑定其他代理
                if($user["user_type"]==3){
                    $code=2;
                }else{
                    //查询代理是否存在
                    $sql="SELECT ui.agent_level, ui.agent_id, ui.user_id,ui.user_type,ui.nullity,user_nick,u_coin,gold_coin FROM bolaik_user.user_info AS ui WHERE ui.user_id = '$agent_id'";
                    $rs = db_query($sql);
					if(count($rs)==0){
                        $code=3;
                    }else{
					    $agent=$rs[0];
                        if($agent["nullity"]==0){
                            $code=4;
                        }else{
                            $sql="update bolaik_user.user_info set agent_id='$agent_id' where user_id='$uid'";
                            db_query($sql);
                            //添加绑定记录
                            $nowTime=date('Y-m-d', time());
                            //查询用户信息
                            $sql="SELECT * FROM `bolaik_db`.`user` WHERE uid=$uid";
                            $user_info=db_query($sql)[0];
                            $rows=[['uid'=>$uid,'name'=>$user_info['name'],'touxiang'=>$user_info['touxiang'],'agent_id'=>(int)$agent_id,'bind_time'=>$nowTime,'state'=>0]];
                            $hall_log->insert("spread_log", $rows);
							//查询被绑定的玩家或代理是否能升级和获得奖励
							if($agent["user_type"]==1){
                                //普通玩家，查询是否能升级为代理
                                //玩家升级为代理
                                $nowTime=date('Y-m-d h:i:s', time());
                                $sql="update bolaik_user.user_info set agent_level=7,user_type=2,agent_time='$nowTime' where user_id='$agent_id'";
                                db_query($sql);
                            }
						}
                    }
				}
            }else{
                $code=5;
            }
            send_user_bind_invited_code($uid,$code);
            break;
        //获取跑马灯信息
        case 20027:
            echo "\n---------- 获取跑马灯信息 -----------\n";
            $collname="chase_config";
            $filter = [
                "state"=>1
            ];
            $queryWriteOps = [
                "limit"=>1
            ];
            $rs = $hall_log->query($collname, $filter, $queryWriteOps);
            echo "最终输出：\n";
            print_r($rs);
            if(count($rs)>0){
                send_pack_chase_info($uid,$rs[0]->content,$rs[0]->state);
            }
            break;
        //获取推广信息
        case 20029:
            echo "\n---------- 获取推广信息 -----------\n";
            //查询用户信息
            $sql="SELECT ui.agent_id,ui.user_id FROM bolaik_user.user_info AS ui WHERE ui.user_id = '$uid'";
            $user = db_query($sql)[0];
            $collname="spread_log";
            $filter = [
                "agent_id"=>$uid
            ];
            $rs = $hall_log->query($collname, $filter, []);
            //查询每个用户的胜局
            foreach ($rs as $r) {
                if($r->state==0){
                    $filter = [
                        "uid"=>$r->uid,
                        "score"=>['$gt' => 0]
                    ];
                    $log = $hall_log->query('game_log', $filter, []);
                    $num=count($log)>10?10:count($log);
                    if($num>=10){
                        //修改状态
                        $updates = [
                            [
                                "q"     => ["_id" => new ObjectId($r->_id)],
                                "u"     => ['$set' => ['state'=>1]],
                                'multi' => false, 'upsert' => false
                            ]
                        ];
                        $hall_log->update($collname, $updates);
                        $r->state=1;
                    }
                    $r->victory_num=$num;
                }else{
                    $r->victory_num=10;
                }
            }
            echo "最终输出：\n";
            print_r($rs);
            send_pack_spread_info($uid,$user,$rs);
            break;
        //领取推广奖励
        case 20031:
            $spread_award = new \Proto\CS_User_Get_Spread_Award();
            $spread_award->parseFromString($data);
            $user_id=$spread_award->getUid();
            $code=0;
            global $behaverids;
            //获取BU
            $rmsg=getBu($_SESSION['phone'],$behaverids["tuiguang"],10);
//            $rmsg=true;
            if($rmsg){
                //查询当前状态是否可以领取
                $collname="spread_log";
                $filter = [
                    "uid"=>$user_id,
                    "agent_id"=>$uid
                ];
                $rs = $hall_log->query($collname, $filter, []);
                if(count($rs)>0){
                    $state=$rs[0]->state;
                    if($state=1){
                        //修改状态
                        $updates = [
                            [
                                "q"     => ["_id" => new ObjectId($rs[0]->_id)],
                                "u"     => ['$set' => ['state'=>2]],
                                'multi' => false, 'upsert' => false
                            ]
                        ];
                        $hall_log->update($collname, $updates);
                    }else{
                        $code=1;
                    }
                }else{
                    $code=2;
                }
            }else{
                $code=2;
            }
            send_user_get_spread_award($uid,$code);
            break;
    }
}


/**话费充值
 * @param $code
 * @param $num
 */
function recharge($user_id,$code,$num){
    $orderId=get_order_num();
    $ip=get_real_ip();
    //添加充值收到的数据记录
    $sql="insert into bolaik_order.recharge_request_log(user_id,num,code,ip,type,jimicode,order_id) values('$user_id',$num,'$code','$ip',2,'','$orderId')";
    db_query($sql);
    //话费充值
    $openId="JHcf8bedbe82bf6cb106a9b6aabe83172d";
    $key="74e411713e9610d12096371b21ec4975";
    //查询号码是否能充值
    $url="http://op.juhe.cn/ofpay/mobile/telcheck?cardnum=$num&phoneno=$code&key=$key";
    $sr=file_get_contents($url);

    $check = json_decode($sr);
    if($check->error_code==0){
        //话费直冲
        $sign=$openId.$key.$code.$num.$orderId;
        $md5String = md5($sign);
        $url="http://op.juhe.cn/ofpay/mobile/onlineorder?key=".$key."&phoneno=".$code."&cardnum=".$num."&orderid=".$orderId."&sign=".$md5String;
        $sr=file_get_contents($url);
        $recharge = json_decode($sr);
        echo "话费充值返回：".$sr;
        if($recharge->error_code!=0){

            $sql="update bolaik_order.recharge_request_log set remsg='充值失败' where order_id='$orderId'";
            db_query($sql);
            return false;
        }
    }else{
        $sql="update bolaik_order.recharge_request_log set remsg='该号码不能充值' where order_id='$orderId'";
        db_query($sql);
        return false;
    }

    $sql="update bolaik_order.recharge_request_log set remsg='创建订单成功' where order_id='$orderId'";
    db_query($sql);

    //充值成功
    //生成订单
    $sql="insert into bolaik_order.recharge_log(order_id,user_id,code,rmb,type,u_coin,totalxsf) values('$orderId','$user_id','$code',$num,2,$num,0)";
    db_query($sql);
    return true;
}

/**使用实物券
 * @param $packet_good
 * @param $name
 * @param $phone
 * @param $address
 */
function use_shiwuquan($user_id,$packet_good,$user_name,$user_phone,$u_addr){
    //查询用户信息
    $sql="SELECT ui.u_coin,ui.user_nick,b_phone_nu,gold_coin FROM bolaik_user.user_info AS ui WHERE user_id=$user_id";
    $user = db_query($sql)[0];
    $order_id=get_order_num();
    //查询商家联系信息
    $sqlSJ="SELECT oi.account_name, oi.user_name, oi.phone, oi.addr FROM bolaik_user.oper_info AS oi WHERE oi.oper_id = ".$packet_good->oper_id;
				$sjObj = db_query($sqlSJ)[0];
				$link_name="";
				$phone_number=$sjObj['phone'];
				$addr=$sjObj['addr'];
				$account_name=$sjObj['account_name'];
				$user_nick=$user['user_nick'];
				$b_phone_nu=$user['b_phone_nu'];

    $sql="insert into bolaik_order.goods_order_pay(order_id,user_id,user_nick,b_phone_nu,".
        "user_name,user_phone,u_addr,goods_id,goods_icon,goods_name,oper_id,oper_name,link_name,phone_number,addr,num,price,total_price,totalsxf,rate,rmb) ".
        " values('$order_id','$user_id','$user_nick','$b_phone_nu','$user_name','$user_phone','$u_addr',$packet_good->prop_id,'$packet_good->img','$packet_good->des',$packet_good->oper_id,'$account_name',".
        "'$link_name','$phone_number','$addr',1,$packet_good->price,$packet_good->price,0,0,0)";
    db_query($sql);
    //添加U币商城订单
    $sql="insert into bolaik_order.ucoin_order_pay(order_id,user_id,user_nick,goods_id,goods_name,goods_icon,num,goods_type,price_type,price,total_price) ".
        "values('$order_id','$user_id','$user_nick',$packet_good->prop_id,'$packet_good->name','$packet_good->img',1,1,2,$packet_good->price,$packet_good->price)";
    db_query($sql);
}

/**添加道具到用户背包
 * @param $good
 * @param $uid
 * @param $phone
 * @param $des 描述，如：商城购买,使用道具,比赛奖励,领取附件
 */
function add_user_packet($prop_id,$uid,$phone,$des,$num=1){
    $hall_config = mongo_db::singleton("hall_config");
    $hall_log = mongo_db::singleton("hall_log");

    $collname="prop_config";
    $filter = [
        "prop_id" => (int)$prop_id
    ];
    $queryWriteOps = [
    ];
    $rs = $hall_config->query($collname, $filter, $queryWriteOps);
    if(count($rs)>0){
        $good=$rs[0];
        //添加道具获得记录
        $nowTime=date('Y-m-d h:i:s', time());
        $rows=[['uid'=>$uid,'phone'=>$phone,'prop_id'=>$good->prop_id,'name'=>$good->name,'num'=>$num,'des'=>$des,'add_time'=>$nowTime,'times'=>time()]];
        $hall_log->insert("get_goods_log", $rows);
        if($good->use_type==5){
            //获得联欢币
            $sql="update user_money set gold=gold+($good->detail*$num) where uid=$uid";
            db_query($sql);
            send_user_coin_change($uid,$phone);
        }else{
            //查询背包是否有该道具
            $collname="user_packet";
            $filter = [
                "prop_id" => $good->prop_id,
                'uid'=>$uid
            ];
            $rs = $hall_log->query($collname, $filter, []);
            if(count($rs)==0||$good->duidie==2){
                //添加背包信息
                $over_time=0;
                if($good->active_time>0){
                    $over_time=time()+$good->active_time;
                }
                if($good->active_id!=""){
                    //查询活动结束时间
                    $filter = [
                        "_id" => new ObjectId($good->active_id),
                    ];
                    $rs = $hall_config->query("active_config", $filter, []);
                    if(count($rs)>0){
                        $over_time=$rs[0]->end_time;
                    }
                }
                $good->num=$num;
                $good->over_time=$over_time;
                $rows=[['uid'=>$uid,'prop_id'=>$good->prop_id,'name'=>$good->name,'des'=>$good->des,'img'=>$good->img,'active_id'=>$good->active_id,'prop_type'=>$good->prop_type,'use_type'=>$good->use_type,'detail'=>$good->detail,'active_time'=>$good->active_time,'duidie'=>$good->duidie,'mall_type'=>$good->mall_type,'price_type'=>$good->price_type,'price'=>$good->price,'num'=>1,'over_time'=>$over_time,'oper_id'=>$good->oper_id]];
                $hall_log->insert($collname, $rows);
                //查询背包是否有该道具
                $collname="user_packet";
                $filter = [
                    "prop_id" => $good->prop_id,
                    'uid'=>$uid
                ];
                $rs = $hall_log->query($collname, $filter, []);
                $good=$rs[0];
                send_user_packet_update($uid,$good,1);
            }else{
                //修改背包信息
                $updates=[];
                $good=$rs[0];
                if($good->active_time>0){
                    //加时间
                    $updates = [
                        [
                            "q"     => ["prop_id" => $good->prop_id,
                                'uid'=>$uid],
                            "u"     => ['$inc' =>['over_time'=>$good->active_time]],
                            'multi' => false, 'upsert' => false
                        ]
                    ];
                    $newTime=$good->over_time+$good->active_time;
                    $good->over_time=$newTime;
                }else{
                    //加数量
                    $good->num=$good->num+$num;
                    $updates = [
                        [
                            "q"     => ["prop_id" => $good->prop_id,
                                'uid'=>$uid],
                            "u"     => ['$set' => ['num'=>$good->num]],
                            'multi' => false, 'upsert' => false
                        ]
                    ];

                }
                if(count($updates)>0){
                    $hall_log->update($collname, $updates);
                    //1添加，2修改，3删除
                    send_user_packet_update($uid,$good,2);
                }
            }
        }
    }else{
        echo "道具不存在\n";
    }
}

/**发送玩家货币变化信息
 * @param $uid
 * @param $phone
 */
function send_user_coin_change($uid,$phone){
    //查询玩家货币信息
    $sql="select * from user_money where uid=$uid";
    $rs=db_query($sql);
    $money=$rs[0]['gold'];
    $BU=getBuRemain($phone);
    //发送帐变
    send_pack_BU_change($uid,$BU,$money);
}

/**发送玩家货币变化信息
 * @param $uid
 * @param $phone
 */
function send_user_coin_change1($uid,$BU){
    //查询玩家货币信息
    $sql="select * from user_money where uid=$uid";
    $rs=db_query($sql);
    $money=$rs[0]['gold'];
    //发送帐变
    send_pack_BU_change($uid,$BU,$money);
}

/**玩家有新消息，服务器主动推送
 * @param $uids
 * @param $module_id
 * @param $_id
 */
function sendNewInfoToUsers($uids,$module_id,$_id){
    foreach ($uids as $uid) {
        if(Gateway::isUidOnline($uid)){
            send_pack_user_new_info($uid,$module_id,$_id);
        }
    }
}

/**
 * 每天零点，更新任务状态
 */
function zero_update_task(){
    $sql="update func_system.user_task set state=2,num=0,time_num=0 where task_name_type=1 or task_name_type=4";
    db_query($sql);
}

/**
 * 每天零点定时更新的任务
 */
function zero_update(){
    //
    $nowTime=date('Y-m-d h:i:s', time());
    echo "进入定时器任务$nowTime\n";
    zero_update_task();

//    Timer::add(24*60*60, 'zero_update', null, false);
//    Timer::add(30, 'zero_update', null, false);
}



