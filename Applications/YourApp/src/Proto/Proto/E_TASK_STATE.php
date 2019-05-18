<?php
/**
 * Auto generated from new.proto at 2019-05-18 13:34:49
 *
 * proto package
 */

namespace Proto {
/**
 * E_TASK_STATE enum
 */
final class E_TASK_STATE
{
    const TASK_STATE_NONE = 0;
    const TASK_STATE_CAN_ACCEPT = 1;
    const TASK_STATE_IS_DOING = 2;
    const TASK_STATE_DONE = 3;
    const TASK_STATE_CANNOT_ACCEPT = 4;
    const TASK_STATE_REWARD = 5;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'TASK_STATE_NONE' => self::TASK_STATE_NONE,
            'TASK_STATE_CAN_ACCEPT' => self::TASK_STATE_CAN_ACCEPT,
            'TASK_STATE_IS_DOING' => self::TASK_STATE_IS_DOING,
            'TASK_STATE_DONE' => self::TASK_STATE_DONE,
            'TASK_STATE_CANNOT_ACCEPT' => self::TASK_STATE_CANNOT_ACCEPT,
            'TASK_STATE_REWARD' => self::TASK_STATE_REWARD,
        );
    }
}
}