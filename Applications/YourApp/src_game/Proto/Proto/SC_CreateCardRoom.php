<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-12 15:42:38
 *
 * proto package
 */

namespace Proto {
/**
 * SC_CreateCardRoom message
 */
class SC_CreateCardRoom extends \ProtobufMessage
{
    /* Field index constants */
    const RESULT = 1;
    const ROOMINFO = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RESULT => array(
            'name' => 'result',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOMINFO => array(
            'name' => 'roomInfo',
            'required' => false,
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
        $this->values[self::RESULT] = null;
        $this->values[self::ROOMINFO] = null;
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
     * Sets value of 'result' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setResult($value)
    {
        return $this->set(self::RESULT, $value);
    }

    /**
     * Returns value of 'result' property
     *
     * @return integer
     */
    public function getResult()
    {
        $value = $this->get(self::RESULT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'result' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasResult()
    {
        return $this->get(self::RESULT) !== null;
    }

    /**
     * Sets value of 'roomInfo' property
     *
     * @param \Proto\RoomInfoTable $value Property value
     *
     * @return null
     */
    public function setRoomInfo(\Proto\RoomInfoTable $value=null)
    {
        return $this->set(self::ROOMINFO, $value);
    }

    /**
     * Returns value of 'roomInfo' property
     *
     * @return \Proto\RoomInfoTable
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
        return $this->get(self::ROOMINFO) !== null;
    }
}
}