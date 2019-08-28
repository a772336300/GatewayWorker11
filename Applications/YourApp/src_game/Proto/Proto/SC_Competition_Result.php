<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-28 14:43:01
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Competition_Result message
 */
class SC_Competition_Result extends \ProtobufMessage
{
    /* Field index constants */
    const COMPETITION_ID = 1;
    const COMPETITION = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::COMPETITION_ID => array(
            'name' => 'Competition_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::COMPETITION => array(
            'name' => 'competition',
            'repeated' => true,
            'type' => '\Proto\SC_Competition_Result_Competition_end'
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
        $this->values[self::COMPETITION] = array();
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
     * Appends value to 'competition' list
     *
     * @param \Proto\SC_Competition_Result_Competition_end $value Value to append
     *
     * @return null
     */
    public function appendCompetition(\Proto\SC_Competition_Result_Competition_end $value)
    {
        return $this->append(self::COMPETITION, $value);
    }

    /**
     * Clears 'competition' list
     *
     * @return null
     */
    public function clearCompetition()
    {
        return $this->clear(self::COMPETITION);
    }

    /**
     * Returns 'competition' list
     *
     * @return \Proto\SC_Competition_Result_Competition_end[]
     */
    public function getCompetition()
    {
        return $this->get(self::COMPETITION);
    }

    /**
     * Returns true if 'competition' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCompetition()
    {
        return count($this->get(self::COMPETITION)) !== 0;
    }

    /**
     * Returns 'competition' iterator
     *
     * @return \ArrayIterator
     */
    public function getCompetitionIterator()
    {
        return new \ArrayIterator($this->get(self::COMPETITION));
    }

    /**
     * Returns element from 'competition' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\SC_Competition_Result_Competition_end
     */
    public function getCompetitionAt($offset)
    {
        return $this->get(self::COMPETITION, $offset);
    }

    /**
     * Returns count of 'competition' list
     *
     * @return int
     */
    public function getCompetitionCount()
    {
        return $this->count(self::COMPETITION);
    }
}
}