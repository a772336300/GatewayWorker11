<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 16:57:37
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
    const LIANSHENG = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerId',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP => array(
            'name' => 'levelUp',
            'repeated' => true,
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
        self::LIANSHENG => array(
            'name' => 'lianSheng',
            'required' => false,
            'type' => '\Proto\Player_Game_Result_Lian_Sheng'
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
        $this->values[self::LEVELUP] = array();
        $this->values[self::GOLD] = null;
        $this->values[self::UNPLAYCARDS] = null;
        $this->values[self::LIANSHENG] = null;
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
     * Appends value to 'levelUp' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendLevelUp($value)
    {
        return $this->append(self::LEVELUP, $value);
    }

    /**
     * Clears 'levelUp' list
     *
     * @return null
     */
    public function clearLevelUp()
    {
        return $this->clear(self::LEVELUP);
    }

    /**
     * Returns 'levelUp' list
     *
     * @return integer[]
     */
    public function getLevelUp()
    {
        return $this->get(self::LEVELUP);
    }

    /**
     * Returns true if 'levelUp' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLevelUp()
    {
        return count($this->get(self::LEVELUP)) !== 0;
    }

    /**
     * Returns 'levelUp' iterator
     *
     * @return \ArrayIterator
     */
    public function getLevelUpIterator()
    {
        return new \ArrayIterator($this->get(self::LEVELUP));
    }

    /**
     * Returns element from 'levelUp' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getLevelUpAt($offset)
    {
        return $this->get(self::LEVELUP, $offset);
    }

    /**
     * Returns count of 'levelUp' list
     *
     * @return int
     */
    public function getLevelUpCount()
    {
        return $this->count(self::LEVELUP);
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

    /**
     * Sets value of 'lianSheng' property
     *
     * @param \Proto\Player_Game_Result_Lian_Sheng $value Property value
     *
     * @return null
     */
    public function setLianSheng(\Proto\Player_Game_Result_Lian_Sheng $value=null)
    {
        return $this->set(self::LIANSHENG, $value);
    }

    /**
     * Returns value of 'lianSheng' property
     *
     * @return \Proto\Player_Game_Result_Lian_Sheng
     */
    public function getLianSheng()
    {
        return $this->get(self::LIANSHENG);
    }

    /**
     * Returns true if 'lianSheng' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLianSheng()
    {
        return $this->get(self::LIANSHENG) !== null;
    }
}
}