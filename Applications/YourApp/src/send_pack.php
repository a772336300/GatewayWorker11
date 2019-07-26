<?php
use Proto\SC_Back_Password;
use \GatewayWorker\Lib\Gateway;
require_once __DIR__ . '/Proto/Autoloader.php';
//发送用户密码
function send_pack_password($client_id,$phone,$password,$is_create_user)
{
    $sc_back_password = new SC_Back_Password();
    $sc_back_password->setPassword($password);
    $sc_back_password->setPhone($phone);
    $sc_back_password->setIsCreateUser($is_create_user);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(702,$sc_back_password->serializeToString()));
    //$connection->send(my_pack(702,$sc_back_password->serializeToString()));
}

function send_pack_create_user($client_id,$is_success)
{
    $create_user_back = new \Proto\SC_Create_User_Back();
    $create_user_back->setIsSuccess($is_success);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(704,$create_user_back->serializeToString()));
    //$connection->send(my_pack(704,$create_user_back->serializeToString()));
}
function send_pack_login($client_id,$is_success,$binded)
{
    $object = new \Proto\SC_Client_Login_Back();
    $object->setResult($binded);
    $object->setIsSuccess($is_success);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(711,$object->serializeToString()));
    //\GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(711,$object->serializeToString()));
    //$connection->send(my_pack(711,$object->serializeToString()));
}

function send_pack_user_info($client_id,$user_info)
{
    $user_info_buf = new \Proto\E_User_Info();
    $user_info_buf->setUid($user_info['uid']);//读
    $user_info_buf->setGender($user_info['gender']);//读
    $user_info_buf->setName($user_info['name']);//读
    $user_info_buf->setGold($user_info['gold']);//写
    $user_info_buf->setBU($user_info['BU']);//外界读
    $user_info_buf->setVigour($user_info['vigour']);//写
    $user_info_buf->setXingzhu($user_info['constellation']);//读
    $user_info_buf->setTouxiang($user_info['touxiang']);//读
    $user_info_buf->setSignDate(1);//写
    //$user_info_buf->setMoxingIds($user_info['moxing_ids']);//读？
    $user_info_buf->setMoxingId($user_info['moxing_id']);//读？
    //$user_info_buf->setMoxingId(100);
    //$user_info_buf->setChangjingIds($user_info['changjing_ids']);//读？
    $user_info_buf->setChangjingId($user_info['changjing_id']);//读？
    //$user_info_buf->setChangjingId(2070002);//读？
    $user_info_buf->setBsign($user_info['is_sign']);//写
    $user_info_buf->setBAgent(true);//读
    $user_info_buf->setBRealName($user_info['bRealName']);//读
    $user_info_buf->setBWx($user_info['bWx']);//读
    $user_info_buf->setPhone($user_info['phone']);//读

    $object = new \Proto\SC_User_Info_Back();
    $object->setEUserInfo($user_info_buf);
    echo $client_id."xxx\n";
    Gateway::sendToClient($client_id,my_pack(801,$object->serializeToString()));
    //$connection->send(my_pack(801,$object->serializeToString()));
}
function send_pack_user_bag_info($client_id,$user_info_bag)
{
    $object = new \Proto\SC_User_Info_Bag();
    foreach (json_decode($user_info_bag['equipmenting_item']) as $item)
        foreach ($item as $value)
        {
            $object->appendEquipmentingItem($value);
        }
    foreach (json_decode($user_info_bag['having_item']) as $item)
    {
        $object->appendHavingItem($item);
    }
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(802,$object->serializeToString()));
    //$connection->send(my_pack(802,$object->serializeToString()));
}

function send_pack_task_reward($client_id)
{
    $sign_reward_list= new \Proto\SC_Task_Sign_Reward();
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    $sign_reward_list->appendUCoin(20);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(804,$sign_reward_list->serializeToString()));
    //$connection->send(my_pack(804,$sign_reward_list->serializeToString()));
}
//806通知
function send_pack_notice($client_id,$type,$tipStr)
{
    $notice= new \Proto\SC_System_Tips_Str();
    $notice->setType($type);
    $notice->setTipStr($tipStr);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(806,$notice->serializeToString()));
    //$connection->send(my_pack(806,$notice->serializeToString()));
}
function send_pack_sign($client_id,$date,$isSign)
{
    $object= new \Proto\SC_User_Sign();
    $object->setDate($date);
    $object->setIsSignToday($isSign);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1007,$object->serializeToString()));
    //$connection->send(my_pack(1007,$object->serializeToString()));
}
function send_pack_user_info_update($client_id,$is_success)
{
    $object= new \Proto\SC_User_Info_Update();
    $object->setIsSuccess($is_success);
    //$connection->send(my_pack(1009,$object->serializeToString()));
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1009,$object->serializeToString()));
}
function send_pack_user_real_name($client_id,$is_success)
{
    $object= new \Proto\SC_User_Real_Name();
    $object->setIsSuccess($is_success);
    //$connection->send(my_pack(1011,$object->serializeToString()));
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1011,$object->serializeToString()));
}
function send_pack_user_wx($client_id,$is_success)
{
    $object= new \Proto\SC_User_Bind_wx();
    $object->setIsSuccess($is_success);
    //$connection->send(my_pack(1013,$object->serializeToString()));
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1013,$object->serializeToString()));
}
function send_pack_user_buy_item($client_id,$items)
{
    $object = new \Proto\SC_User_Add_Item();
    foreach ($items as $value)
       $object->appendItemid($value);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1003,$object->serializeToString()));
    //$connection->send(my_pack(802,$object->serializeToString()));
}
function send_pack_gold_change($uid,$gold)
{
    $object = new \Proto\SC_User_UB();
    $object->setGold($gold);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1014,$object->serializeToString()));
    //$connection->send(my_pack(802,$object->serializeToString()));
}
function send_pack_user_equip_item($client_id,$items)
{
    $object = new \Proto\SC_User_Use_Equip_Result();
    foreach ($items as $value)
        $object->appendEquipItemid($value);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1001,$object->serializeToString()));
    //$connection->send(my_pack(802,$object->serializeToString()));
}
function send_pack_user_equip_item_changjing($client_id,$items)
{
    $object = new \Proto\SC_User_Select_changjing();
    foreach ($items as $value)
        $object->setChangjing($value);
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(1005,$object->serializeToString()));
}
function send_pack_BU_change($uid,$BU,$gold_coin)
{
    $object = new \Proto\SC_User_UB();
    $object->setBU($BU);
    $object->setGold($gold_coin);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1014,$object->serializeToString()));
    //$connection->send(my_pack(802,$object->serializeToString()));
}
function send_pack_strength_change($uid,$strength)
{
    $object = new \Proto\SC_User_UB();
    $object->setVigour($strength);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1014,$object->serializeToString()));
}
function send_pack_user_task_list($client_id,$is_success,$data)
{
    $object= new \Proto\SC_Init_Task();
    foreach ($data as $value)
    {
        $task = new \Proto\E_Task_Info();
        $task->setTaskId($value['task_id']);
        $task->setSkip($value['skip']);
        $task->setArchTask('');
        $task->setChannelId(1);
        $task->setGoldCoin($value['gold_coin']);
        $task->setId($value['id']);
        $task->setPowerPoint(0);
        $task->setScriptId(0);
        $task->setStep($value['total']);
        $task->setStepDone($value['done']);
        $task->setTaskContent($value['task_content']);
        $task->setTaskName($value['task_name']);
        $task->setTaskParamType($value['task_name_type']);
        $task->setTaskPre('');
        $task->setTaskSkipType($value['task_skip_type']);
        $task->setTaskState($value['state']);
        $task->setUCoin($value['u_coin']);
        $object->appendTask($task);
    }
    //$connection->send(my_pack(1013,$object->serializeToString()));
    \GatewayWorker\Lib\Gateway::sendToUid($client_id,my_pack(803,$object->serializeToString()));
}

function send_update_task_state($uid,$task_id,$state,$stepDone)
{
    echo "send to client:".$task_id.",".$state.",".$stepDone;
    util_log("send_update_task_state send to client:uid:".$uid.',task_id:'.$task_id.",state:".$state.",stepDone:".$stepDone);
    echo '/n';
    $buff = new \Proto\SC_Update_Task();
    $object = new \Proto\E_Task_Info();
    $object->setTaskState($state);
    $object->setTaskId($task_id);
    $object->setStepDone($stepDone);
    $buff->appendTask($object);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1016,$buff->serializeToString()));
}
function send_notice($uid,$id,$body)
{
    $message = new \Proto\SC_System_Tips_Str();
    $message->setType($id);
    if($body==null)
    {
        $message->setTipStr("0");
    }
    else
    {
        $message->setTipStr((string)$body);
    }
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(806,$message->serializeToString()));
}
function send_notice_by_client_id($client_id,$id,$body)
{
    $message = new \Proto\SC_System_Tips_Str();
    $message->setType($id);
    if($body==null)
    {
        $message->setTipStr("0");
    }
    else
    {
        $message->setTipStr((string)$body);
    }
    \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(806,$message->serializeToString()));
}
function send_notice_to_all($id,$body)
{
    $message = new \Proto\SC_System_Tips_Str();
    $message->setType($id);
    $message->setTipStr($body);
    \GatewayWorker\Lib\Gateway::sendToAll(my_pack(806,$message->serializeToString()));
}

function send_vip_day($uid,$day)
{
    $message = new \Proto\SC_User_Vip();
    $message->setVipDay($day);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1024,$message->serializeToString()));
}

function send_pack_user_touxiang_update($uid,$is_success)
{
    $message = new \Proto\SC_User_TouXiang_Update();
    $message->setIsSuccess($is_success);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20002,$message->serializeToString()));
}

function send_pack_get_user_mail($uid,$is_success,$data)
{
    $object= new \Proto\SC_Get_User_Mail();
    foreach ($data as $value)
    {
        $user_mail = new \Proto\E_User_mail();
        $user_mail->setId($value->_id);
        $user_mail->setSid($value->sid);
        $user_mail->setTitle($value->title);
        $user_mail->setContent($value->content);
        $user_mail->setStartTime($value->start_time);
        $user_mail->setEndTime($value->end_time);
        $arr=$value->attach;
        foreach ($arr as $item) {
            $user_mail->appendAttach($item);
        }
        $user_mail->setIsread($value->isread);
        $user_mail->setIsdelete($value->isdelete);
        $user_mail->setGetAttach($value->get_attach);
        $user_mail->setUid($value->uid);
        $object->appendUserMail($user_mail);
    }
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20004,$object->serializeToString()));
}

function send_pack_user_mail_read($uid,$is_success)
{
    $message = new \Proto\SC_User_Mail_Read();
    $message->setIsSuccess($is_success);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20006,$message->serializeToString()));
}

function send_pack_user_mail_delete($uid,$is_success)
{
    $message = new \Proto\SC_User_Mail_Delete();
    $message->setIsSuccess($is_success);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20008,$message->serializeToString()));
}

function send_pack_user_new_info($uid,$module_id,$_id)
{
    $message = new \Proto\SC_User_New_info();
    $message->setModuleId($module_id);
    $message->appendId($_id);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20100,$message->serializeToString()));
}

function send_pack_user_rank($uid,$obj,$data)
{
    $object= new \Proto\SC_User_Get_Rank();
    foreach ($data as $value)
    {
        $user_rank = new \Proto\E_User_Rank();
        $user_rank->setRank($value->rank);
        $user_rank->setUid($value->uid);
        $user_rank->setName($value->name);
        $user_rank->setTouxiang($value->touxiang);
        $user_rank->setWinNum($value->win_num);
        $object->appendUserRank($user_rank);
    }
    $object->setUid($uid);
    $object->setName($obj->name);
    $object->setTouxiang($obj->touxiang);
    $object->setWinNum($obj->win_num);
    $object->setRank($obj->rank);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20010,$object->serializeToString()));
}

function send_pack_get_user_active($uid,$data)
{
    $object= new \Proto\SC_Get_User_Active();
    foreach ($data as $value)
    {
        $user_active = new \Proto\E_User_Active();
        $user_active->setId($value->_id);
        $user_active->setTitle($value->title);
        $user_active->setContent($value->content);
        $user_active->setStartTime($value->start_time);
        $user_active->setEndTime($value->end_time);
        $user_active->setActiveType($value->active_type);
        $user_active->setSkipType($value->skip_type);
        $user_active->setSkipUrl($value->skip_url);
        $user_active->setImgUrl($value->img_url);
        $user_active->setOpenTime($value->open_time);
        $user_active->setCloseTime($value->close_time);
        $user_active->setAwardDes($value->award_des);
        $user_active->setTotoalStep($value->totoal_step);
        foreach ($value->attach as $attach) {
            $user_active->appendAttach($attach);
        }
        $user_active->setStep($value->step);
        $user_active->setState($value->state);
        $object->appendUserActive($user_active);
    }
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20012,$object->serializeToString()));
}

function send_pack_get_goods_info($uid,$data)
{
    $object= new \Proto\SC_Get_Goods();
    foreach ($data as $value)
    {
        $good_info = new \Proto\E_Goods_Info();
        $good_info->setId($value->_id);
        $good_info->setPropId($value->prop_id);
        $good_info->setName($value->name);
        $good_info->setDes($value->des);
        $good_info->setImg($value->img);
        $good_info->setMallType($value->mall_type);
        $good_info->setPriceType($value->price_type);
        $good_info->setPrice($value->price);
        $object->appendGoodsInfo($good_info);
    }
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20014,$object->serializeToString()));
}

function send_pack_user_packet($uid,$data)
{
    $object= new \Proto\SC_Get_User_Packet();
    foreach ($data as $value)
    {
        $user_packet = new \Proto\E_User_Packet();
        $user_packet->setId($value->_id);
        $user_packet->setPropId($value->prop_id);
        $user_packet->setName($value->name);
        $user_packet->setDes($value->des);
        $user_packet->setImg($value->img);
        $user_packet->setActiveId($value->active_id);
        $user_packet->setPropType($value->prop_type);
        $user_packet->setUseType($value->use_type);
        $user_packet->setActiveTime($value->active_time);
        $user_packet->setNum($value->num);
        $user_packet->setOverTime($value->over_time);
        $object->appendUserPacket($user_packet);
    }
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20016,$object->serializeToString()));
}

function send_user_buy_goods($uid,$is_success,$code)
{
    $message = new \Proto\SC_User_Buy_Goods();
    $message->setIsSuccess($is_success);
    $message->setCode($code);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20018,$message->serializeToString()));
}

function send_user_packet_update($uid,$good,$type)
{
    $message = new \Proto\SC_User_Packet_Update();
    $user_packet = new \Proto\E_User_Packet();
    $user_packet->setId($good->_id);
    $user_packet->setPropId($good->prop_id);
    $user_packet->setName($good->name);
    $user_packet->setDes($good->des);
    $user_packet->setImg($good->img);
    $user_packet->setActiveId($good->active_id);
    $user_packet->setPropType($good->prop_type);
    $user_packet->setUseType($good->use_type);
    $user_packet->setDetail($good->detail);
    $user_packet->setActiveTime($good->active_time);
    $user_packet->setNum($good->num);
    $user_packet->setOverTime($good->over_time);
    $message->setUserPacket($user_packet);
    $message->setType($type);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20101,$message->serializeToString()));
}

function send_user_email_update($uid,$user_mail,$type)
{
    $message = new \Proto\SC_User_Email_Update();
    $user_packet = new \Proto\E_User_mail();
    $user_packet->setId($user_mail->_id);
    $user_packet->setSid($user_mail->sid);
    $user_packet->setTitle($user_mail->title);
    $user_packet->setContent($user_mail->content);
    $user_packet->setStartTime($user_mail->start_time);
    $user_packet->setEndTime($user_mail->end_time);
    foreach ($user_mail->attach as $attach) {
        $user_packet->appendAttach($attach);
    }
    $user_packet->setIsread($user_mail->isread);
    $user_packet->setIsdelete($user_mail->isdelete);
    $user_packet->setGetAttach($user_mail->get_attach);
    $user_packet->setUid($uid);
    $message->setType($type);
    $message->setUserMail($user_packet);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20102,$message->serializeToString()));
}

function send_user_use_goods($uid,$code)
{
    $message = new \Proto\SC_User_Use_Goods();
    $message->setCode($code);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20020,$message->serializeToString()));
}

function send_user_get_attach($uid,$code)
{
    $message = new \Proto\SC_User_Get_Attach();
    $message->setCode($code);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20022,$message->serializeToString()));
}

function send_user_get_task_award($uid,$code)
{
    $message = new \Proto\SC_User_Get_Task_Award();
    $message->setCode($code);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20024,$message->serializeToString()));
}

function send_user_bind_invited_code($uid,$code)
{
    $message = new \Proto\SC_User_Bind_Invited_Code();
    $message->setCode($code);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20026,$message->serializeToString()));
}

function send_pack_chase_info($uid,$content,$state)
{
    $object= new \Proto\SC_User_Chase_Info();
    $object->setContent($content);
    $object->setState($state);
    \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(20028,$object->serializeToString()));
}
