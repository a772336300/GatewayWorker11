<?php

use Workerman\Connection\AsyncTcpConnection;

function jinlian_http_client($path,$add_arr,$callback)
{
    //$path = '/wallet/v1/myAssert?';
    $canshu = array('terraceId=0dae8af09fc4f40eb7e2dbcd38f416e7','secret=e44f277a1451b356dd88ac6da1e5a7ee', 'signType=MD5','version=v1.0', 'device=ANDROID');
    $canshu = array_merge($canshu,$add_arr);
    sort($canshu);
    $sendString = implode('&',$canshu);
    //$canshu[]= 'sign='.md5($sendString);

    $sendString = $sendString.'&sign='.md5($sendString);
    //$path = '/app/myAssert?';
    $path=$path.$sendString;
    echo "xxxx\n";
    echo $path;
    echo "xxxx\n";
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
        $match = array();
        preg_match("/\r\n\r\n(.+)\r\n(.+)/",$http_buffer,$match);
        if($match==null)
        {
            preg_match("/(.+)\r\n(.+)/",$http_buffer,$match);
        }
        if(isset($match[1])&&isset($match[2]))
        {
            $body = substr($match[2],0,hexdec($match[1]));
            echo "\n body \n $body \n";
            $connection_to_jinwowo->http_buffer .= $body;
        }
        //$response = json_decode($http_buffer,true);\r\n
//        if($response['code']==200)
//        {
//
//        }
    };
    $connection_to_jinwowo->onClose = function ($connection_to_jinwowo) {
        echo "http connection closed\n";
        //$connection_to_jinwowo->http_buffer .= $http_buffer;
        echo "xxxxxxxxbuff:\n";
        echo $connection_to_jinwowo->http_buffer;
        echo "\nxxxxxxxxend\n";
        call_user_func($connection_to_jinwowo->mycallback,$connection_to_jinwowo->http_buffer);
//        $json_arr=array();
//        preg_match('/{.*}/',$connection_to_jinwowo->http_buffer,$json_arr);
//
//        if(isset($json_arr[0]))
//        {
//            echo $json_arr[0];
//            call_user_func($connection_to_jinwowo->mycallback,$json_arr[0]);
//        }
    };
    $connection_to_jinwowo->onError = function ($connection_to_jinwowo, $code, $msg) {
        echo "Error code:$code msg:$msg\n";
    };
    $connection_to_jinwowo->connect();
}