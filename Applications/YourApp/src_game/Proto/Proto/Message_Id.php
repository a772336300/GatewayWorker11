<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-05 15:09:44
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
        );
    }
}
}