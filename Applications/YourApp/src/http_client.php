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
    $connection_to_jinwowo->http_buffer = '';
    $connection_to_jinwowo->onConnect = function ($connection_to_jinwowo)use($path) {
        //echo "connect success\n";
        $connection_to_jinwowo->send("GET $path HTTP/1.1\r\nHost: ubc.jinvovo.com\r\nConnection: Close\r\n\r\n");

        ///$connection_to_baidu->send("GET / HTTP/1.1\r\nHost: www.baidu.com\r\nConnection: keep-alive\r\n\r\n");
    };
    $connection_to_jinwowo->onMessage = function ($connection_to_jinwowo, $http_buffer) {

        $connection_to_jinwowo->http_buffer .= $http_buffer;
        //$response = json_decode($http_buffer,true);\r\n
//        if($response['code']==200)
//        {
//
//        }
    };
    $connection_to_jinwowo->onClose = function ($connection_to_jinwowo)
    {
        list(, $http_body) = explode("\r\n\r\n", $connection_to_jinwowo->http_buffer, 2);
        $data = get_body($http_body);
        echo "http connection closed\n";
        //$connection_to_jinwowo->http_buffer .= $http_buffer;
        echo "buff:\n";
        echo $connection_to_jinwowo->http_buffer;
        echo "\nend\n";
        call_user_func($connection_to_jinwowo->mycallback,$data);
//        $json_arr=array();
//        preg_match('/{.*}/',$connection_to_jinwowo->http_buffer,$json_arr);
//
//        if(isset($json_arr[0]))
//        {
//            echo $json_arr[0];
//            call_user_func($connection_to_jinwowo->mycallback,$json_arr[0]);
//        }
    };
    $connection_to_jinwowo->onError = function ($connection_to_jinwowo, $code, $msg)
    {
        echo "Error code:$code msg:$msg\n";
    };
    $connection_to_jinwowo->connect();
}
function get_body($http_body)
{
    $result = '';
    $left_body = $http_body;
    while ($http_body!=null)
    {
        if($http_body=="\r\n")
        {
            break;
        }
        list($len, $http_body) = explode("\r\n", $http_body, 2);
        if($len == "")
        {
            continue;
        }
        $result .= substr($http_body,0,hexdec($len));
        $http_body= substr($http_body,hexdec($len));
    }
    return $result;
}