<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \Workerman\Lib\Timer;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;

// 自动加载类
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/workerman/workerman/mysql/src/Connection.php';
require_once 'config.php';
require_once 'user_init.php';
require_once 'src/number_object_map.php';
require_once 'src/task_event_map.php';
require_once 'src/db_repository.php';
require_once 'src/send_pack.php';
require_once 'src/packet.php';
require_once 'src/task.php';
require_once 'src/web_server_message_manager.php';
require_once 'src/init_equipment.php';
require_once 'src/jinlian.php';
require_once 'src/http_client.php';
require_once 'src/mongo_db.php';
require_once 'src/hall.php';
// bussinessWorker 进程
$tcp_worker = new BusinessWorker();
// worker名称
$tcp_worker->name = 'YourAppBusinessWorker';
// bussinessWorker进程数量
$tcp_worker->count = 1;
// 服务注册地址
$tcp_worker->registerAddress = '127.0.0.1:1238';



$tcp_worker->product_uid_count = 0;
//连接数
$connection_count = 0;


//设置db
$tcp_worker->db = null;
//设置db_web
//$tcp_worker->db_web = null;
//设置任务服务器连接句柄
$tcp_worker->taskServerConnections = array();
//连接数缓存
$tcp_worker->taskServerConnectionsCount=0;
//下次发送到任务服务器目标
$tcp_worker->taskServerConnectionsIndex=0;
$test_count=0;
$test_count1=0;
//worker进程开始
$tcp_worker->onWorkerStart = function ($worker)
{
    global $tcp_worker;
    global $config;

    if($worker->id === 0)
    {
        echo "只在0号进程设置定时器\n";
        // 10秒后执行发送邮件任务，最后一个参数传递false，表示只运行一次
        $timetoday = strtotime(date("Y-m-d",time()));
        $tomorrow = $timetoday + 3600*24;
        $syTime=$tomorrow-time();
        //明天零点执行更新任务
        Timer::add($syTime, 'zero_update', null, false);
    }

    //初始化数据库
    $tcp_worker->db= new \Workerman\MySQL\Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);
    refreshUserInit();
    echo "初始化！ $worker->id\n";
    //更新没正常推出游戏的用户数据（包含重启服务器，导致用户没退出记录）
    $nowTime=date('Y-m-d h:i:s', time());
    $sql="update bolaik_user.user_info set rmb=0 where rmb=1";
    db_query($sql);
    $sql="update bolaik_user.user_stat_time set login_out_time='$nowTime' where login_out_time is null ";
    db_query($sql);

    $worker->mongodb = mongo_db::singleton();

    //$worker->db_web= new \Workerman\MySQL\Connection($config['db_web']['host'],$config['db_web']['port'],$config['db_web']['user'],$config['db_web']['password'],$config['db_web']['dbname'],$config['db_web']['charset']);
    //$worker->db= new Connection('192.168.0.200','3306','dgame','123456','mytest','utf8');

//    // 开启任务worker进程
//    $socket= 'tcp://0.0.0.0:803'.$worker->id;
//    $inner_task_worker = new Worker($socket);
//    $inner_task_worker->reusePort = true;
//    //当有任务服务器连接上来，保存连接
//    $inner_task_worker->onConnect = function ($connection)
//    {
//        global $tcp_worker;
//        $tcp_worker->taskServerConnections[]=$connection;
//        $tcp_worker->taskServerConnectionsCount++;
//        echo $tcp_worker->taskServerConnectionsCount;
//        //任务请求
//        $task_event = new \Proto\SM_Task_Event();
//        $task_event->setTaskType(\Proto\MY_TASK_TYPE::MY_INIT);
//        //send_to_task_server(my_pack_with_uid(535,$connection->phone,$task_event->serializeToString()));
//
//        $connection->send(my_pack_with_uid(500,1,''));
//        echo "a task server connect!! worker $tcp_worker->id port 803$tcp_worker->id!! current count: $tcp_worker->taskServerConnectionsCount!\n";
//    };
//    //接收任务服务器消息
//    $inner_task_worker->onMessage = function($connection, $packet)
//    {
//        echo 'message from task server!';
//        on_task_server_message_switch($packet);
//    };
//    //断开连接时删除连接句柄
//    $inner_task_worker->onClose = function($connection)
//    {
//        global $tcp_worker;
//        if(in_array($connection,$tcp_worker->taskServerConnections))
//        {
//            unset($tcp_worker->taskServerConnections[$connection->id]);
//            $tcp_worker->taskServerConnectionsCount--;
//            echo "a task server close!!left count : $tcp_worker->taskServerConnectionsCount\n";
//        }
//    };
//    // ## 执行监听 ##
//    $inner_task_worker->listen();
//    echo "start task service listen $socket\n";
    //定时器
};


function refreshUserInit()
{
    $refresh_arr = array();
    global $init_user_config;
    global $init_user_config_map;
    $init_user_config_tmp= db_get_user_init();
    foreach ($init_user_config_tmp as $item)
    {
        if($item['id']==$init_user_config_map['gold'])
        {
            $init_user_config['gold']=(int)$item['value'];
            continue;
        }
        if($item['id']==$init_user_config_map['BU'])
        {
            $init_user_config['BU']=(int)$item['value'];
            continue;
        }
        if($item['id']==$init_user_config_map['vigour'])
        {
            $init_user_config['vigour']=(int)$item['value'];
            continue;
        }
        if($item['id']==$init_user_config_map['shangchengkaiguan'])
        {
            if($init_user_config['shangchengkaiguan']!=(int)$item['value'])
            {
                $refresh_arr[4]=(int)$item['value'];
            }
            $init_user_config['shangchengkaiguan']=(int)$item['value'];
            continue;
        }
        if($item['id']==$init_user_config_map['shimingkaiguan'])
        {
            if($init_user_config['shimingkaiguan']!=(int)$item['value'])
            {
                $refresh_arr[5]=(int)$item['value'];
            }
            $init_user_config['shimingkaiguan']=(int)$item['value'];
            continue;
        }
    }
    return $refresh_arr;
}

// 新增加一个属性，用来保存uid到connection的映射
$tcp_worker->uidConnections = array();

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

