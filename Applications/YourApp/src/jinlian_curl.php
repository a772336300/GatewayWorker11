<?php
//curl发送请求
 function set_curl($url,$type,$data=null){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    $data_json=json_encode($data,JSON_UNESCAPED_UNICODE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function jinlian()
{
    $path = '/wallet/v1/myAssert';
    $canshu = array('terraceId','signType','device','version','sign');
    $phone = 'userMobile';
    $canshu_back= array('code','message','data');

    $url="https://tubc.jinvovo.com";
    return self::set_curl($url,"POST",['terraceId'=>$terraceId,'signType'=>$signType,'device'=>$device,'signType'=>$signType,'signType'=>$signType,]);
}