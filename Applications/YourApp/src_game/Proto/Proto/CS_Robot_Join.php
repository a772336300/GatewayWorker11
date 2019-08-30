<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-30 14:56:08
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Robot_Join message
 */
class CS_Robot_Join extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerId',
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
}
}