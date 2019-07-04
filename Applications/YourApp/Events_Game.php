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

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
require_once 'src_game/switch.php';
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
$test_xx_count=0;
class Events_Game
{

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        global $tcp_worker;
        global $connection_count;
        $connection_count++;
        $log = "a client connect! worker id :$tcp_worker->id connection client count : $connection_count";
        util_log($log);
        echo "a client connect! worker id :$tcp_worker->id connection client count : $connection_count";
//    $addCoinLog = new AddCoinLog();
        // 向当前client_id发送数据 
        //Gateway::sendToClient($client_id, "Hello $client_id\r\n");
        // 向所有人发送
        //Gateway::sendToAll("$client_id login\r\n");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $packet)
   {
       //echo substr($packet,0,4);
       // 向客户端发送hello $data
//       if(unpack('i*',substr($packet,0,4))[1]!=strlen($packet))
//       {
//           $test_count1++;
//           echo $test_count1;
//           echo "bad pack!";
//           return ;
//       }

       self::nianbao($packet,$client_id);
      // message_switch($client_id,unpack('i*',substr($packet,4,4))[1],substr($packet,8));
        // 向所有人发送 
        //Gateway::sendToAll("$client_id said $message\r\n");
   }
    public static function nianbao($packet,$client_id)
    {
        global $test_xx_count;
        //剩余包长
        $len_packet = strlen($packet);
        //截取包长
        $len = unpack('I*',substr($packet,0,4))[1];
        while ($len_packet>=$len)
        {
            //截取包
            $data = substr($packet,8,$len-8);
            switch_game($client_id,unpack('I*',substr($packet,4,4))[1],$data);
            //剩余包长
            $packet = substr($packet,$len);
            $len_packet=$len_packet-$len;
            if($packet ==null)
            {
                break;
            }
            //解包出错，跳出
            if(!isset(unpack('I*',substr($packet,0,4))[1]))
            {
                break;
            }
            //新包长
            $len = unpack('I*',substr($packet,0,4))[1];
        }
    }
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       //用户退出
       global $tcp_worker;
       global $connection_count;
       $connection_count--;
       $log = "a client connect! worker id :$tcp_worker->id connection client count : $connection_count\n";
       util_log($log);
      echo "a client close! worker id :$tcp_worker->id connection client count : $connection_count\n";
       // 向所有人发送 
      // GateWay::sendToAll("$client_id logout\r\n");

//       if(isset($_SESSION['uid'])){
//           echo "ccc\n";
//           $nowTime=date('Y-m-d h:i:s', time());
//           $uid=$_SESSION['uid'];
//           $sql="update bolaik_user.user_info set rmb=0 where user_id=$uid";
//           db_query($sql);
//           $sql="update bolaik_user.user_stat_time set login_out_time='$nowTime' where user_id=$uid order by id desc limit 1 ";
//           db_query($sql);
//       }

   }
}
