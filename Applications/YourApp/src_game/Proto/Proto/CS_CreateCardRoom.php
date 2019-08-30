<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-30 18:28:35
 *
 * proto package
 */

namespace Proto {
/**
 * CS_CreateCardRoom message
 */
class CS_CreateCardRoom extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const ROOMTYPE = 2;
    const GAMETYPE = 3;
    const PLAYERS = 4;
    const NUMBEROFGAMES = 5;
    const SIGNUPTIME = 6;
    const BEGINNINGTIME = 7;
    const ROOMNAME = 8;
    const ROOMEXPLAIN = 9;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOMTYPE => array(
            'name' => 'roomType',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAMETYPE => array(
            'name' => 'gameType',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERS => array(
            'name' => 'players',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NUMBEROFGAMES => array(
            'name' => 'numberOfGames',
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
        self::ROOMNAME => array(
            'name' => 'roomName',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ROOMEXPLAIN => array(
            'name' => 'roomExplain',
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
        $this->values[self::ROOMTYPE] = null;
        $this->values[self::GAMETYPE] = null;
        $this->values[self::PLAYERS] = null;
        $this->values[self::NUMBEROFGAMES] = null;
        $this->values[self::SIGNUPTIME] = array();
        $this->values[self::BEGINNINGTIME] = array();
        $this->values[self::ROOMNAME] = null;
        $this->values[self::ROOMEXPLAIN] = null;
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
     * Sets value of 'playerid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerid($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerid' property
     *
     * @return integer
     */
    public function getPlayerid()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'playerid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerid()
    {
        return $this->get(self::PLAYERID) !== null;
    }

    /**
     * Sets value of 'roomType' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRoomType($value)
    {
        return $this->set(self::ROOMTYPE, $value);
    }

    /**
     * Returns value of 'roomType' property
     *
     * @return integer
     */
    public function getRoomType()
    {
        $value = $this->get(self::ROOMTYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'roomType' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRoomType()
    {
        return $this->get(self::ROOMTYPE) !== null;
    }

    /**
     * Sets value of 'gameType' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameType($value)
    {
        return $this->set(self::GAMETYPE, $value);
    }

    /**
     * Returns value of 'gameType' property
     *
     * @return integer
     */
    public function getGameType()
    {
        $value = $this->get(self::GAMETYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gameType' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameType()
    {
        return $this->get(self::GAMETYPE) !== null;
    }

    /**
     * Sets value of 'players' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayers($value)
    {
        return $this->set(self::PLAYERS, $value);
    }

    /**
     * Returns value of 'players' property
     *
     * @return integer
     */
    public function getPlayers()
    {
        $value = $this->get(self::PLAYERS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'players' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayers()
    {
        return $this->get(self::PLAYERS) !== null;
    }

    /**
     * Sets value of 'numberOfGames' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNumberOfGames($value)
    {
        return $this->set(self::NUMBEROFGAMES, $value);
    }

    /**
     * Returns value of 'numberOfGames' property
     *
     * @return integer
     */
    public function getNumberOfGames()
    {
        $value = $this->get(self::NUMBEROFGAMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'numberOfGames' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasNumberOfGames()
    {
        return $this->get(self::NUMBEROFGAMES) !== null;
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
     * Sets value of 'roomName' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRoomName($value)
    {
        return $this->set(self::ROOMNAME, $value);
    }

    /**
     * Returns value of 'roomName' property
     *
     * @return string
     */
    public function getRoomName()
    {
        $value = $this->get(self::ROOMNAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'roomName' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRoomName()
    {
        return $this->get(self::ROOMNAME) !== null;
    }

    /**
     * Sets value of 'roomExplain' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRoomExplain($value)
    {
        return $this->set(self::ROOMEXPLAIN, $value);
    }

    /**
     * Returns value of 'roomExplain' property
     *
     * @return string
     */
    public function getRoomExplain()
    {
        $value = $this->get(self::ROOMEXPLAIN);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'roomExplain' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRoomExplain()
    {
        return $this->get(self::ROOMEXPLAIN) !== null;
    }
}
}