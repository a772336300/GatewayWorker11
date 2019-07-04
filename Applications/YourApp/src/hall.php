<?php
function hall_message_switch($mid,$data){
//    $_SESSION['uid']=8823;
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
            //获取所有未删除的邮件
            $filter = [
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
        case 2005://已读邮件
            $user_mail_read = new \Proto\CS_User_Mail_Read();
            $user_mail_read->parseFromString($data);
            $_id=$user_mail_read->getId();
            $updates = [
                [
                    "q"     => ["_id" => $_id],
                    "u"     => ['$set' => ["isread" => 1]],
                    'multi' => false, 'upsert' => false
                ]
            ];
            $collname="user_mail";
            $rs = $hall_log->update($collname, $updates);
            print_r($rs->toArray());
//
//
            break;

    }
}