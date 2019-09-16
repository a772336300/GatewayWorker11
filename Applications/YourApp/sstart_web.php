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

use MongoDB\BSON\ObjectId;
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
$tcp_worker = new Worker('http://0.0.0.0:8082');
// worker名称
$tcp_worker->name = 'Web_Server';
// bussinessWorker进程数量
$tcp_worker->count = 1;

//连接数
$connection_count = 0;


//设置db
$tcp_worker->db = null;

//worker进程开始
$tcp_worker->onWorkerStart = function ($worker)
{
    global $tcp_worker;
    global $config;

    //初始化数据库
    $tcp_worker->db= new \Workerman\MySQL\Connection($config['db']['host'],$config['db']['port'],$config['db']['user'],$config['db']['password'],$config['db']['dbname'],$config['db']['charset']);

};
$tcp_worker->onMessage = function ($connection,$message)
{
    echo "\nget message $message\n";
    //web_server_message_manager($message);
    $connection->send($message);
};
// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

