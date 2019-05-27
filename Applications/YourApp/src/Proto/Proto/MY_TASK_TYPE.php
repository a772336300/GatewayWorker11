<?php
/**
 * Auto generated from task.proto at 2019-05-14 11:47:46
 *
 * proto package
 */

namespace Proto {
/**
 * MY_TASK_TYPE enum
 */
final class MY_TASK_TYPE
{
    const MY_INIT = 1;
    const MY_UPDARE = 2;
    const MY_REWARD = 3;
    const MY_NEW = 4;
    const MY_GET_OPENID = 5;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'MY_INIT' => self::MY_INIT,
            'MY_UPDARE' => self::MY_UPDARE,
            'MY_REWARD' => self::MY_REWARD,
            'MY_NEW' => self::MY_NEW,
            'MY_GET_OPENID' => self::MY_GET_OPENID,
        );
    }
}
}