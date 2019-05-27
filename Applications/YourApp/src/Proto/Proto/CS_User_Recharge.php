<?php
/**
 * Auto generated from new.proto at 2019-05-27 10:49:44
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Recharge message
 */
class CS_User_Recharge extends \ProtobufMessage
{
    /* Field index constants */
    const USERID = 1;
    const VARIABLE = 2;
    const CODE = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USERID => array(
            'name' => 'userid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VARIABLE => array(
            'name' => 'variable',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CODE => array(
            'name' => 'code',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::USERID] = null;
        $this->values[self::VARIABLE] = null;
        $this->values[self::CODE] = null;
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
     * Sets value of 'userid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUserid($value)
    {
        return $this->set(self::USERID, $value);
    }

    /**
     * Returns value of 'userid' property
     *
     * @return integer
     */
    public function getUserid()
    {
        $value = $this->get(self::USERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'userid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserid()
    {
        return $this->get(self::USERID) !== null;
    }

    /**
     * Sets value of 'variable' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVariable($value)
    {
        return $this->set(self::VARIABLE, $value);
    }

    /**
     * Returns value of 'variable' property
     *
     * @return integer
     */
    public function getVariable()
    {
        $value = $this->get(self::VARIABLE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'variable' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasVariable()
    {
        return $this->get(self::VARIABLE) !== null;
    }

    /**
     * Sets value of 'code' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCode($value)
    {
        return $this->set(self::CODE, $value);
    }

    /**
     * Returns value of 'code' property
     *
     * @return string
     */
    public function getCode()
    {
        $value = $this->get(self::CODE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'code' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCode()
    {
        return $this->get(self::CODE) !== null;
    }
}
}