<?php
use Workerman\Connection\AsyncTcpConnection;
//$canshu = array('terraceId', 'signType', 'device', 'version', 'sign');
//$phone = 'userMobile';
//$canshu_back = array('code', 'message', 'data');
function get_jinlian_assert($uid,$phone)
{
    //$canshu = array('terraceId=', 'signType', 'device', 'version', 'sign');
    jinlian_http_client('/app/myAssert?',array('userMobile='.$phone) , function ($json_data) use ($uid,$phone){
        $buf_arr= json_decode($json_data);
        if(!isset($buf_arr->code))
        {
            $message = new \Proto\SC_System_Tips_Str();
            $message->setType(1);
            $message->setTipStr("获取BU余额失败");
            \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(806,$message->serializeToString()));
        }
        if($buf_arr->code==200)
        {
            $message_BU = new \Proto\SC_User_UB();
            $message_BU->setInitBu(true);
            $message_BU->setBU($buf_arr->asserts);
            \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1014,$message_BU->serializeToString()));
        }
        else
        {
            $message = new \Proto\SC_System_Tips_Str();
            $message->setType(1);
            $message->setTipStr("获取BU余额失败");
            \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(806,$message->serializeToString()));
        }
    });
}
function get_jinlian_liushui($uid,$phone,$flag,$dateFlag,$page,$pageSize,$unixTimestamp,$showAll)
{
    //$canshu = array('terraceId=', 'signType', 'device', 'version', 'sign');
    $add_arr= array('userMobile='.$phone,'flag='.$flag,'dateFlag='.$dateFlag,'page='.$page,'pageSize='.$pageSize,'showAll='.$showAll);
    //$add_arr= array('userMobile='.$phone,'flag='.$flag,'dateFlag='.$dateFlag,'page='.$page,'pageSize='.$pageSize,'unixTimestamp='.$unixTimestamp,'showAll='.$showAll);
    jinlian_http_client('/app/v1/flowList?',$add_arr , function ($json_data) use ($uid,$phone){
        $buf_arr= json_decode($json_data);
        var_dump($json_data);
        if($buf_arr->code==200)
        {
            $user_BU_stream = new \Proto\SC__User_BU_Stream();
            foreach ($buf_arr->data as $item)
            {
                $user_BU_stream_item = new \Proto\User_BU_Stream_Item();
                $user_BU_stream_item->setBuValue($item->buValue);
                $user_BU_stream_item->setFlowTime($item->flowTime);
                $user_BU_stream_item->setBehaviorName($item->behaviorName);
                $user_BU_stream_item->setPartnerName($item->partnerName);
                $user_BU_stream_item->setBuType($item->buType);
                $user_BU_stream->appendItem($user_BU_stream_item);
            }
            $user_BU_stream->setIsSuccess(true);
            \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(1020,$user_BU_stream->serializeToString()));
        }
        else
        {
            $message = new \Proto\SC_System_Tips_Str();
            $message->setType(1);
            $message->setTipStr("获取BU流水失败");
            \GatewayWorker\Lib\Gateway::sendToUid($uid,my_pack(806,$message->serializeToString()));
        }
    });
}