<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 17:17:32
 *
 * proto package
 */

namespace Proto {
/**
 * SC_ComPetition_SignUp message
 */
class SC_ComPetition_SignUp extends \ProtobufMessage
{
    /* Field index constants */
    const BCOMPETITION = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BCOMPETITION => array(
            'name' => 'bCompetition',
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
        $this->values[self::BCOMPETITION] = null;
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
     * Sets value of 'bCompetition' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBCompetition($value)
    {
        return $this->set(self::BCOMPETITION, $value);
    }

    /**
     * Returns value of 'bCompetition' property
     *
     * @return integer
     */
    public function getBCompetition()
    {
        $value = $this->get(self::BCOMPETITION);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'bCompetition' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBCompetition()
    {
        return $this->get(self::BCOMPETITION) !== null;
    }
}
}