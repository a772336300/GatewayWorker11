<?php
use MongoDB\BSON\ObjectID;
use \GatewayWorker\Lib\Gateway;
function web_server_message_manager($client_id,$data)
{
    global $task_sign_map;
    $dataArr =json_decode($data,true);
    if(!isset($dataArr['f']))
    {
        util_log("get bad pack from webserver!data:$data");
        return ;
    }
    util_log("收到Web端消息f：".$dataArr['f']);
    if($dataArr['f']=='signNotice')
    {
//        send_pack_toweb($client_id);
        //添加签到记录
        $user_id=$dataArr['user_id'];
        $task_id=$dataArr['task_id'];
        $web_name=$dataArr['web_name'];
        $sql="insert into bolaik_user.sign_log(user_id,web_name,times) values('$user_id','$web_name',1)";
        db_query($sql);
        task_udpate_once($dataArr['user_id'],$dataArr['task_id']);
        return;
    }
    if($dataArr['f']=='updateUserInfo')
    {
        $uid= $dataArr['user_id'];
        $u_coin = $dataArr['u_coin'];
        $gold_coin = $dataArr['gold_coin'];
        $strength = $dataArr['strength'];
        db_update_user_money($uid,$u_coin,$gold_coin,$strength);
        if($u_coin!=0||$gold_coin!=0)
        {
            //发送帐变
            send_pack_BU_change($uid,$u_coin,$gold_coin);
        }
        if($strength!=0)
        {
            //发送体力
            send_pack_strength_change($uid,$strength);
        }

        return;
    }
    if($dataArr['f']=='refreshTable')
    {
        $dataArr['libName'];
        $dataArr['tableName'];
        $refresh = refreshUserInit();
        foreach ($refresh as $id=>$value)
        {
            util_log("refreshTable notice,id:$id value:$value");
            send_notice_to_all($id,$value);
        }
        return;
    }
    if($dataArr['f']=='rechargeNotice')
    {
        $vip_day =0;
        if(isset($dataArr['vip_num'])&&$dataArr['vip_num']!=null&&$dataArr['vip_num']>0)
        {
            $vip_day = $dataArr['vip_num'];
        }
        util_log("rechargeNotice uid:$dataArr[user_id] vip_day:$vip_day");
        send_vip_day($dataArr['user_id'],$vip_day);
        return;

    }

    if($dataArr['f']=='refreshInfo')
    {
        //1活动，2邮件，3跑马灯
        if($dataArr['modle']==1){

        }else if ($dataArr['modle']==2){
            if($dataArr['type']==1){//指定玩家添加新邮件
                $_id=$dataArr["_id"];
                $hall_config = mongo_db::singleton("hall_config");
                $filter = [
                    "_id"=>new ObjectId($dataArr['_id'])
                ];
                $rmsg = $hall_config->query("sys_mail", $filter, []);
                $data=$rmsg[0];
                $data->sid=$data->id;
                if($data->uid!=""){
                    $hello = explode(',',$data->uid);
                    foreach ($hello as $uid) {
                        if(Gateway::isUidOnline($uid)){
                            $hall_log = mongo_db::singleton("hall_log");
                            $filter = [
                                "sid"=>$data->sid,
                                "uid"=> (int)$uid,
                            ];
                            $rs = $hall_log->query("user_mail", $filter, []);
                            send_user_email_update($uid,$rs[0],1);
                        }
                    }
                }
            }
        }else if ($dataArr['modle']==3){
            //跑马等信息修改
            $hall_config = mongo_db::singleton("hall_config");
            $filter = [
                "_id"=>new ObjectId($dataArr['_id'])
            ];
            $queryWriteOps = [
            ];
            $rmsg = $hall_config->query("chase_config", $filter, $queryWriteOps);

            $message = new \Proto\SC_User_Chase_Info();
            $message->setContent($rmsg[0]->content);
            $message->setState($rmsg[0]->state);
            \GatewayWorker\Lib\Gateway::sendToAll(my_pack(20028,$message->serializeToString()));
        }
        return;

    }

}