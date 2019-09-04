<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 16:57:37
 *
 * proto package
 */

namespace Proto {
/**
 * Competition_end message embedded in SC_Competition_Result message
 */
class SC_Competition_Result_Competition_end extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const LEVELUP = 2;
    const TO_UP = 3;
    const GOLDS = 4;

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
        self::TO_UP => array(
            'name' => 'to_up',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::GOLDS => array(
            'name' => 'golds',
            'repeated' => true,
            'type' => '\Proto\SC_Competition_Result_Competition_end_gold'
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
        $this->values[self::TO_UP] = null;
        $this->values[self::GOLDS] = array();
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
     * Sets value of 'to_up' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setToUp($value)
    {
        return $this->set(self::TO_UP, $value);
    }

    /**
     * Returns value of 'to_up' property
     *
     * @return boolean
     */
    public function getToUp()
    {
        $value = $this->get(self::TO_UP);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'to_up' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasToUp()
    {
        return $this->get(self::TO_UP) !== null;
    }

    /**
     * Appends value to 'golds' list
     *
     * @param \Proto\SC_Competition_Result_Competition_end_gold $value Value to append
     *
     * @return null
     */
    public function appendGolds(\Proto\SC_Competition_Result_Competition_end_gold $value)
    {
        return $this->append(self::GOLDS, $value);
    }

    /**
     * Clears 'golds' list
     *
     * @return null
     */
    public function clearGolds()
    {
        return $this->clear(self::GOLDS);
    }

    /**
     * Returns 'golds' list
     *
     * @return \Proto\SC_Competition_Result_Competition_end_gold[]
     */
    public function getGolds()
    {
        return $this->get(self::GOLDS);
    }

    /**
     * Returns true if 'golds' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGolds()
    {
        return count($this->get(self::GOLDS)) !== 0;
    }

    /**
     * Returns 'golds' iterator
     *
     * @return \ArrayIterator
     */
    public function getGoldsIterator()
    {
        return new \ArrayIterator($this->get(self::GOLDS));
    }

    /**
     * Returns element from 'golds' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\SC_Competition_Result_Competition_end_gold
     */
    public function getGoldsAt($offset)
    {
        return $this->get(self::GOLDS, $offset);
    }

    /**
     * Returns count of 'golds' list
     *
     * @return int
     */
    public function getGoldsCount()
    {
        return $this->count(self::GOLDS);
    }
}
}