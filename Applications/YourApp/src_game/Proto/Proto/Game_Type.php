<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-09 15:05:50
 *
 * proto package
 */

namespace Proto {
/**
 * Game_Type enum
 */
final class Game_Type
{
    const jinji = 1;
    const jifen = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'jinji' => self::jinji,
            'jifen' => self::jifen,
        );
    }
}
}