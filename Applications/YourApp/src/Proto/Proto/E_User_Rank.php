<?php
/**
 * Auto generated from new.proto at 2019-07-15 14:47:40
 *
 * proto package
 */

namespace Proto {
/**
 * E_User_Rank message
 */
class E_User_Rank extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const TOUXIANG = 2;
    const NAME = 3;
    const WIN_NUM = 4;
    const RANK = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TOUXIANG => array(
            'name' => 'touxiang',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::WIN_NUM => array(
            'name' => 'win_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RANK => array(
            'name' => 'rank',
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
        $this->values[self::TOUXIANG] = null;
        $this->values[self::NAME] = null;
        $this->values[self::WIN_NUM] = null;
        $this->values[self::RANK] = null;
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
     * Sets value of 'win_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWinNum($value)
    {
        return $this->set(self::WIN_NUM, $value);
    }

    /**
     * Returns value of 'win_num' property
     *
     * @return integer
     */
    public function getWinNum()
    {
        $value = $this->get(self::WIN_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'win_num' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasWinNum()
    {
        return $this->get(self::WIN_NUM) !== null;
    }

    /**
     * Sets value of 'rank' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRank($value)
    {
        return $this->set(self::RANK, $value);
    }

    /**
     * Returns value of 'rank' property
     *
     * @return integer
     */
    public function getRank()
    {
        $value = $this->get(self::RANK);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'rank' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRank()
    {
        return $this->get(self::RANK) !== null;
    }
}
}