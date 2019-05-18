<?php
/**
 * Auto generated from new.proto at 2019-05-18 13:34:49
 *
 * proto package
 */

namespace Proto {
/**
 * E_TASK_MODE enum
 */
final class E_TASK_MODE
{
    const TASK_MODE_NONE = 0;
    const TASK_MODE_1 = 1;
    const TASK_MODE_2 = 2;
    const TASK_MODE_3 = 3;
    const TASK_MODE_4 = 4;
    const TASK_MODE_5 = 5;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'TASK_MODE_NONE' => self::TASK_MODE_NONE,
            'TASK_MODE_1' => self::TASK_MODE_1,
            'TASK_MODE_2' => self::TASK_MODE_2,
            'TASK_MODE_3' => self::TASK_MODE_3,
            'TASK_MODE_4' => self::TASK_MODE_4,
            'TASK_MODE_5' => self::TASK_MODE_5,
        );
    }
}
}