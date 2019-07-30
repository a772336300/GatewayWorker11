<?php
/**
 * Auto generated from new.proto at 2019-07-30 16:58:53
 *
 * proto package
 */

namespace Proto {
/**
 * E_User_Packet message
 */
class E_User_Packet extends \ProtobufMessage
{
    /* Field index constants */
    const _ID = 1;
    const PROP_ID = 2;
    const NAME = 3;
    const DES = 4;
    const IMG = 5;
    const ACTIVE_ID = 6;
    const PROP_TYPE = 7;
    const USE_TYPE = 8;
    const DETAIL = 9;
    const ACTIVE_TIME = 10;
    const NUM = 11;
    const OVER_TIME = 12;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::_ID => array(
            'name' => '_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PROP_ID => array(
            'name' => 'prop_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DES => array(
            'name' => 'des',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMG => array(
            'name' => 'img',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ACTIVE_ID => array(
            'name' => 'active_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PROP_TYPE => array(
            'name' => 'prop_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::USE_TYPE => array(
            'name' => 'use_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DETAIL => array(
            'name' => 'detail',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ACTIVE_TIME => array(
            'name' => 'active_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NUM => array(
            'name' => 'num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OVER_TIME => array(
            'name' => 'over_time',
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
        $this->values[self::_ID] = null;
        $this->values[self::PROP_ID] = null;
        $this->values[self::NAME] = null;
        $this->values[self::DES] = null;
        $this->values[self::IMG] = null;
        $this->values[self::ACTIVE_ID] = null;
        $this->values[self::PROP_TYPE] = null;
        $this->values[self::USE_TYPE] = null;
        $this->values[self::DETAIL] = null;
        $this->values[self::ACTIVE_TIME] = null;
        $this->values[self::NUM] = null;
        $this->values[self::OVER_TIME] = null;
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
     * Sets value of '_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::_ID, $value);
    }

    /**
     * Returns value of '_id' property
     *
     * @return string
     */
    public function getId()
    {
        $value = $this->get(self::_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if '_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return $this->get(self::_ID) !== null;
    }

    /**
     * Sets value of 'prop_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPropId($value)
    {
        return $this->set(self::PROP_ID, $value);
    }

    /**
     * Returns value of 'prop_id' property
     *
     * @return string
     */
    public function getPropId()
    {
        $value = $this->get(self::PROP_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'prop_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPropId()
    {
        return $this->get(self::PROP_ID) !== null;
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
     * Sets value of 'des' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDes($value)
    {
        return $this->set(self::DES, $value);
    }

    /**
     * Returns value of 'des' property
     *
     * @return string
     */
    public function getDes()
    {
        $value = $this->get(self::DES);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'des' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDes()
    {
        return $this->get(self::DES) !== null;
    }

    /**
     * Sets value of 'img' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImg($value)
    {
        return $this->set(self::IMG, $value);
    }

    /**
     * Returns value of 'img' property
     *
     * @return string
     */
    public function getImg()
    {
        $value = $this->get(self::IMG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'img' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasImg()
    {
        return $this->get(self::IMG) !== null;
    }

    /**
     * Sets value of 'active_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setActiveId($value)
    {
        return $this->set(self::ACTIVE_ID, $value);
    }

    /**
     * Returns value of 'active_id' property
     *
     * @return string
     */
    public function getActiveId()
    {
        $value = $this->get(self::ACTIVE_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'active_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasActiveId()
    {
        return $this->get(self::ACTIVE_ID) !== null;
    }

    /**
     * Sets value of 'prop_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPropType($value)
    {
        return $this->set(self::PROP_TYPE, $value);
    }

    /**
     * Returns value of 'prop_type' property
     *
     * @return integer
     */
    public function getPropType()
    {
        $value = $this->get(self::PROP_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'prop_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPropType()
    {
        return $this->get(self::PROP_TYPE) !== null;
    }

    /**
     * Sets value of 'use_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUseType($value)
    {
        return $this->set(self::USE_TYPE, $value);
    }

    /**
     * Returns value of 'use_type' property
     *
     * @return integer
     */
    public function getUseType()
    {
        $value = $this->get(self::USE_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'use_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUseType()
    {
        return $this->get(self::USE_TYPE) !== null;
    }

    /**
     * Sets value of 'detail' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDetail($value)
    {
        return $this->set(self::DETAIL, $value);
    }

    /**
     * Returns value of 'detail' property
     *
     * @return string
     */
    public function getDetail()
    {
        $value = $this->get(self::DETAIL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'detail' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDetail()
    {
        return $this->get(self::DETAIL) !== null;
    }

    /**
     * Sets value of 'active_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setActiveTime($value)
    {
        return $this->set(self::ACTIVE_TIME, $value);
    }

    /**
     * Returns value of 'active_time' property
     *
     * @return integer
     */
    public function getActiveTime()
    {
        $value = $this->get(self::ACTIVE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'active_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasActiveTime()
    {
        return $this->get(self::ACTIVE_TIME) !== null;
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
     * Sets value of 'over_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOverTime($value)
    {
        return $this->set(self::OVER_TIME, $value);
    }

    /**
     * Returns value of 'over_time' property
     *
     * @return integer
     */
    public function getOverTime()
    {
        $value = $this->get(self::OVER_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'over_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOverTime()
    {
        return $this->get(self::OVER_TIME) !== null;
    }
}
}