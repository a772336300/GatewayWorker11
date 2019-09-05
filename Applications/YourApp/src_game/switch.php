<?php

use Proto\CS_RoomDel;
use Proto\CS_RoomInfoTable;
use Proto\CS_RoomOut;
use Proto\Message_Id;
function switch_game($client_id,$mid,$data)
{
    switch ($mid)
    {
        case Message_Id::CS_Robot_Join_Id:
            {
                echo "\n机器人请求匹配\n";
//                //#test
//                global $redis;
//                global $cardModel;
//                $redis->flushAll();
//                foreach ($cardModel as $item)
//                    $redis->sAdd('cardsModel',$item);
                $join = new \Proto\CS_Robot_Join();
                $join->parseFromString($data);
                robot_join($client_id,$join->getPlayerId());
                break;
            }
        case Message_Id::CS_Join_Id:
            {

                $join = new \Proto\CS_Join();
                $join->parseFromString($data);
                game_join($client_id,$join);
                break;
            }
        case Message_Id::CS_Quit_Join_Id:
            {
                $quit_join = new \Proto\CS_Quit_Join();
                $quit_join->parseFromString($data);
                game_quit_join($client_id,$quit_join);
                break;
            }
        case Message_Id::CS_Play_Id:
            {
                $cs_play= new \Proto\CS_Play();
                $cs_play->parseFromString($data);
                $play=$cs_play->getPlayData();
                game_play($client_id,$play);
                break;
            }
        case Message_Id::CS_Tuo_Guan_Id:
            {
                $cs_tuo_guan = new \Proto\CS_Tuo_Guan();
                $cs_tuo_guan->parseFromString($data);
                gameTuoGuan($_SESSION['uid'],$cs_tuo_guan->getData());
                break;
            }
        case Message_Id::CS_Go_Out_Id:
            {
                $go_out= new \Proto\CS_Play();
                $go_out->parseFromString($data);
                game_go_out($client_id,$go_out);
                break;
            }
        case Message_Id::CS_Is_Gaming_Id:
            {
                game_is_gaming($client_id);
                break;
            }
        case Message_Id::CS_Competition_SignUp_Id:
            {
                $Competition = new \Proto\CS_ComPetition_SignUp();
                $Competition->parseFromString($data);
                /**
                 * 玩家报名
                 * @param $user_data =>[
                 *                      'competition_id'=>1,
                 *                      'uiser_id'=>1,
                 *                      'game_type'=>'ddz',
                 *                      ]
                 */
                room_manager::singleton()->competition_sign_up($Competition->getCompetitionId(),$Competition->getGameType(),$Competition->getUserId(),$client_id);
                //测试
                //测试
                //测试
                //room_manager::singleton()->competition_sign_up($Competition->getCompetitionId(),$Competition->getGameType(),10430458,$client_id);//98
                //room_manager::singleton()->competition_sign_up($Competition->getCompetitionId(),$Competition->getGameType(),10430420,$client_id);//99
                break;
            }
        case Message_Id::CS_ComPetition_Group_Id:
            {
                $collname='game_competition';
                $mongodb=mongo_db::singleton('func_system');
                $filter = [
                    'starttime'  => ['$gt' => date('Y-m-d H:i:s')] //条件：大于当前时间
                ];
                $queryWriteOps = [
                    'projection'    => ['_id'   =>0],//不输出_id字段
                    'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
                ];
                $rs = $mongodb->query($collname,$filter,$queryWriteOps);
                $GameCom = new \Proto\SC_ComPetition_Group();
                foreach ($rs as $data){
                    $tmp = new \Proto\ComPetition();
                    $tmp->setCompetitionId($data->id);
                    $tmp->setType($data->type);
                    $tmp->setStarttime($data->starttime);
                    $tmp->setNumber($data->number);
                    $GameCom->appendGroup($tmp);
                }
                \GatewayWorker\Lib\Gateway::sendToClient($client_id,my_pack(Message_Id::SC_ComPetition_Group_Id,$GameCom->serializeToString()));
                break;
            }
        case Message_Id::CS_ComPetition_Join_Id:
            {
                $com_join = new \Proto\CS_ComPetition_Join();
                $com_join->parseFromString($data);
                echo sprintf("CS_ComPetition_Join competitionid = %s playerid = %s\n",$com_join->getCompetitionId(),$com_join->getPlayerId());
                break;
            }
        case Message_Id::CS_CreateCardRoom_Id:
        {
            $createroom = new \Proto\CS_CreateCardRoom();
            $createroom->parseFromString($data);
            room_manager::singleton()->CreateCardRoom($client_id,$createroom);
            break;
        }
        case Message_Id::CS_JoinTheRoom_Id:
        {
            $jointheroom = new \Proto\CS_JoinTheRoom();
            $jointheroom->parseFromString($data);
            room_manager::singleton()->JoinTheRoom($client_id,$jointheroom->getPlayerid(),$jointheroom->getRoomId());
            break;
        }
        case Message_Id::CS_RoomInfoTable_Id:
        {
            $roominfotable = new CS_RoomInfoTable();
            $roominfotable->parseFromString($data);
            room_manager::singleton()->RoomInfoTable($client_id,$roominfotable->getPlayerid());
            break;
        }
        case Message_Id::CS_RoomDel_Id:
        {
            $delroom = new CS_RoomDel();
            $delroom->parseFromString($data);
            room_manager::singleton()->delRoom($client_id,$delroom->getPlayerid(),$delroom->getRoomId());
            break;
        }
        case Message_Id::CS_RoomOut_Id:
        {
            $outroom = new CS_RoomOut();
            $outroom->parseFromString($data);
            room_manager::singleton()->outRoom($client_id,$outroom->getPlayerid(),$outroom->getRoomId());
            break;
        }
    }
}