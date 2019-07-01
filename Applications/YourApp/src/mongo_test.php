<?php

require_once 'mongo_db.php';
// 示例代码

//$db = mongo_db::singleton("bolaik_db"); // 使用配置self::$_config["bolaik_db"]
$db = mongo_db::singleton();         // 使用配置self::$_config[self::$def]
$collname = "user_bag";
/*
 echo "\n---------- 查询支持命令 -----------\n";
 $cmd = [
     "listCommands" => 1,
 ];
 $rs = $db->command($cmd);
 print_r($rs->toArray());

*/
/*
echo "\n---------- 删除 proinfo 所有数据 -----------\n";
$delets = [
    ["q" => [],"limit" => 0]
];
$rs = $db->del($collname, $delets);
print_r($rs->toArray());
*/
/*
echo "\n---------- 创建索引 -----------\n";
$cmd = [
    "createIndexes" => $collname,
    "indexes"       => [
        ["name" => "proname_idx", "key" => ["name"=>1],"unique" => true],
    ],
];
$rs = $db->command($cmd);
print_r($rs->toArray());
*/
/*
echo "\n---------- 查询索引 -----------\n";
$cmd = [
    "listIndexes" => $collname,
];
$rs = $db->command($cmd);
print_r($rs->toArray());
*/
/*
echo "\n------------ 插入数据 ---------\n";
$rows = [
    ["name" => "ns w1","type"=>"ns","size"=>["height"=>150,"width"=>30],"price"=>3000],
    ["name" => "ns hd","type"=>"ns","size"=>["height"=>154,"width"=>30],"price"=>3500],
];
$rs = $db->insert($collname, $rows);
print_r($rs->toArray());
*/

echo "\n---------- 查询数据 -----------\n";
$filter = [
    "id" => ['$gt' => 101]//查询条件 id 大于 0
];
$queryWriteOps = [
    "projection" => ["_id"=> 0],//不输出_id字段
    "sort"       => ["id" => 1],//根据id字段排序 1是升序，-1是降序
    "limit"      => 2
];
$rs = $db->query($collname, $filter, $queryWriteOps);
print_r($rs->toArray());
/**/
/*
echo "\n---------- 更新数据 -----------\n";
$updates = [
    [
        "q"     => ["name" => "ns w3"],
        "u"     => ['$set' => ["size.height" => 140],'$inc' => ["size.width" => 14]],
        "multi" => true,
    ]
];
$rs = $db->update($collname, $updates);
print_r($rs->toArray());

echo "\n---------- 查询数据 -----------\n";
$filter = [
    "name" => "ns w3",
];
$rs = $db->query($collname, $filter, $queryWriteOps);
print_r($rs->toArray());

//localhost  "mongodb://admin:12345678@192.168.138.35:27017"
$manager = new MongoDB\Driver\Manager('mongodb://dgame:123456@127.0.0.1:27017');
echo "aaaaaaaaaaaaaaaaaaaaaaaaa \n";
$query = new MongoDB\Driver\Query(['age' => 24], ['sort' => ['age' => 1]]);
echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbbb \n";
$cursor = $manager->executeQuery('wjt.friend', $query);

$data = [];
foreach($cursor as $doc) {
    $data[] = $doc;
}
echo '<pre>';
print_r($data);

?>php
*/

/*
// connect to mongodb
$manager = new MongoDB\Driver\Manager("mongodb://dgame:123456@127.0.0.1:27017");

$command = new MongoDB\Driver\Command(array("ping" => 1));
$result = $manager->executeCommand("test", $command);

var_dump($result, $result->toArray());
*/