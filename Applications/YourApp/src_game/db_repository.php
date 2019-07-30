<?php
require_once __DIR__.'/../src/task.php';
require_once __DIR__.'/../src/hall.php';
require_once __DIR__.'/../src/util.php';
function game_db_get_gold($playerId)
{
    return 100000;
    global $monodb;
    $player=$monodb->test->findOne(['uid'=>$playerId]);
    return $player->gold;
}
function game_db_lock_gold($playerId,$gold)
{
    return 1000;
    global $monodb;
    $player=$monodb->test->updateOne(['uid'=>$playerId],['$set'=>['lock_gold'=>$gold],'$inc'=>['gold'=>-$gold]]);
    //$db->row('update `person` set lock_gold=300,gold=gold-300 WHERE identifier=\''.$playerId.'\'');
}
function game_db_user_win_count_incr($playerId,$incr)
{
    global $monodb;
    $player=$monodb->test->updateOne(['uid'=>$playerId],['$inc'=>['win_count'=>$incr]]);
}
function game_db_get_user_game_info($playerId,$recordBar)
{
    global $monodb;
    $player=$monodb->test->findOne(['uid'=>$playerId]);
    return $player;
}
function game_set_tack($playerId,$type,$count=1)
{
    update($type,$count,$playerId);
    //global $monodb;
    // $player=$monodb->test->findOne(['uid'=>$playerId]);
    //return $player;
}
function game_db_user_liansheng_over($playId)
{
    global $monodb;
    $monodb->game->user->updateOne(['uid'=>$playId],['$set'=>['liansheng'=>0]]);
}
function game_db_user_liansheng_add($playId)
{
    global $monodb;
    $monodb->game->user->updateOne(['uid'=>$playId],['$inc'=>['liansheng'=>1]]);
}
function game_db_user_liansheng_count($playId)
{
    global $monodb;
    $player=$monodb->game->user->findOne(['uid'=>$playId]);
    return $player['liansheng'];
}
function game_db_give_jiangli($winCount,$player)
{
    $result=array();
    global $monodb;
    $gives=$monodb->game_config->lianshengliangli->find(['count'=>$winCount]);
    //$winCount;
    foreach ($gives as $give)
    {
        if($give['baseBU'])
        {
            $clientIdArr=\GatewayWorker\Lib\Gateway::getClientIdByUid($player);
            $session=\GatewayWorker\Lib\Gateway::getSession($clientIdArr[0]);
            if(isset($session['phone']))
            {
                if(getBu($session['phone'],$give['behaviorId'],$give['BU']))
                {
                    $result['baseBU']=$give['BU'];
                    continue;
                }
                //获取BU失败；
            }
            continue;
        }
        if($give['extraBU'])
        {
            $clientIdArr=\GatewayWorker\Lib\Gateway::getClientIdByUid($player);
            $session=\GatewayWorker\Lib\Gateway::getSession($clientIdArr[0]);
            if(isset($session['phone']))
            {
                if(getBu($session['phone'],$give['behaviorId'],$give['BU']))
                {
                    $result['extraBU']=$give['BU'];
                    continue;
                }
                //获取BU失败；
            }
            continue;
        }
        add_user_packet($give['goods'],$player,null,$give['description'],$give['count']);
        $result['goods'][$give['goods']]=$give['count'];
    }
    return $result;
}
function game_db_store_game_result($roomId,$infos,$channel)
{
    global $monodb;
    foreach ($infos as $playId=>$info)
    {
        //$player=$monodb->hall_log->game_log->updateOne(['uid'=>$playId],['$set'=>['roomid'=>$roomId,'game_type'=>'doudizhu'.$channel,'score'=>],'$inc'=>['gold'=>-$gold]]);
        $monodb->hall_log->game_log->insertOne(['uid'=>$playId,'roomid'=>$roomId,'game_type'=>'doudizhu'.$channel,'score'=>$info['gold']]);
    }

}