<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-05 16:14:52
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
            'required' => false,
            'type' => '\Proto\SC_Competition_Result_Competition_end'
        ),
        self::TOP_LIST => array(
            'name' => 'top_list',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::COMPETITION] = null;
        $this->values[self::TOP_LIST] = null;
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
     * Sets value of 'competition' property
     *
     * @param \Proto\SC_Competition_Result_Competition_end $value Property value
     *
     * @return null
     */
    public function setCompetition(\Proto\SC_Competition_Result_Competition_end $value=null)
    {
        return $this->set(self::COMPETITION, $value);
    }

    /**
     * Returns value of 'competition' property
     *
     * @return \Proto\SC_Competition_Result_Competition_end
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
        return $this->get(self::COMPETITION) !== null;
    }

    /**
     * Sets value of 'top_list' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTopList($value)
    {
        return $this->set(self::TOP_LIST, $value);
    }

    /**
     * Returns value of 'top_list' property
     *
     * @return string
     */
    public function getTopList()
    {
        $value = $this->get(self::TOP_LIST);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'top_list' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTopList()
    {
        return $this->get(self::TOP_LIST) !== null;
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