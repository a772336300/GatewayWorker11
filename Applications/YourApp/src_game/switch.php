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
                //room_manager::singleton()->
            }
    }
}