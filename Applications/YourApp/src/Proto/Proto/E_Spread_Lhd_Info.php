<?php
/**
 * Auto generated from new.proto at 2019-09-10 14:38:59
 *
 * proto package
 */

namespace Proto {
/**
 * E_Spread_Lhd_Info message
 */
class E_Spread_Lhd_Info extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const NAME = 2;
    const NUM = 3;
    const BIND_TIME = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NUM => array(
            'name' => 'num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BIND_TIME => array(
            'name' => 'bind_time',
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
        $this->values[self::UID] = null;
        $this->values[self::NAME] = null;
        $this->values[self::NUM] = null;
        $this->values[self::BIND_TIME] = null;
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
     * Sets value of 'uid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUid($value)
    {
        return $this->set(self::UID, $value);
    }

    /**
     * Returns value of 'uid' property
     *
     * @return integer
     */
    public function getUid()
    {
        $value = $this->get(self::UID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'uid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUid()
    {
        return $this->get(self::UID) !== null;
    }

    /**
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasName()
    {
        return $this->get(self::NAME) !== null;
    }

    /**
     * Sets value of 'num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNum($value)
    {
        return $this->set(self::NUM, $value);
    }

    /**
     * Returns value of 'num' property
     *
     * @return integer
     */
    public function getNum()
    {
        $value = $this->get(self::NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'num' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasNum()
    {
        return $this->get(self::NUM) !== null;
    }

    /**
     * Sets value of 'bind_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBindTime($value)
    {
        return $this->set(self::BIND_TIME, $value);
    }

    /**
     * Returns value of 'bind_time' property
     *
     * @return string
     */
    public function getBindTime()
    {
        $value = $this->get(self::BIND_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'bind_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBindTime()
    {
        return $this->get(self::BIND_TIME) !== null;
    }
}
}