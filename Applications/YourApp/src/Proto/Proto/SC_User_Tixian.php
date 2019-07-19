<?php
/**
 * Auto generated from new.proto at 2019-07-19 16:12:54
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Tixian message
 */
class SC_User_Tixian extends \ProtobufMessage
{
    /* Field index constants */
    const USERID = 1;
    const VARIABLE = 2;
    const UTYPE = 3;

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
        self::UTYPE => array(
            'name' => 'utype',
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
        $this->values[self::USERID] = null;
        $this->values[self::VARIABLE] = null;
        $this->values[self::UTYPE] = null;
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
     * Sets value of 'utype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUtype($value)
    {
        return $this->set(self::UTYPE, $value);
    }

    /**
     * Returns value of 'utype' property
     *
     * @return integer
     */
    public function getUtype()
    {
        $value = $this->get(self::UTYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'utype' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUtype()
    {
        return $this->get(self::UTYPE) !== null;
    }
}
}