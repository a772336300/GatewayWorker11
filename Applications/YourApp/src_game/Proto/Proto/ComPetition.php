<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-03 10:38:21
 *
 * proto package
 */

namespace Proto {
/**
 * ComPetition message
 */
class ComPetition extends \ProtobufMessage
{
    /* Field index constants */
    const COMPETITION_ID = 1;
    const TYPE = 2;
    const NUMBER = 3;
    const STARTTIME = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::COMPETITION_ID => array(
            'name' => 'competition_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NUMBER => array(
            'name' => 'number',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STARTTIME => array(
            'name' => 'starttime',
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
        $this->values[self::COMPETITION_ID] = null;
        $this->values[self::TYPE] = null;
        $this->values[self::NUMBER] = null;
        $this->values[self::STARTTIME] = null;
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
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasType()
    {
        return $this->get(self::TYPE) !== null;
    }

    /**
     * Sets value of 'number' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNumber($value)
    {
        return $this->set(self::NUMBER, $value);
    }

    /**
     * Returns value of 'number' property
     *
     * @return integer
     */
    public function getNumber()
    {
        $value = $this->get(self::NUMBER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'number' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasNumber()
    {
        return $this->get(self::NUMBER) !== null;
    }

    /**
     * Sets value of 'starttime' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStarttime($value)
    {
        return $this->set(self::STARTTIME, $value);
    }

    /**
     * Returns value of 'starttime' property
     *
     * @return string
     */
    public function getStarttime()
    {
        $value = $this->get(self::STARTTIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'starttime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasStarttime()
    {
        return $this->get(self::STARTTIME) !== null;
    }
}
}