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

use MongoDB\Client;
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
require_once 'src_game/Proto/Autoloader.php';
require_once 'src_game/play.php';
require_once 'src_game/card.php';
require_once 'src_game/db_repository.php';
require_once 'src_game/redis.php';
require_once 'src_game/send_pack.php';
require_once 'src_game/proto_arr.php';
// bussinessWorker 进程
$game_worker = new BusinessWorker();
// worker名称
$game_worker->eventHandler='Events_Game';
$game_worker->name = 'game_worker';
// bussinessWorker进程数量
$game_worker->count = 1;
// 服务注册地址
$game_worker->registerAddress = '127.0.0.1:1239';



$game_worker->product_uid_count = 0;

//设置db
$game_worker->db = null;
//设置db_web
//$game_worker->db_web = null;
//设置任务服务器连接句柄
$game_worker->taskServerConnections = array();
//连接数缓存
$game_worker->taskServerConnectionsCount=0;
//下次发送到任务服务器目标
$game_worker->taskServerConnectionsIndex=0;
$redis = null;
$monodb= null;
//worker进程开始
$game_worker->onWorkerStart = function ($worker)
{
    global $cardModel;
    global $game_worker;
    global $config;
    global $redis;
    //初始化数据库
    //$game_worker->db= new \Workerman\MySQL\Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);

    $redis = new Redis();
    $redisCon=$redis->pconnect('127.0.0.1');
    $redis->flushAll();
    foreach ($cardModel as $item)
        $redis->sAdd('cardsModel',$item);

   // $monodb = new MongoDB\Client();
    //$monodb= new MongoDB\Client('mongodb+srv://myTester:xyz123@127.0.0.1:27017/test?retryWrites=true&w=majority');
    //$monodb_test = $monodb->test;
};


// 新增加一个属性，用来保存uid到connection的映射
$game_worker->uidConnections = array();

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

