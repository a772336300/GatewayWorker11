<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * E_Spread_Info message
 */
class E_Spread_Info extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const NAME = 2;
    const TOUXIANG = 3;
    const BIND_TIME = 4;
    const STATE = 5;
    const VICTORY_NUM = 6;

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
        self::TOUXIANG => array(
            'name' => 'touxiang',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BIND_TIME => array(
            'name' => 'bind_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::STATE => array(
            'name' => 'state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VICTORY_NUM => array(
            'name' => 'victory_num',
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
        $this->values[self::UID] = null;
        $this->values[self::NAME] = null;
        $this->values[self::TOUXIANG] = null;
        $this->values[self::BIND_TIME] = null;
        $this->values[self::STATE] = null;
        $this->values[self::VICTORY_NUM] = null;
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
     * Sets value of 'touxiang' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTouxiang($value)
    {
        return $this->set(self::TOUXIANG, $value);
    }

    /**
     * Returns value of 'touxiang' property
     *
     * @return string
     */
    public function getTouxiang()
    {
        $value = $this->get(self::TOUXIANG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'touxiang' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTouxiang()
    {
        return $this->get(self::TOUXIANG) !== null;
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

    /**
     * Sets value of 'state' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setState($value)
    {
        return $this->set(self::STATE, $value);
    }

    /**
     * Returns value of 'state' property
     *
     * @return integer
     */
    public function getState()
    {
        $value = $this->get(self::STATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'state' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasState()
    {
        return $this->get(self::STATE) !== null;
    }

    /**
     * Sets value of 'victory_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVictoryNum($value)
    {
        return $this->set(self::VICTORY_NUM, $value);
    }

    /**
     * Returns value of 'victory_num' property
     *
     * @return integer
     */
    public function getVictoryNum()
    {
        $value = $this->get(self::VICTORY_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'victory_num' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasVictoryNum()
    {
        return $this->get(self::VICTORY_NUM) !== null;
    }
}
}