<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-09 14:56:38
 *
 * proto package
 */

namespace Proto {
/**
 * SC_ComPetition_Start message
 */
class SC_ComPetition_Start extends \ProtobufMessage
{
    /* Field index constants */
    const COMPETITION_ID = 1;
    const GAME_TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::COMPETITION_ID => array(
            'name' => 'competition_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAME_TYPE => array(
            'name' => 'game_type',
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
        $this->values[self::GAME_TYPE] = null;
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
     * Sets value of 'competition_id' property
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
     * Returns value of 'competition_id' property
     *
     * @return integer
     */
    public function getCompetitionId()
    {
        $value = $this->get(self::COMPETITION_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'competition_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCompetitionId()
    {
        return $this->get(self::COMPETITION_ID) !== null;
    }

    /**
     * Sets value of 'game_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameType($value)
    {
        return $this->set(self::GAME_TYPE, $value);
    }

    /**
     * Returns value of 'game_type' property
     *
     * @return integer
     */
    public function getGameType()
    {
        $value = $this->get(self::GAME_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'game_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameType()
    {
        return $this->get(self::GAME_TYPE) !== null;
    }
}
}