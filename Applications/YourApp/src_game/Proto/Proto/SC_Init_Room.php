<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-10 14:02:15
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Init_Room message
 */
class SC_Init_Room extends \ProtobufMessage
{
    /* Field index constants */
    const TYPE = 1;
    const TIMES = 2;
    const DIZHU = 3;
    const GAMESTARTTIME = 4;
    const CURRENTVALUE = 5;
    const BOTTOMCARDS = 6;
    const PLAYERORDER = 7;
    const TURNERID = 8;
    const TURNERLEFTTIME = 9;
    const CURRENTVALUEOWNER = 10;
    const PLAYERSINFO = 11;
    const HISTORYCARDS = 12;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TIMES => array(
            'name' => 'times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIZHU => array(
            'name' => 'dizhu',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAMESTARTTIME => array(
            'name' => 'gameStartTime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CURRENTVALUE => array(
            'name' => 'currentValue',
            'required' => false,
            'type' => '\Proto\Play_Data'
        ),
        self::BOTTOMCARDS => array(
            'name' => 'bottomCards',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PLAYERORDER => array(
            'name' => 'playerOrder',
            'required' => false,
            'type' => '\Proto\Player_Order'
        ),
        self::TURNERID => array(
            'name' => 'turnerId',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TURNERLEFTTIME => array(
            'name' => 'turnerLeftTime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CURRENTVALUEOWNER => array(
            'name' => 'currentValueOwner',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERSINFO => array(
            'name' => 'playersInfo',
            'repeated' => true,
            'type' => '\Proto\Player_Info'
        ),
        self::HISTORYCARDS => array(
            'name' => 'historyCards',
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
        $this->values[self::TYPE] = null;
        $this->values[self::TIMES] = null;
        $this->values[self::DIZHU] = null;
        $this->values[self::GAMESTARTTIME] = null;
        $this->values[self::CURRENTVALUE] = null;
        $this->values[self::BOTTOMCARDS] = null;
        $this->values[self::PLAYERORDER] = null;
        $this->values[self::TURNERID] = null;
        $this->values[self::TURNERLEFTTIME] = null;
        $this->values[self::CURRENTVALUEOWNER] = null;
        $this->values[self::PLAYERSINFO] = array();
        $this->values[self::HISTORYCARDS] = null;
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
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasType()
    {
        return $this->get(self::TYPE) !== null;
    }

    /**
     * Sets value of 'times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTimes($value)
    {
        return $this->set(self::TIMES, $value);
    }

    /**
     * Returns value of 'times' property
     *
     * @return integer
     */
    public function getTimes()
    {
        $value = $this->get(self::TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'times' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTimes()
    {
        return $this->get(self::TIMES) !== null;
    }

    /**
     * Sets value of 'dizhu' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDizhu($value)
    {
        return $this->set(self::DIZHU, $value);
    }

    /**
     * Returns value of 'dizhu' property
     *
     * @return integer
     */
    public function getDizhu()
    {
        $value = $this->get(self::DIZHU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'dizhu' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDizhu()
    {
        return $this->get(self::DIZHU) !== null;
    }

    /**
     * Sets value of 'gameStartTime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameStartTime($value)
    {
        return $this->set(self::GAMESTARTTIME, $value);
    }

    /**
     * Returns value of 'gameStartTime' property
     *
     * @return integer
     */
    public function getGameStartTime()
    {
        $value = $this->get(self::GAMESTARTTIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gameStartTime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameStartTime()
    {
        return $this->get(self::GAMESTARTTIME) !== null;
    }

    /**
     * Sets value of 'currentValue' property
     *
     * @param \Proto\Play_Data $value Property value
     *
     * @return null
     */
    public function setCurrentValue(\Proto\Play_Data $value=null)
    {
        return $this->set(self::CURRENTVALUE, $value);
    }

    /**
     * Returns value of 'currentValue' property
     *
     * @return \Proto\Play_Data
     */
    public function getCurrentValue()
    {
        return $this->get(self::CURRENTVALUE);
    }

    /**
     * Returns true if 'currentValue' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCurrentValue()
    {
        return $this->get(self::CURRENTVALUE) !== null;
    }

    /**
     * Sets value of 'bottomCards' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBottomCards($value)
    {
        return $this->set(self::BOTTOMCARDS, $value);
    }

    /**
     * Returns value of 'bottomCards' property
     *
     * @return string
     */
    public function getBottomCards()
    {
        $value = $this->get(self::BOTTOMCARDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'bottomCards' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBottomCards()
    {
        return $this->get(self::BOTTOMCARDS) !== null;
    }

    /**
     * Sets value of 'playerOrder' property
     *
     * @param \Proto\Player_Order $value Property value
     *
     * @return null
     */
    public function setPlayerOrder(\Proto\Player_Order $value=null)
    {
        return $this->set(self::PLAYERORDER, $value);
    }

    /**
     * Returns value of 'playerOrder' property
     *
     * @return \Proto\Player_Order
     */
    public function getPlayerOrder()
    {
        return $this->get(self::PLAYERORDER);
    }

    /**
     * Returns true if 'playerOrder' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerOrder()
    {
        return $this->get(self::PLAYERORDER) !== null;
    }

    /**
     * Sets value of 'turnerId' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTurnerId($value)
    {
        return $this->set(self::TURNERID, $value);
    }

    /**
     * Returns value of 'turnerId' property
     *
     * @return integer
     */
    public function getTurnerId()
    {
        $value = $this->get(self::TURNERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'turnerId' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTurnerId()
    {
        return $this->get(self::TURNERID) !== null;
    }

    /**
     * Sets value of 'turnerLeftTime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTurnerLeftTime($value)
    {
        return $this->set(self::TURNERLEFTTIME, $value);
    }

    /**
     * Returns value of 'turnerLeftTime' property
     *
     * @return integer
     */
    public function getTurnerLeftTime()
    {
        $value = $this->get(self::TURNERLEFTTIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'turnerLeftTime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTurnerLeftTime()
    {
        return $this->get(self::TURNERLEFTTIME) !== null;
    }

    /**
     * Sets value of 'currentValueOwner' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurrentValueOwner($value)
    {
        return $this->set(self::CURRENTVALUEOWNER, $value);
    }

    /**
     * Returns value of 'currentValueOwner' property
     *
     * @return integer
     */
    public function getCurrentValueOwner()
    {
        $value = $this->get(self::CURRENTVALUEOWNER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'currentValueOwner' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCurrentValueOwner()
    {
        return $this->get(self::CURRENTVALUEOWNER) !== null;
    }

    /**
     * Appends value to 'playersInfo' list
     *
     * @param \Proto\Player_Info $value Value to append
     *
     * @return null
     */
    public function appendPlayersInfo(\Proto\Player_Info $value)
    {
        return $this->append(self::PLAYERSINFO, $value);
    }

    /**
     * Clears 'playersInfo' list
     *
     * @return null
     */
    public function clearPlayersInfo()
    {
        return $this->clear(self::PLAYERSINFO);
    }

    /**
     * Returns 'playersInfo' list
     *
     * @return \Proto\Player_Info[]
     */
    public function getPlayersInfo()
    {
        return $this->get(self::PLAYERSINFO);
    }

    /**
     * Returns true if 'playersInfo' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayersInfo()
    {
        return count($this->get(self::PLAYERSINFO)) !== 0;
    }

    /**
     * Returns 'playersInfo' iterator
     *
     * @return \ArrayIterator
     */
    public function getPlayersInfoIterator()
    {
        return new \ArrayIterator($this->get(self::PLAYERSINFO));
    }

    /**
     * Returns element from 'playersInfo' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\Player_Info
     */
    public function getPlayersInfoAt($offset)
    {
        return $this->get(self::PLAYERSINFO, $offset);
    }

    /**
     * Returns count of 'playersInfo' list
     *
     * @return int
     */
    public function getPlayersInfoCount()
    {
        return $this->count(self::PLAYERSINFO);
    }

    /**
     * Sets value of 'historyCards' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setHistoryCards($value)
    {
        return $this->set(self::HISTORYCARDS, $value);
    }

    /**
     * Returns value of 'historyCards' property
     *
     * @return string
     */
    public function getHistoryCards()
    {
        $value = $this->get(self::HISTORYCARDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'historyCards' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasHistoryCards()
    {
        return $this->get(self::HISTORYCARDS) !== null;
    }
}
}