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
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;
use GatewayWorker\Protocols\GatewayProtocol;
require_once 'model_router.php';
// 自动加载类
require_once __DIR__ . '/../../vendor/autoload.php';

// gateway 进程，这里使用Text协议，可以用telnet测试
$gateway = new Gateway("tcp://0.0.0.0:8080");
// gateway名称，status方便查看
$gateway->name = 'YourAppGateway';
// gateway进程数
$gateway->count = 1;
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = '127.0.0.1';
// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口 
$gateway->startPort = 2900;
// 服务注册地址
$gateway->registerAddress = '127.0.0.1:1238';

$gateway->router = function ($worker_connections, $client_connection, $cmd, $buffer)
{


    global $default_model;
    global $models;
    global $model_router;
    foreach ($models as $model)
    {
        if (!isset($client_connection->model_address[$model]) || !isset($worker_connections[$client_connection->model_address[$model]])) {
            $add_address_list = [];
            foreach ($worker_connections as $key =>$value)
            {
                list(,$worker_name,)=explode(':',$key,3);
                if($worker_name==$model)
                {
                    $add_address_list[$key]=1;
                }
            }
            $client_connection->model_address[$model] = array_rand($add_address_list);
        }
    }
    if($cmd==GatewayProtocol::CMD_ON_MESSAGE)
    {
        $mid =unpack('I*',substr($buffer,4,4))[1];
        if(!isset($model_router[$mid]))
        {
            return $worker_connections[$client_connection->model_address[$default_model]];
        }
        $model = $model_router[$mid];
        return $worker_connections[$client_connection->model_address[$model]];
    }
    return $worker_connections[$client_connection->model_address[$default_model]];
};


// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

