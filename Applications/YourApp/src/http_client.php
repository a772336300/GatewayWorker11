<?php

use Workerman\Connection\AsyncTcpConnection;

function jinlian_http_client($phone,$callback)
{
    //$path = '/wallet/v1/myAssert?';
    $canshu = array('terraceId=0dae8af09fc4f40eb7e2dbcd38f416e7','secret=e44f277a1451b356dd88ac6da1e5a7ee', 'signType=MD5','version=v1.0', 'device=ANDROID', 'userMobile='.$phone);
    sort($canshu);
    $sendString = implode('&',$canshu);
    //$canshu[]= 'sign='.md5($sendString);

    $sendString = $sendString.'&sign='.md5($sendString);
    $path = '/app/myAssert?';
    $path=$path.$sendString;
    // 不支持直接指定http，但是可以用tcp模拟http协议发送数据
    $connection_to_jinwowo = new AsyncTcpConnection('ssl://ubc.jinvovo.com:443');
    $connection_to_jinwowo->mycallback = $callback;
    // 当连接建立成功时，发送http请求数据
    //$connection_to_jinwowo->transport = 'ssl';

    $connection_to_jinwowo->onConnect = function ($connection_to_jinwowo)use($path) {
        //echo "connect success\n";
        $connection_to_jinwowo->send("GET $path HTTP/1.1\r\nHost: ubc.jinvovo.com\r\nConnection: Close\r\n\r\n");
        ///$connection_to_baidu->send("GET / HTTP/1.1\r\nHost: www.baidu.com\r\nConnection: keep-alive\r\n\r\n");
    };
    $connection_to_jinwowo->onMessage = function ($connection_to_jinwowo, $http_buffer) {

        $json_arr=array();
        preg_match('/{.*}/',$http_buffer,$json_arr);

        if(isset($json_arr[0]))
        {
            echo $json_arr[0];
            call_user_func($connection_to_jinwowo->mycallback,$json_arr[0]);
        }

        //$response = json_decode($http_buffer,true);

//        if($response['code']==200)
//        {
//
//        }
    };
    $connection_to_jinwowo->onClose = function ($connection_to_jinwowo) {
        echo "connection closed\n";
    };
    $connection_to_jinwowo->onError = function ($connection_to_jinwowo, $code, $msg) {
        echo "Error code:$code msg:$msg\n";
    };
    $connection_to_jinwowo->connect();
}