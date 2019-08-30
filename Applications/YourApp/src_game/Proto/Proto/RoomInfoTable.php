<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-30 18:28:35
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
            'repeated' => true,
            'type' => '\Proto\TimeInfo'
        ),
        self::BEGINNINGTIME => array(
            'name' => 'beginningTime',
            'repeated' => true,
            'type' => '\Proto\TimeInfo'
        ),
        self::GAMESTATE => array(
            'name' => 'gameState',
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
        $this->values[self::ROOMID] = null;
        $this->values[self::GAMETEXT] = null;
        $this->values[self::NAMETEXT] = null;
        $this->values[self::TYPETEXT] = null;
        $this->values[self::PLAYERNUM] = null;
        $this->values[self::SIGNUPTIME] = array();
        $this->values[self::BEGINNINGTIME] = array();
        $this->values[self::GAMESTATE] = null;
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
     * Appends value to 'signUpTime' list
     *
     * @param \Proto\TimeInfo $value Value to append
     *
     * @return null
     */
    public function appendSignUpTime(\Proto\TimeInfo $value)
    {
        return $this->append(self::SIGNUPTIME, $value);
    }

    /**
     * Clears 'signUpTime' list
     *
     * @return null
     */
    public function clearSignUpTime()
    {
        return $this->clear(self::SIGNUPTIME);
    }

    /**
     * Returns 'signUpTime' list
     *
     * @return \Proto\TimeInfo[]
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
        return count($this->get(self::SIGNUPTIME)) !== 0;
    }

    /**
     * Returns 'signUpTime' iterator
     *
     * @return \ArrayIterator
     */
    public function getSignUpTimeIterator()
    {
        return new \ArrayIterator($this->get(self::SIGNUPTIME));
    }

    /**
     * Returns element from 'signUpTime' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\TimeInfo
     */
    public function getSignUpTimeAt($offset)
    {
        return $this->get(self::SIGNUPTIME, $offset);
    }

    /**
     * Returns count of 'signUpTime' list
     *
     * @return int
     */
    public function getSignUpTimeCount()
    {
        return $this->count(self::SIGNUPTIME);
    }

    /**
     * Appends value to 'beginningTime' list
     *
     * @param \Proto\TimeInfo $value Value to append
     *
     * @return null
     */
    public function appendBeginningTime(\Proto\TimeInfo $value)
    {
        return $this->append(self::BEGINNINGTIME, $value);
    }

    /**
     * Clears 'beginningTime' list
     *
     * @return null
     */
    public function clearBeginningTime()
    {
        return $this->clear(self::BEGINNINGTIME);
    }

    /**
     * Returns 'beginningTime' list
     *
     * @return \Proto\TimeInfo[]
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
        return count($this->get(self::BEGINNINGTIME)) !== 0;
    }

    /**
     * Returns 'beginningTime' iterator
     *
     * @return \ArrayIterator
     */
    public function getBeginningTimeIterator()
    {
        return new \ArrayIterator($this->get(self::BEGINNINGTIME));
    }

    /**
     * Returns element from 'beginningTime' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\TimeInfo
     */
    public function getBeginningTimeAt($offset)
    {
        return $this->get(self::BEGINNINGTIME, $offset);
    }

    /**
     * Returns count of 'beginningTime' list
     *
     * @return int
     */
    public function getBeginningTimeCount()
    {
        return $this->count(self::BEGINNINGTIME);
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
}
}