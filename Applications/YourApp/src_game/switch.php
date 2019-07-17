<?php
use Proto\Message_Id;
function switch_game($client_id,$mid,$data)
{
    switch ($mid)
    {
        case Message_Id::CS_Join_Id:
            {
                $join = new \Proto\CS_Join();
                $join->setType(\Proto\Room_Type::gaoji);
                game_join(11,$join);
                game_join(11,$join);
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
                $play= new \Proto\CS_Play();
                $play->parseFromString($data);
                game_play($client_id,$play);
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
                room_manager::singleton()->competition_sign_up($Competition);
                break;
            }
        case Message_Id::CS_ComPetition_Group_Id:
            {
                $collname='gmae_competition';
                $mongodb=mongo_db::singleton('func_system');
                $filter = [
                    'starttime'  => ['$gt' => date('Y-m-d H:i:s')] //条件：大于当前时间
                ];
                $queryWriteOps = [
                    'projection'    => ['_id'   =>0],//不输出_id字段
                    'sort'          => ['id'    =>1]//根据id字段排序 1是升序，-1是降序
                ];
                $rs = $mongodb->query($collname,$filter,$queryWriteOps);
            }
    }
}