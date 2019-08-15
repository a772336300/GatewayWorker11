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

use \MongoDB\Client;
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
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
require_once 'src/Proto/Autoloader.php';
require_once 'src/mongo_db.php';
require_once 'src_game/Proto/Autoloader.php';
require_once 'src_game/play.php';
require_once 'src_game/card.php';
require_once 'src_game/db_repository.php';
require_once 'src_game/redis.php';
require_once 'src_game/send_pack.php';
require_once 'src_game/proto_arr.php';
require_once 'src_game/Manager/room_manager.php';
// bussinessWorker 进程
$tcp_worker = new BusinessWorker();
// worker名称
$tcp_worker->eventHandler='Events_Game';
$tcp_worker->name = 'game_worker';
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
$redis = null;
$monodb= null;
//worker进程开始
$tcp_worker->onWorkerStart = function ($worker)
{
    global $tcp_worker;
    global $config;
    global $redis;
    global $monodb;
    //初始化数据库
    $tcp_worker->db= new \Workerman\MySQL\Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);

    $redis = new Redis();
    $redisCon=$redis->pconnect('127.0.0.1');
    //#test
    global $cardModel;
    $redis->flushAll();
    foreach ($cardModel as $item)
        $redis->sAdd('cardsModel',$item);
   // $monodb = new MongoDB\Client();
    $monodb= new MongoDB\Client("mongodb://{$config['mongodb']['address']}");
    //$monodb= new MongoDB\Client("mongodb+srv://myTester:xyz123@{$config['mongodb']['address']}?retryWrites=true&w=majority");
    //$monodb_test = $monodb->test;
    //room_manager::singleton()->start_game_room();
};


// 新增加一个属性，用来保存uid到connection的映射
$tcp_worker->uidConnections = array();

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

