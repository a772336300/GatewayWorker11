<?php
use MongoDB\BSON\ObjectID;
require_once 'util.php';
function hall_message_switch($mid,$data){
//    $_SESSION['uid']=8823;
    echo "大厅信息：$mid\n";
    $uid=$_SESSION['uid'];
    $hall_config = mongo_db::singleton("hall_config");
    $hall_log = mongo_db::singleton("hall_log");
    switch ($mid){
        case 20001://修改头像信息
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
        case 20003://获取邮件
            //查询有效期内的系统邮件

            //获取系统时间
            $nowTime=date('Y-m-d h:i:s', time());
            $a=time();
            echo "\n---------- 查询系统邮件数据 -----------\n";
            $filter = [
                "start_time" => ['$lt' => $a],//查询条件 开始时间 大于 当前时间
                "end_time" => ['$gt' => $a]//查询条件 结束时间 小于 当前时间
            ];
            $queryWriteOps = [
                "projection" => ["_id"=> 0],//不输出_id字段
                "sort"       => ["id" => 1],//根据id字段排序 1是升序，-1是降序
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
            echo  $rmsg[0]->_id."\n";
            print_r($rmsg);
            send_pack_get_user_mail($uid,true,$rmsg);
            break;
        case 20005://已读邮件
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

        case 20007://一键删除
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
        case 20009://获取排行榜
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
                    ['$group' => [ '_id' => ['uid'=>'$uid','name'=>'$name','touxiang'=>'$touxiang'], 'win_num' => ['$sum'=>1] ] ],
                    ['$limit' => 100],
                    ['$project'=>['uid'=>'$_id.uid','name'=>'$_id.name','touxiang'=>'$_id.touxiang','win_num'=>'$win_num']],
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
    }
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