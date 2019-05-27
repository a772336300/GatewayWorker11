<?php
/**
 * Auto generated from new.proto at 2019-05-27 11:47:10
 *
 * proto package
 */

namespace Proto {
/**
 * E_Equipment_TYPE enum
 */
final class E_Equipment_TYPE
{
    const Equipment_none = 0;
    const Equipment_IOS = 1;
    const Equipment_Android = 2;
    const Equipment_Ipad_IOS = 3;
    const Equipment_Ipad_Android = 4;
    const Equipment_PC = 5;
    const Equipment_NEW = 6;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Equipment_none' => self::Equipment_none,
            'Equipment_IOS' => self::Equipment_IOS,
            'Equipment_Android' => self::Equipment_Android,
            'Equipment_Ipad_IOS' => self::Equipment_Ipad_IOS,
            'Equipment_Ipad_Android' => self::Equipment_Ipad_Android,
            'Equipment_PC' => self::Equipment_PC,
            'Equipment_NEW' => self::Equipment_NEW,
        );
    }
}
}