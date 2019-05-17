<?php
use Workerman\Connection\AsyncTcpConnection;
//$canshu = array('terraceId', 'signType', 'device', 'version', 'sign');
//$phone = 'userMobile';
//$canshu_back = array('code', 'message', 'data');
function get_jinlian_assert($uid,$phone)
{
    //$canshu = array('terraceId=', 'signType', 'device', 'version', 'sign');
    jinlian_http_client($phone , function ($json_data) use ($uid,$phone){
        $buf_arr= json_decode($json_data);
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