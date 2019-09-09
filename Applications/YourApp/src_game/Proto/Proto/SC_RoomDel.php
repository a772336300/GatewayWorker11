<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-09 15:05:51
 *
 * proto package
 */

namespace Proto {
/**
 * SC_RoomDel message
 */
class SC_RoomDel extends \ProtobufMessage
{
    /* Field index constants */
    const ROOMID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
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