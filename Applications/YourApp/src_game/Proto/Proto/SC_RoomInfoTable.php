<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-30 17:06:31
 *
 * proto package
 */

namespace Proto {
/**
 * SC_RoomInfoTable message
 */
class SC_RoomInfoTable extends \ProtobufMessage
{
    /* Field index constants */
    const ROOMINFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ROOMINFO => array(
            'name' => 'roomInfo',
            'repeated' => true,
            'type' => '\Proto\RoomInfoTable'
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
        $this->values[self::ROOMINFO] = array();
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
     * Appends value to 'roomInfo' list
     *
     * @param \Proto\RoomInfoTable $value Value to append
     *
     * @return null
     */
    public function appendRoomInfo(\Proto\RoomInfoTable $value)
    {
        return $this->append(self::ROOMINFO, $value);
    }

    /**
     * Clears 'roomInfo' list
     *
     * @return null
     */
    public function clearRoomInfo()
    {
        return $this->clear(self::ROOMINFO);
    }

    /**
     * Returns 'roomInfo' list
     *
     * @return \Proto\RoomInfoTable[]
     */
    public function getRoomInfo()
    {
        return $this->get(self::ROOMINFO);
    }

    /**
     * Returns true if 'roomInfo' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRoomInfo()
    {
        return count($this->get(self::ROOMINFO)) !== 0;
    }

    /**
     * Returns 'roomInfo' iterator
     *
     * @return \ArrayIterator
     */
    public function getRoomInfoIterator()
    {
        return new \ArrayIterator($this->get(self::ROOMINFO));
    }

    /**
     * Returns element from 'roomInfo' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\RoomInfoTable
     */
    public function getRoomInfoAt($offset)
    {
        return $this->get(self::ROOMINFO, $offset);
    }

    /**
     * Returns count of 'roomInfo' list
     *
     * @return int
     */
    public function getRoomInfoCount()
    {
        return $this->count(self::ROOMINFO);
    }
}
}