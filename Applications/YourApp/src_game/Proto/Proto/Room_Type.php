<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-12 16:58:27
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
    const bisai_dizhu = 4;
    const bisai_majiang = 5;
    const player_bisai_dizhu = 6;
    const player_bisai_majiang = 7;

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
            'bisai_dizhu' => self::bisai_dizhu,
            'bisai_majiang' => self::bisai_majiang,
            'player_bisai_dizhu' => self::player_bisai_dizhu,
            'player_bisai_majiang' => self::player_bisai_majiang,
        );
    }
}
}