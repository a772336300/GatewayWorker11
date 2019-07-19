<?php
/**
 * Auto generated from new.proto at 2019-07-19 16:12:54
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Info_Back message
 */
class SC_User_Info_Back extends \ProtobufMessage
{
    /* Field index constants */
    const E_USER_INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::E_USER_INFO => array(
            'name' => 'e_user_info',
            'required' => false,
            'type' => '\Proto\E_User_Info'
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::E_USER_INFO] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'e_user_info' property
     *
     * @param \Proto\E_User_Info $value Property value
     *
     * @return null
     */
    public function setEUserInfo(\Proto\E_User_Info $value=null)
    {
        return $this->set(self::E_USER_INFO, $value);
    }

    /**
     * Returns value of 'e_user_info' property
     *
     * @return \Proto\E_User_Info
     */
    public function getEUserInfo()
    {
        return $this->get(self::E_USER_INFO);
    }

    /**
     * Returns true if 'e_user_info' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEUserInfo()
    {
        return $this->get(self::E_USER_INFO) !== null;
    }
}
}