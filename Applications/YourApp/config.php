<?php
$config=[
//    'db'=>['host'  => 'bolaike01.mysql.rds.aliyuncs.com',
//        'port'     => '3306',
//        'user'     => 'bolaik_db_user',
//        'password' => 'b0laik@db0#7',
//        'dbname'   => 'bolaik_db',
//        'charset'  => 'utf8',
//        ],
        'db'=>['host'  => '192.168.0.241',
        'port'     => '3306',
        'user'     => 'dgame',
        'password' => '123456',
        'dbname'   => 'bolaik_db',
        'charset'  => 'utf8',
        ],
    // 'db_web'=>['host'  => '192.168.0.200',
    //     'port'     => '3306',
    //     'user'     => 'dgame',
    //     'password' => '123456',
    //     'dbname'   => 'mytest',
    //     'charset'  => 'utf8',
    // ],
    'client_version'=>'1.0.0',
];
$web_user = 'bolaik_user';
$task_type= [
    'feiJi'=>1000,
    'huoJian'=>1001,
    '3DaoAShunZi'=>1002,
    'lianDui'=>1003,
    'zhaDan'=>1004,
    'sanDaiYi'=>1005,
];