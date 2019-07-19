<?php
/**
 * Auto generated from new.proto at 2019-07-19 16:12:54
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Client_Login message
 */
class CS_Client_Login extends \ProtobufMessage
{
    /* Field index constants */
    const PHONE = 1;
    const PASSWORD = 2;
    const EQUIPMENT = 3;
    const LOGIN_TYPE = 4;

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
        self::EQUIPMENT => array(
            'name' => 'equipment',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_TYPE => array(
            'name' => 'login_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        $this->values[self::EQUIPMENT] = null;
        $this->values[self::LOGIN_TYPE] = null;
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
     * Sets value of 'equipment' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEquipment($value)
    {
        return $this->set(self::EQUIPMENT, $value);
    }

    /**
     * Returns value of 'equipment' property
     *
     * @return integer
     */
    public function getEquipment()
    {
        $value = $this->get(self::EQUIPMENT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'equipment' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEquipment()
    {
        return $this->get(self::EQUIPMENT) !== null;
    }

    /**
     * Sets value of 'login_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLoginType($value)
    {
        return $this->set(self::LOGIN_TYPE, $value);
    }

    /**
     * Returns value of 'login_type' property
     *
     * @return integer
     */
    public function getLoginType()
    {
        $value = $this->get(self::LOGIN_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'login_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLoginType()
    {
        return $this->get(self::LOGIN_TYPE) !== null;
    }
}
}