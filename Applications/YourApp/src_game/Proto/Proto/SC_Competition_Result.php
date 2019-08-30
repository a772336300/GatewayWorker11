<?php
/**
 * Auto generated from doudizhu.proto at 2019-08-30 14:56:08
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
    const TOP_LIST = 3;
    const OVER = 4;

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
        self::TOP_LIST => array(
            'name' => 'top_list',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OVER => array(
            'name' => 'over',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::TOP_LIST] = array();
        $this->values[self::OVER] = null;
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

    /**
     * Appends value to 'top_list' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendTopList($value)
    {
        return $this->append(self::TOP_LIST, $value);
    }

    /**
     * Clears 'top_list' list
     *
     * @return null
     */
    public function clearTopList()
    {
        return $this->clear(self::TOP_LIST);
    }

    /**
     * Returns 'top_list' list
     *
     * @return integer[]
     */
    public function getTopList()
    {
        return $this->get(self::TOP_LIST);
    }

    /**
     * Returns true if 'top_list' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTopList()
    {
        return count($this->get(self::TOP_LIST)) !== 0;
    }

    /**
     * Returns 'top_list' iterator
     *
     * @return \ArrayIterator
     */
    public function getTopListIterator()
    {
        return new \ArrayIterator($this->get(self::TOP_LIST));
    }

    /**
     * Returns element from 'top_list' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getTopListAt($offset)
    {
        return $this->get(self::TOP_LIST, $offset);
    }

    /**
     * Returns count of 'top_list' list
     *
     * @return int
     */
    public function getTopListCount()
    {
        return $this->count(self::TOP_LIST);
    }

    /**
     * Sets value of 'over' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setOver($value)
    {
        return $this->set(self::OVER, $value);
    }

    /**
     * Returns value of 'over' property
     *
     * @return boolean
     */
    public function getOver()
    {
        $value = $this->get(self::OVER);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'over' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOver()
    {
        return $this->get(self::OVER) !== null;
    }
}
}