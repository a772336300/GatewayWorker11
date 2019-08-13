<?php
/**
 * 获取今日零点的时间戳
 */

function get_today_zero_time(){
    return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
}

/**
 * 返回本周开始的时间戳
 */
function get_week_zero_time()
{
    $timestamp = time();
    return strtotime(date('Y-m-d', strtotime("this week Monday", $timestamp)));
}

/**
 * 返回本月开始的时间戳
 */
function get_month_zero_time()
{
    return  mktime(0, 0, 0, date('m'), 1, date('Y'));
}

/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function send_post($url, $post_data) {
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

/**生成30位的随机字符串
 * @param $param
 * @return string
 */
function getRandom( $length = 30 ) {
// 密码字符集，可任意添加你需要的字符
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = "";
    for ( $i = 0; $i < $length; $i++ )
    {
    // 这里提供两种字符获取方式
    // 第一种是使用 substr 截取$chars中的任意一位字符；
    // 第二种是取字符数组 $chars 的任意元素
    // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $password;
}

/**查询BU余额
 * @param $phone
 * @return int
 */
function getBuRemain($phone){
    $url="https://ubc.jinvovo.com";
	$terraceId ="0dae8af09fc4f40eb7e2dbcd38f416e7";//合作平台ID,公钥
	$secret="e44f277a1451b356dd88ac6da1e5a7ee";//私钥
    //接口参数
    $jiekouUrl="/app/myAssert?";
    $sendUrl=$url.$jiekouUrl;
    $add_arr=array('userMobile='.$phone);
    $canshu = array('terraceId='.$terraceId,'secret='.$secret, 'signType=MD5','version=v1.0', 'device=ANDROID');
    $canshu = array_merge($canshu,$add_arr);
    sort($canshu);
    $sendString = implode('&',$canshu);
    //$canshu[]= 'sign='.md5($sendString);

    $sendString = $sendString.'&sign='.md5($sendString);
    //$path = '/app/myAssert?';
    $path=$sendUrl.$sendString;
    $result=file_get_contents($path);
    $buf_arr= json_decode($result);
    echo "剩余BU:".$result."\n";
    if($buf_arr->code==200){
        return $buf_arr->asserts;
    }else{
        return 0;
    }
}

/**获取BU
 * @param $userMobile
 * @param $behaviorId
 * @param $money
 * @param $type 11任务，12斗地主，13麻将
 * @param null $tid
 * @param null $st
 * @return bool
 */
function getBu($userMobile,$behaviorId,$money,$type,$tid=null,$st=null){
    //接口参数
    $url="https://ubc.jinvovo.com";
    $terraceId =$tid==null?"0dae8af09fc4f40eb7e2dbcd38f416e7":$tid;//合作平台ID,公钥
    $secret=$st==null?"e44f277a1451b356dd88ac6da1e5a7ee":$st;//私钥
    $jiekouUrl="/app/v1/singleCreate?";
    $sendUrl=$url.$jiekouUrl;
    $orderNum=get_order_num();
    $originalMoney=1;
    $extra=1;
    $add_arr= array('userMobile='.$userMobile,'behaviorId='.$behaviorId,'orderNum='.$orderNum,'money='.$money,'originalMoney='.$originalMoney,'extra='.$extra);
    $canshu = array('terraceId='.$terraceId,'secret='.$secret, 'signType=MD5','version=v1.0', 'device=ANDROID');
    $canshu = array_merge($canshu,$add_arr);
    sort($canshu);
    $sendString = implode('&',$canshu);
    $sendString = $sendString.'&sign='.md5($sendString);
    $path=$sendUrl.$sendString;
    $result=file_get_contents($path);
//    $result=do_get($sendUrl,$canshu);
    $buf_arr= json_decode($result);
    echo "-获取BU-->".$result."\n";
    if($buf_arr->code==200){
        //添加发放BU记录
        add_BU_logs($userMobile,$type,1,"",$money,$behaviorId);
        return true;
    }else{
        return false;
    }
}

//function deal($fromUserMobile,$buAmount){
//    $url="https://ubc.jinvovo.com";
//    $terraceId ="0dae8af09fc4f40eb7e2dbcd38f416e7";//合作平台ID,公钥
//    $secret="e44f277a1451b356dd88ac6da1e5a7ee";//私钥
//    //接口参数
//    $jiekouUrl="/app/v1/generalTran";
//    $sendUrl=$url.$jiekouUrl;
//    $randomNum=getRandom();
//    $tranBody="buyGoods";
//    $toUserMobile="15723313021";
//    $outTradeNo = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
//    $createIp="47.102.36.37";//IP地址
//    $startTime=date('Ymdhis', time());//交易开始时间搓,时间搓格式yyyyMMddHHmmss
//    $add_arr= array('fromUserMobile'=>$fromUserMobile,'toUserMobile'=>$toUserMobile,'randomNum'=>$randomNum,'tranBody'=>$tranBody,'outTradeNo'=>$outTradeNo,'createIp'=>$createIp,'buAmount'=>$buAmount,'startTime'=>$startTime,'tranTypeCode'=>"015003A023B399");
//    $canshu = array('terraceId'=>$terraceId,'secret'=>$secret, 'signType'=>'MD5','version'=>'v1.0', 'device'=>'ANDROID');
//    $canshu = array_merge($canshu,$add_arr);
//    ksort($canshu);
//    $sign_str=http_build_query($canshu);
//    $sign=md5($sign_str);
//    $arr=array('sign'=>$sign);
//    $canshu = array_merge($canshu,$arr);
//    $result=do_get($sendUrl,$canshu);
//    $buf_arr= json_decode($result);
//    echo "--->".$result."\n";
//    if($buf_arr->code==200){
//        return true;
//    }else{
//        return false;
//    }
//}

function deal($fromUserMobile,$buAmount,$type){
    $url="https://ubc.jinvovo.com";
    $terraceId ="0dae8af09fc4f40eb7e2dbcd38f416e7";//合作平台ID,公钥
    $secret="e44f277a1451b356dd88ac6da1e5a7ee";//私钥
    //接口参数
    $jiekouUrl="/app/v1/generalTran?";
    $sendUrl=$url.$jiekouUrl;
    $randomNum=getRandom();
    $tranBody="buyGoods";
    $toUserMobile="15723313021";
    $outTradeNo = get_order_num();
    $createIp="47.102.36.37";//IP地址
    $startTime=date('Ymdhis', time());//交易开始时间搓,时间搓格式yyyyMMddHHmmss
    $add_arr= array('fromUserMobile='.$fromUserMobile,'toUserMobile='.$toUserMobile,'randomNum='.$randomNum,'tranBody='.$tranBody,'outTradeNo='.$outTradeNo,'createIp='.$createIp,'buAmount='.$buAmount,'startTime='.$startTime,'tranTypeCode=015003A023B399');
    $canshu = array('terraceId='.$terraceId,'secret='.$secret, 'signType=MD5','version=v1.0', 'device=ANDROID');
    $canshu = array_merge($canshu,$add_arr);
    sort($canshu);
    $sendString = implode('&',$canshu);
    $sendString = $sendString.'&sign='.md5($sendString);
    $path=$sendUrl.$sendString;
    $result=file_get_contents($path);
//    $result=do_get($sendUrl,$canshu);
    $buf_arr= json_decode($result);
    echo "--->".$result."\n";
    if($buf_arr->code==200){
        //添加BU回收记录
        add_BU_logs($fromUserMobile,$type,2,"",$buAmount,"");
        return true;
    }else{
        return false;
    }
}

/**发送get请求
 * @param $url
 * @param $params
 * @return false|string
 */
function do_get($url, $params) {
    $url = "{$url}?" . http_build_query ( $params );
    $result = file_get_contents($url);
    return $result;
}

/**获取订单号
 * @return string
 */
function get_order_num() {
    return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

/**获取
 * @return bool|mixed
 */
function get_real_ip()

{

    $ip=FALSE;

    //客户端IP 或 NONE

    if(!empty($_SERVER["HTTP_CLIENT_IP"])){

        $ip = $_SERVER["HTTP_CLIENT_IP"];

    }

    //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);

        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }

        for ($i = 0; $i < count($ips); $i++) {

            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {

                $ip = $ips[$i];

                break;

            }

        }

    }

    //客户端IP 或 (最后一个)代理服务器 IP

    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);

}

/**添加BU记录
 * @param $uid
 * @param $type 11斗地主，12麻将
 * @param $send_back 1发放，2回收
 * @param $remark 备注
 * @param $num数量
 */
function add_BU_logs($phone,$type,$send_back,$remark,$num,$behaviorId){
    $hall_log = mongo_db::singleton("hall_log");
    $rows=[['phone'=>$phone,'add_time'=>time(),'send_back'=>$send_back,'type'=>$type,'remark'=>$remark,'num'=>$num,'behaviorId'=>$behaviorId]];
    $hall_log->insert("BU_logs", $rows);
}



