<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-15 14:34:24
 *
 * proto package
 */

namespace Proto {
/**
 * Room_Type enum
 */
final class Room_Type
{
    const chuji = 1;
    const zhongji = 2;
    const gaoji = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'chuji' => self::chuji,
            'zhongji' => self::zhongji,
            'gaoji' => self::gaoji,
        );
    }
}
}