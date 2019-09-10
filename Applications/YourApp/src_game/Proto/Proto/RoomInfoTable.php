<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-10 14:02:15
 *
 * proto package
 */

namespace Proto {
/**
 * RoomInfoTable message
 */
class RoomInfoTable extends \ProtobufMessage
{
    /* Field index constants */
    const ROOMID = 1;
    const GAMETEXT = 2;
    const NAMETEXT = 3;
    const TYPETEXT = 4;
    const PLAYERNUM = 5;
    const SIGNUPTIME = 6;
    const BEGINNINGTIME = 7;
    const GAMESTATE = 8;
    const PLAYERMAX = 9;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ROOMID => array(
            'name' => 'roomId',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GAMETEXT => array(
            'name' => 'gameText',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NAMETEXT => array(
            'name' => 'nameText',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TYPETEXT => array(
            'name' => 'typeText',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PLAYERNUM => array(
            'name' => 'playerNum',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SIGNUPTIME => array(
            'name' => 'signUpTime',
            'required' => false,
            'type' => '\Proto\TimeInfo'
        ),
        self::BEGINNINGTIME => array(
            'name' => 'beginningTime',
            'required' => false,
            'type' => '\Proto\TimeInfo'
        ),
        self::GAMESTATE => array(
            'name' => 'gameState',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PLAYERMAX => array(
            'name' => 'playerMax',
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
        $this->values[self::ROOMID] = null;
        $this->values[self::GAMETEXT] = null;
        $this->values[self::NAMETEXT] = null;
        $this->values[self::TYPETEXT] = null;
        $this->values[self::PLAYERNUM] = null;
        $this->values[self::SIGNUPTIME] = null;
        $this->values[self::BEGINNINGTIME] = null;
        $this->values[self::GAMESTATE] = null;
        $this->values[self::PLAYERMAX] = null;
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
     * Sets value of 'roomId' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRoomId($value)
    {
        return $this->set(self::ROOMID, $value);
    }

    /**
     * Returns value of 'roomId' property
     *
     * @return string
     */
    public function getRoomId()
    {
        $value = $this->get(self::ROOMID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'roomId' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRoomId()
    {
        return $this->get(self::ROOMID) !== null;
    }

    /**
     * Sets value of 'gameText' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGameText($value)
    {
        return $this->set(self::GAMETEXT, $value);
    }

    /**
     * Returns value of 'gameText' property
     *
     * @return string
     */
    public function getGameText()
    {
        $value = $this->get(self::GAMETEXT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'gameText' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameText()
    {
        return $this->get(self::GAMETEXT) !== null;
    }

    /**
     * Sets value of 'nameText' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setNameText($value)
    {
        return $this->set(self::NAMETEXT, $value);
    }

    /**
     * Returns value of 'nameText' property
     *
     * @return string
     */
    public function getNameText()
    {
        $value = $this->get(self::NAMETEXT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'nameText' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasNameText()
    {
        return $this->get(self::NAMETEXT) !== null;
    }

    /**
     * Sets value of 'typeText' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTypeText($value)
    {
        return $this->set(self::TYPETEXT, $value);
    }

    /**
     * Returns value of 'typeText' property
     *
     * @return string
     */
    public function getTypeText()
    {
        $value = $this->get(self::TYPETEXT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'typeText' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTypeText()
    {
        return $this->get(self::TYPETEXT) !== null;
    }

    /**
     * Sets value of 'playerNum' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerNum($value)
    {
        return $this->set(self::PLAYERNUM, $value);
    }

    /**
     * Returns value of 'playerNum' property
     *
     * @return integer
     */
    public function getPlayerNum()
    {
        $value = $this->get(self::PLAYERNUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'playerNum' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerNum()
    {
        return $this->get(self::PLAYERNUM) !== null;
    }

    /**
     * Sets value of 'signUpTime' property
     *
     * @param \Proto\TimeInfo $value Property value
     *
     * @return null
     */
    public function setSignUpTime(\Proto\TimeInfo $value=null)
    {
        return $this->set(self::SIGNUPTIME, $value);
    }

    /**
     * Returns value of 'signUpTime' property
     *
     * @return \Proto\TimeInfo
     */
    public function getSignUpTime()
    {
        return $this->get(self::SIGNUPTIME);
    }

    /**
     * Returns true if 'signUpTime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSignUpTime()
    {
        return $this->get(self::SIGNUPTIME) !== null;
    }

    /**
     * Sets value of 'beginningTime' property
     *
     * @param \Proto\TimeInfo $value Property value
     *
     * @return null
     */
    public function setBeginningTime(\Proto\TimeInfo $value=null)
    {
        return $this->set(self::BEGINNINGTIME, $value);
    }

    /**
     * Returns value of 'beginningTime' property
     *
     * @return \Proto\TimeInfo
     */
    public function getBeginningTime()
    {
        return $this->get(self::BEGINNINGTIME);
    }

    /**
     * Returns true if 'beginningTime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBeginningTime()
    {
        return $this->get(self::BEGINNINGTIME) !== null;
    }

    /**
     * Sets value of 'gameState' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGameState($value)
    {
        return $this->set(self::GAMESTATE, $value);
    }

    /**
     * Returns value of 'gameState' property
     *
     * @return string
     */
    public function getGameState()
    {
        $value = $this->get(self::GAMESTATE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'gameState' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameState()
    {
        return $this->get(self::GAMESTATE) !== null;
    }

    /**
     * Sets value of 'playerMax' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerMax($value)
    {
        return $this->set(self::PLAYERMAX, $value);
    }

    /**
     * Returns value of 'playerMax' property
     *
     * @return integer
     */
    public function getPlayerMax()
    {
        $value = $this->get(self::PLAYERMAX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'playerMax' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerMax()
    {
        return $this->get(self::PLAYERMAX) !== null;
    }
}
}