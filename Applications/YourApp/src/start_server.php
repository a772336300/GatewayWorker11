<?php

use \Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
use Workerman\Mysql\Connection;
use \Workerman\Lib\Timer;
require_once __DIR__ . '/Workerman/Autoloader.php';
require_once __DIR__ . '/Workerman/mysql/src/Connection.php';
require_once 'packet.php';
require_once 'switch.php';
require_once 'task.php';
require_once 'db_repository.php';
require_once 'mongo_db.php';
//初始化数据库
//$db= new Connection('192.168.0.200','3306','dgame','123456','mytest','utf8');
//$db= new Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);
// 创建一个Worker监听端口，不使用任何应用层协议
$tcp_worker = new Worker("tcp://0.0.0.0:8080");

//生产用户账号
$tcp_worker->product_uid_count = 0;
//连接数
$connection_count = 0;

// 启动1个进程对外提供服务
$tcp_worker->count = 1;

//设置db
$tcp_worker->db = null;

$tcp_worker->mongo_db = null;

//设置任务服务器连接句柄
$tcp_worker->taskServerConnections = array();
//连接数缓存
$taskServerConnectionsCount=0;
//下次发送到任务服务器目标
$taskServerConnectionsIndex=1;
$test_count=0;
$test_count1=0;
//worker进程开始

$tcp_worker->onWorkerStart = function ($worker)
{
    global $config;
    //初始化数据库
    $worker->db= new Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);
    //$worker->db= new Connection('192.168.0.200','3306','dgame','123456','mytest','utf8');

    // 开启任务worker进程
    $socket= 'tcp://0.0.0.0:803'.$worker->id;
    $inner_task_worker = new Worker($socket);
    $inner_task_worker->reusePort = true;
    //当有任务服务器连接上来，保存连接
    $inner_task_worker->onConnect = function ($connection)
    {
        global $tcp_worker;
        global $taskServerConnectionsCount;
        $tcp_worker->taskServerConnections[]=$connection;
        $taskServerConnectionsCount++;


        //任务请求
        $task_event = new \Proto\SM_Task_Event();
        $task_event->setTaskType(\Proto\MY_TASK_TYPE::MY_INIT);
        //send_to_task_server(my_pack_with_uid(535,$connection->phone,$task_event->serializeToString()));

        $connection->send(my_pack_with_uid(500,1542121453,''));
        echo "a task server connect!! worker $tcp_worker->id port 803$tcp_worker->id!! current count: $taskServerConnectionsCount!\n";
    };
    //接收任务服务器消息
    $inner_task_worker->onMessage = function($connection, $packet)
    {
        echo 'message from task server!';
        on_task_server_message_switch($packet);
    };
    //断开连接时删除连接句柄
    $inner_task_worker->onClose = function($connection)
    {
        global $tcp_worker;
        global $taskServerConnectionsCount;
        if(in_array($connection,$tcp_worker->taskServerConnections))
        {
            unset($tcp_worker->taskServerConnections[$connection->id]);
            $taskServerConnectionsCount--;
            echo "a task server close!!left count : $taskServerConnectionsCount\n";
        }
    };
    // ## 执行监听 ##
    $inner_task_worker->listen();
    echo "start task service listen $socket\n";
};

// 新增加一个属性，用来保存uid到connection的映射
$tcp_worker->uidConnections = array();

$tcp_worker->onConnect = function($connection)
{
    global $tcp_worker;
    global $connection_count;
    $connection_count++;
    echo "a client connect! worker id :$tcp_worker->id connection client count : $connection_count\n";

//    if(isset($_SESSION['uid'])){
//        $nowTime=date('Y-m-d h:i:s', time());
//        $sql="update bolaik_user.user_stat_time set login_out_time=$nowTime where user_id=$connection->id";
//        db_query($sql);
//    }

//    $addCoinLog = new AddCoinLog();
//    $addCoinLog->setBehaviorId(100);
//    $addCoinLog->setGetPropId(123);
//
//    send_to_task_server(my_pack(535,$addCoinLog->serializeToString()));
    //print('connect!');
    // 给connection对象临时添加一个timer_id属性保存定时器id
    // $connection->timer_id = Timer::add($time_interval, function()use($connection, $connect_time)
    // {
    //      $connection->send($connect_time);
    //      print('sendtime!');
    // });
};
// 当客户端发来数据时
$tcp_worker->onMessage = function($connection, $packet)
{

    //echo substr($packet,0,4);
    // 向客户端发送hello $data
    global $test_count;
    global $test_count1;
    $test_count++;
    echo $test_count;
    echo "\n";
    if(unpack('i*',substr($packet,0,4))[1]!=strlen($packet))
    {
        $test_count1++;
        echo $test_count1;
        echo "bad pack!";
        return ;
    }

    message_switch($connection,unpack('i*',substr($packet,4,4))[1],substr($packet,8));

};
$tcp_worker->onClose = function ($connection)
{
  //用户退出
    global $tcp_worker;
    global $connection_count;
    $connection_count--;
    echo "a client close! worker id :$tcp_worker->id connection client count : $connection_count\n";
};
$tcp_worker->onError = function($connection, $code, $msg)
{
    echo "error $code $msg\n";
};

////初始化连接地图服务器
//$task_service = new AsyncTcpConnection("tcp://192.168.0.200:8030");
//
//$task_service->onConnect = function ($connection)
//{
//    //发送注册消息
//    $connection->send(pack("i*",12+strlen($body),40000,0).$body;);
//    echo "task_server connect success!";
//};
//$task_service->onMessage = function ($connection,$data)
//{
//    on_task_server_message($connection,$data);
//};
//$task_service->onClose = function ($connection)
//{
//    echo "task_server close!";
//    Worker::stopAll();
//};
//$task_service->connect();
// 运行worker
Worker::runAll();