<?php
function hall_message_switch($mid,$data){
    $_SESSION['uid']=8823;
    $uid=$_SESSION['uid'];
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
            $hall_config = mongo_db::singleton("hall_config");
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
            $hall_log = mongo_db::singleton("hall_log");
            foreach ($rs as $r) {
                $filter = [
                    "id" => $r->id,
                    "uid" => $uid,
                ];
                $queryWriteOps = [
                    "projection" => ["_id"=> 0],//不输出_id字段
                ];
                $rmsg = $hall_log->query($collname, $filter, $queryWriteOps);
                print_r($rmsg);
                if(count($rmsg)==0){
                    echo "\n------------ 插入邮件数据 ---------\n";
                    $newArr=["id" => $r->id,"title"=>$r->title,"content"=>$r->content,"start_time"=>$r->start_time,"end_time"=>$r->end_time,'attach'=>$r->attach,'isread'=>0,'isdelete'=>0,'get_attach'=>0,'uid'=>$uid];
                    array_push($rows,$newArr);
                }
            }
            if(count($rows)>0){
                $rs = $hall_log->insert($collname, $rows);
            }
            //获取所有未删除的邮件
            $filter = [
                "isdelete" => 0,
                "uid" => $uid,
            ];
            $queryWriteOps = [
                "projection" => ["_id"=> 0],//不输出_id字段
                "sort"       => ["isread" => 1],//根据id字段排序 1是升序，-1是降序
            ];
            $rmsg = $hall_log->query($collname, $filter, $queryWriteOps);
            echo "最终输出：\n";
            print_r($rmsg);

            break;
    }
}