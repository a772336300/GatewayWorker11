<?php
/**
 * Auto generated from new.proto at 2019-06-27 14:48:10
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Back_Password message
 */
class SC_Back_Password extends \ProtobufMessage
{
    /* Field index constants */
    const PHONE = 1;
    const PASSWORD = 2;
    const IS_CREATE_USER = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PHONE => array(
            'name' => 'phone',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PASSWORD => array(
            'name' => 'password',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IS_CREATE_USER => array(
            'name' => 'is_create_user',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::PHONE] = null;
        $this->values[self::PASSWORD] = null;
        $this->values[self::IS_CREATE_USER] = null;
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
     * Sets value of 'phone' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhone($value)
    {
        return $this->set(self::PHONE, $value);
    }

    /**
     * Returns value of 'phone' property
     *
     * @return string
     */
    public function getPhone()
    {
        $value = $this->get(self::PHONE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'phone' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhone()
    {
        return $this->get(self::PHONE) !== null;
    }

    /**
     * Sets value of 'password' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPassword($value)
    {
        return $this->set(self::PASSWORD, $value);
    }

    /**
     * Returns value of 'password' property
     *
     * @return string
     */
    public function getPassword()
    {
        $value = $this->get(self::PASSWORD);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'password' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPassword()
    {
        return $this->get(self::PASSWORD) !== null;
    }

    /**
     * Sets value of 'is_create_user' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsCreateUser($value)
    {
        return $this->set(self::IS_CREATE_USER, $value);
    }

    /**
     * Returns value of 'is_create_user' property
     *
     * @return boolean
     */
    public function getIsCreateUser()
    {
        $value = $this->get(self::IS_CREATE_USER);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'is_create_user' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIsCreateUser()
    {
        return $this->get(self::IS_CREATE_USER) !== null;
    }
}
}