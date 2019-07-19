<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-15 17:21:59
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Play message
 */
class SC_Play extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const PLAY_DATA = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerId',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAY_DATA => array(
            'name' => 'play_data',
            'required' => false,
            'type' => '\Proto\Play_Data'
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
        $this->values[self::PLAY_DATA] = null;
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
     * Sets value of 'play_data' property
     *
     * @param \Proto\Play_Data $value Property value
     *
     * @return null
     */
    public function setPlayData(\Proto\Play_Data $value=null)
    {
        return $this->set(self::PLAY_DATA, $value);
    }

    /**
     * Returns value of 'play_data' property
     *
     * @return \Proto\Play_Data
     */
    public function getPlayData()
    {
        return $this->get(self::PLAY_DATA);
    }

    /**
     * Returns true if 'play_data' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayData()
    {
        return $this->get(self::PLAY_DATA) !== null;
    }
}
}