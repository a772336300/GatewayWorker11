<?php
use GatewayWorker\Lib\Gateway;
function game_send_cards($client_id,$cards)
{
    if($client_id==11)
        return;
    $message = new \Proto\SC_Init_Cards();
    $message->setCards($cards);
    Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Init_Cards_Id,$message->serializeToString()));
}
function game_send_cards_by_uid($uid,$cards)
{
    $message = new \Proto\SC_Init_Cards();
    $message->setCards($cards);
    Gateway::sendToUid($uid,my_pack(\Proto\Message_Id::SC_Init_Cards_Id,$message->serializeToString()));
}
function game_send_room_init($init,$roomId,$client_id=null)
{
    if($client_id==11)
        return;
    $message = new \Proto\SC_Init_Room();
    $message->setType($init['type']);
    $message->setBottomCards($init['bottomCards']);

    $message->setCurrentValueOwner($init['currentValueOwner']);
    $message->setDizhu($init['dizhu']);
    $message->setGameStartTime($init['gameStartTime']);
    $message->setTimes($init['times']);
    $message->setTurnerId($init['turnerId']);
    $message->setTurnerLeftTime($init['turnerLeftTime']);
    $play_data = new \Proto\Play_Data();
    $play_data->setType($init['currentValue']['type']);
    $play_data->setData($init['currentValue']['data']);
    $message->setCurrentValue($play_data);
    $play_order = new \Proto\Player_Order();
    foreach ($init['playerIds'] as $playerId)
    {
        $play_order->appendId($playerId);
    }
    $message->setPlayerOrder($play_order);
    foreach ($init['playerInfo'] as $playerId=>$item)
    {
        $player_Info = new \Proto\Player_Info();
        $player_Info->setPlayerId($playerId);
        $player_Info->setName($item['name']);
        $player_Info->setTouxiang($item['touxiang']);
        $player_Info->setCardsCount($item['cardsCount']);
        $player_Info->setLevel($item['level']);
        $player_Info->setGold($item['gold']);
        $message->appendPlayersInfo($player_Info);
    }
    if($client_id!=null)
    {
        Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Init_Room_Id,$message->serializeToString()));
        return;
    }
    Gateway::sendToGroup($roomId,my_pack(\Proto\Message_Id::SC_Init_Room_Id,$message->serializeToString()));
}
function game_send_join($client_id,$type)
{
    if($client_id==11)
        return;
    $message = new \Proto\SC_Join();
    $message->setType($type);
    Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Join_Id,$message->serializeToString()));
}
function game_send_play($roomId,$playerId,$type,$data)
{

    $message = new \Proto\SC_Play();
    $message->setPlayerId($playerId);
    $play_data= new \Proto\Play_Data();
    $play_data->setType($type);
    $play_data->setData($data);
    $message->setPlayData($play_data);
    Gateway::sendToGroup($roomId,my_pack(\Proto\Message_Id::SC_Play_Id,$message->serializeToString()));
}
function game_send_bottom_cards($roomId,$cards,$dizhu)
{
    $message = new \Proto\SC_Bottom_Cards();
    $message->setCards($cards);
    $message->setOwner($dizhu);
    Gateway::sendToGroup($roomId,my_pack(\Proto\Message_Id::SC_Bottom_Cards_Id,$message->serializeToString()));
}
function game_send_game_result($roomId,$result)
{
    $message = new \Proto\SC_Game_Result();
    foreach ($result as $playerId =>$item)
    {
        $player_game_result = new \Proto\Player_Game_Result();
        $player_game_result->setPlayerId($playerId);
        $player_game_result->setGold($item['gold']);
        $player_game_result->setLevelUp($item['level']);
        $player_game_result->setUnPlayCards($item['cardsLeft']);
        $message->appendPlayerGameResult($player_game_result);
    }
    Gateway::sendToGroup($roomId,my_pack(\Proto\Message_Id::SC_Game_Result_Id,$message->serializeToString()));
}
function game_send_quit_join($client_id,$type)
{
    $message = new \Proto\SC_Quit_Join();
    $message->setType($type);
    Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Quit_Join_Id,$message->serializeToString()));
}
function game_send_go_out($client_id,$type)
{
    $message = new \Proto\SC_Go_Out();
    $message->setType($type);
    Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Go_Out_Id,$message->serializeToString()));
}
function game_send_is_gaming($client_id,$is_gaming)
{
    $message = new \Proto\SC_Is_Gaming();
    $message->setData($is_gaming);
    Gateway::sendToClient($client_id,my_pack(\Proto\Message_Id::SC_Is_Gaming_Id,$message->serializeToString()));
}
function game_send_turn($turnId)
{
    $message = new \Proto\SC_Turn();
    Gateway::sendToUid($turnId,my_pack(\Proto\Message_Id::SC_Turn_Id,$message->serializeToString()));
}