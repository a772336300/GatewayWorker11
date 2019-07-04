<?php
/**
 * Auto generated from doudizhu.proto at 2019-06-17 11:27:37
 *
 * proto package
 */

namespace Proto {
/**
 * Player_Game_Result message
 */
class Player_Game_Result extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const LEVELUP = 2;
    const GOLD = 3;
    const UNPLAYCARDS = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerId',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP => array(
            'name' => 'levelUp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UNPLAYCARDS => array(
            'name' => 'unPlayCards',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::LEVELUP] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::UNPLAYCARDS] = null;
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
     * Sets value of 'levelUp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelUp($value)
    {
        return $this->set(self::LEVELUP, $value);
    }

    /**
     * Returns value of 'levelUp' property
     *
     * @return integer
     */
    public function getLevelUp()
    {
        $value = $this->get(self::LEVELUP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'levelUp' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLevelUp()
    {
        return $this->get(self::LEVELUP) !== null;
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
     * Sets value of 'unPlayCards' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUnPlayCards($value)
    {
        return $this->set(self::UNPLAYCARDS, $value);
    }

    /**
     * Returns value of 'unPlayCards' property
     *
     * @return string
     */
    public function getUnPlayCards()
    {
        $value = $this->get(self::UNPLAYCARDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'unPlayCards' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUnPlayCards()
    {
        return $this->get(self::UNPLAYCARDS) !== null;
    }
}
}