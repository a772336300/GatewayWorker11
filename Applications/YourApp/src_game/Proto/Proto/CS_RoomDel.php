<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-12 16:58:28
 *
 * proto package
 */

namespace Proto {
/**
 * CS_RoomDel message
 */
class CS_RoomDel extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const ROOMID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOMID => array(
            'name' => 'roomId',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::ROOMID] = null;
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
     * Sets value of 'roomId' property
     *
     * @param integer $value Property value
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
     * @return integer
     */
    public function getRoomId()
    {
        $value = $this->get(self::ROOMID);
        return $value === null ? (integer)$value : $value;
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
}
}