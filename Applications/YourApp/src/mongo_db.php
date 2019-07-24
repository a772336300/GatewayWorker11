<?php
/**
 * mongoDB 简单 封装
 * 请注意：mongoDB 支持版本 3.2+
 * 具体参数及相关定义请参见： https://docs.mongodb.com/manual/reference/command/
 *
 * @author color_wind
 */
final class mongo_db {
    //--------------  定义变量  --------------//
    private static $ins     = [];
    private static $def     = "test";
    private $_conn          = null;
    private $_db            = null;
    private static $_config = [
        "bolaik_db"     => ["url" => "mongodb://dgame:123456@192.168.0.32:27017","dbname" => "bolaik_db"],
        "bolaik_order"  => ["url" => "mongodb://dgame:123456@192.168.0.32:27017","dbname" => "bolaik_order"],
        "bolaik_user"   => ["url" => "mongodb://dgame:123456@192.168.0.32:27017","dbname" => "bolaik_user"],
        "func_system"   => ["url" => "mongodb://dgame:123456@192.168.0.32:27017","dbname" => "func_system"],
        "mall_system"   => ["url" => "mongodb://dgame:123456@192.168.0.32:27017","dbname" => "mall_system"],
        "hall_config"   => ["url" => "mongodb://192.168.0.35:27017","dbname" => "hall_config"],
        "hall_log"      => ["url" => "mongodb://192.168.0.35:27017","dbname" => "hall_log"],
        "test"   => ["url" => "mongodb://192.168.0.35:27017","dbname" => "test"],
    ];

    /**
     * 创建实例
     * @param  string $confkey
     * @return \mongo_db
     */
    static function singleton($confkey = NULL) {
        if (!$confkey) {
            $confkey = self::$def;
        }
        if (!isset(self::$ins[$confkey]) && ($conf = self::$_config[$confkey])) {
            $m = new mongo_db($conf);
            self::$ins[$confkey] = $m;
        }
        return self::$ins[$confkey];
    }

    private function __construct(array $conf) {
        $this->_conn = new MongoDB\Driver\Manager($conf["url"]."/{$conf["dbname"]}?authSource=admin");
        $this->_db   = $conf["dbname"];
    }

    /**
     * 插入数据
     * @param  string $collname
     * @param  array  $documents    [["name"=>"values", ...], ...]
     * @param  array  $writeOps     ["ordered"=>boolean,"writeConcern"=>array]
     * @return \MongoDB\Driver\Cursor
     */
    function insert($collname, array $documents, array $writeOps = []) {
        $cmd = [
            "insert"    => $collname,
            "documents" => $documents,
        ];
        $cmd += $writeOps;
        return $this->command($cmd);
    }

    /**
     * 删除数据
     * @param  string $collname
     * @param  array  $deletes      [["q"=>query,"limit"=>int], ...]
     * @param  array  $writeOps     ["ordered"=>boolean,"writeConcern"=>array]
     * @return \MongoDB\Driver\Cursor
     */
    function del($collname, array $deletes, array $writeOps = []) {
        foreach($deletes as &$_){
            if(isset($_["q"]) && !$_["q"]){
                $_["q"] = (Object)[];
            }
            if(isset($_["limit"]) && !$_["limit"]){
                $_["limit"] = 0;
            }
        }
        $cmd = [
            "delete"    => $collname,
            "deletes"   => $deletes,
        ];
        $cmd += $writeOps;
        return $this->command($cmd);
    }

    /**
     * 更新数据
     * @param  string $collname
     * @param  array  $updates      [["q"=>query,"u"=>update,"upsert"=>boolean,"multi"=>boolean], ...]
     * @param  array  $writeOps     ["ordered"=>boolean,"writeConcern"=>array]
     * @return \MongoDB\Driver\Cursor
     */
    function update($collname, array $updates, array $writeOps = []) {
        $cmd = [
            "update"    => $collname,
            "updates"   => $updates,
        ];
        $cmd += $writeOps;
        return $this->command($cmd);
    }

    /**
     * 查询
     * @param  string $collname
     * @param  array  $filter     [query]     参数详情请参见文档。
     * @return \MongoDB\Driver\Cursor
     */
    function query($collname, array $filter, array $writeOps = []){
        $cmd = [
            "find"      => $collname,
            "filter"    => $filter
        ];
        $cmd += $writeOps;
        $rs=$this->command($cmd);
        return $rs->toArray();
    }

    /**
     * 聚合查询
     * @param $collName
     * @param array $where
     * @param array $group
     * @return \MongoDB\Driver\Cursor
     */
    function aggregate($cmd)
    {
        $result = $this->command($cmd)->toArray();
        return $result;
    }


    /**
     * 执行MongoDB命令
     * @param array $param
     * @return \MongoDB\Driver\Cursor
     */
    function command(array $param) {
        $cmd = new MongoDB\Driver\Command($param);
        return $this->_conn->executeCommand($this->_db, $cmd);
    }

    /**
     * 获取当前mongoDB Manager
     * @return MongoDB\Driver\Manager
     */
    function getMongoManager() {
        return $this->_conn;
    }
}
?>php
