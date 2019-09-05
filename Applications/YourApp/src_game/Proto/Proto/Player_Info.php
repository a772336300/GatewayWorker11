<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-05 16:14:51
 *
 * proto package
 */

namespace Proto {
/**
 * Player_Info message
 */
class Player_Info extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const NAME = 2;
    const TOUXIANG = 3;
    const GOLD = 4;
    const LEVEL = 5;
    const CARDS_COUNT = 6;
    const TUO_GUAN = 7;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerId',
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
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVEL => array(
            'name' => 'level',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CARDS_COUNT => array(
            'name' => 'Cards_count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TUO_GUAN => array(
            'name' => 'tuo_guan',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::NAME] = null;
        $this->values[self::TOUXIANG] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::LEVEL] = null;
        $this->values[self::CARDS_COUNT] = null;
        $this->values[self::TUO_GUAN] = null;
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
     * Sets value of 'playerId' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerId($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerId' property
     *
     * @return integer
     */
    public function getPlayerId()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'playerId' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerId()
    {
        return $this->get(self::PLAYERID) !== null;
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
     * Sets value of 'gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGold($value)
    {
        return $this->set(self::GOLD, $value);
    }

    /**
     * Returns value of 'gold' property
     *
     * @return integer
     */
    public function getGold()
    {
        $value = $this->get(self::GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gold' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGold()
    {
        return $this->get(self::GOLD) !== null;
    }

    /**
     * Sets value of 'level' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevel($value)
    {
        return $this->set(self::LEVEL, $value);
    }

    /**
     * Returns value of 'level' property
     *
     * @return integer
     */
    public function getLevel()
    {
        $value = $this->get(self::LEVEL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'level' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLevel()
    {
        return $this->get(self::LEVEL) !== null;
    }

    /**
     * Sets value of 'Cards_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCardsCount($value)
    {
        return $this->set(self::CARDS_COUNT, $value);
    }

    /**
     * Returns value of 'Cards_count' property
     *
     * @return integer
     */
    public function getCardsCount()
    {
        $value = $this->get(self::CARDS_COUNT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Cards_count' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCardsCount()
    {
        return $this->get(self::CARDS_COUNT) !== null;
    }

    /**
     * Sets value of 'tuo_guan' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setTuoGuan($value)
    {
        return $this->set(self::TUO_GUAN, $value);
    }

    /**
     * Returns value of 'tuo_guan' property
     *
     * @return boolean
     */
    public function getTuoGuan()
    {
        $value = $this->get(self::TUO_GUAN);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'tuo_guan' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTuoGuan()
    {
        return $this->get(self::TUO_GUAN) !== null;
    }
}
}