<?php
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
    return 1000;
    global $monodb;
    $player=$monodb->test->updateOne(['uid'=>$playerId],['$inc'=>['win_count'=>$incr]]);
}
function game_db_get_user_game_info($playerId,$recordBar)
{
    return null;
    global $monodb;
    $player=$monodb->test->findOne(['uid'=>$playerId]);
    return $player;
}
function game_set_tack($playerId,$type,$count=1)
{
    //global $monodb;
   // $player=$monodb->test->findOne(['uid'=>$playerId]);
    //return $player;
}