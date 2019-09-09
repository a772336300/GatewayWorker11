<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-09 15:05:50
 *
 * proto package
 */

namespace Proto {
/**
 * CS_ComPetition_Join message
 */
class CS_ComPetition_Join extends \ProtobufMessage
{
    /* Field index constants */
    const COMPETITION_ID = 1;
    const PLAYERID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::COMPETITION_ID => array(
            'name' => 'Competition_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
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
        $this->values[self::COMPETITION_ID] = null;
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
     * Sets value of 'Competition_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCompetitionId($value)
    {
        return $this->set(self::COMPETITION_ID, $value);
    }

    /**
     * Returns value of 'Competition_id' property
     *
     * @return integer
     */
    public function getCompetitionId()
    {
        $value = $this->get(self::COMPETITION_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Competition_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCompetitionId()
    {
        return $this->get(self::COMPETITION_ID) !== null;
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