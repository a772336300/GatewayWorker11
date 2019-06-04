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
function send_pack_login($client_id,$is_success)
{
    $object = new \Proto\SC_Client_Login_Back();
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
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::FRIST_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::SECOND_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::THIRD_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::FOURTH_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::FIFTH_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::SIXTH_DAY);
    $sign_reward_list->appendUCoin(\Proto\SIGN_REWARD::SEVENTH_DAY);
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
function send_pack_BU_change($uid,$BU)
{
    $object = new \Proto\SC_User_UB();
    $object->setBU($BU);
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