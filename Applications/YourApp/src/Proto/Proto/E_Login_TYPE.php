<?php
/**
 * Auto generated from new.proto at 2019-05-27 11:47:10
 *
 * proto package
 */

namespace Proto {
/**
 * E_Login_TYPE enum
 */
final class E_Login_TYPE
{
    const Login_none = 0;
    const Login_fast = 1;
    const Login_phone = 2;
    const Login_wx = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Login_none' => self::Login_none,
            'Login_fast' => self::Login_fast,
            'Login_phone' => self::Login_phone,
            'Login_wx' => self::Login_wx,
        );
    }
}
}