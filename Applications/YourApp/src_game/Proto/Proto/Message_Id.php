<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-02 17:19:41
 *
 * proto package
 */

namespace Proto {
/**
 * Message_Id enum
 */
final class Message_Id
{
    const CS_Join_Id = 1;
    const SC_Join_Id = 2;
    const CS_Quit_Join_Id = 3;
    const SC_Quit_Join_Id = 4;
    const SC_Init_Room_Id = 5;
    const SC_Init_Cards_Id = 6;
    const SC_Bottom_Cards_Id = 7;
    const CS_Play_Id = 8;
    const SC_Play_Id = 9;
    const CS_Go_Out_Id = 10;
    const SC_Go_Out_Id = 11;
    const CS_Is_Gaming_Id = 12;
    const SC_Is_Gaming_Id = 13;
    const SC_Game_Result_Id = 14;
    const CS_Competition_SignUp_Id = 15;
    const SC_Competition_SignUp_Id = 16;
    const SC_ComPetition_Start_Id = 17;
    const CS_ComPetition_Group_Id = 18;
    const SC_ComPetition_Group_Id = 19;
    const CS_Tuo_Guan_Id = 20;
    const SC_Tuo_Guan_Id = 21;
    const CS_Robot_Join_Id = 22;
    const SC_Competition_Result_Id = 23;
    const CS_ComPetition_Join_Id = 24;
    const CS_CreateCardRoom_Id = 25;
    const SC_CreateCardRoom_Id = 26;
    const SC_RoomInfoTable_Id = 27;
    const CS_JoinTheRoom_Id = 28;
    const SC_JoinTheRoom_Id = 29;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'CS_Join_Id' => self::CS_Join_Id,
            'SC_Join_Id' => self::SC_Join_Id,
            'CS_Quit_Join_Id' => self::CS_Quit_Join_Id,
            'SC_Quit_Join_Id' => self::SC_Quit_Join_Id,
            'SC_Init_Room_Id' => self::SC_Init_Room_Id,
            'SC_Init_Cards_Id' => self::SC_Init_Cards_Id,
            'SC_Bottom_Cards_Id' => self::SC_Bottom_Cards_Id,
            'CS_Play_Id' => self::CS_Play_Id,
            'SC_Play_Id' => self::SC_Play_Id,
            'CS_Go_Out_Id' => self::CS_Go_Out_Id,
            'SC_Go_Out_Id' => self::SC_Go_Out_Id,
            'CS_Is_Gaming_Id' => self::CS_Is_Gaming_Id,
            'SC_Is_Gaming_Id' => self::SC_Is_Gaming_Id,
            'SC_Game_Result_Id' => self::SC_Game_Result_Id,
            'CS_Competition_SignUp_Id' => self::CS_Competition_SignUp_Id,
            'SC_Competition_SignUp_Id' => self::SC_Competition_SignUp_Id,
            'SC_ComPetition_Start_Id' => self::SC_ComPetition_Start_Id,
            'CS_ComPetition_Group_Id' => self::CS_ComPetition_Group_Id,
            'SC_ComPetition_Group_Id' => self::SC_ComPetition_Group_Id,
            'CS_Tuo_Guan_Id' => self::CS_Tuo_Guan_Id,
            'SC_Tuo_Guan_Id' => self::SC_Tuo_Guan_Id,
            'CS_Robot_Join_Id' => self::CS_Robot_Join_Id,
            'SC_Competition_Result_Id' => self::SC_Competition_Result_Id,
            'CS_ComPetition_Join_Id' => self::CS_ComPetition_Join_Id,
            'CS_CreateCardRoom_Id' => self::CS_CreateCardRoom_Id,
            'SC_CreateCardRoom_Id' => self::SC_CreateCardRoom_Id,
            'SC_RoomInfoTable_Id' => self::SC_RoomInfoTable_Id,
            'CS_JoinTheRoom_Id' => self::CS_JoinTheRoom_Id,
            'SC_JoinTheRoom_Id' => self::SC_JoinTheRoom_Id,
        );
    }
}
}