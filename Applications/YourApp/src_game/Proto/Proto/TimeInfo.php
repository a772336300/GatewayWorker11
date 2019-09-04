<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 16:57:38
 *
 * proto package
 */

namespace Proto {
/**
 * TimeInfo message
 */
class TimeInfo extends \ProtobufMessage
{
    /* Field index constants */
    const YEAR = 1;
    const MONTH = 2;
    const DAY = 3;
    const HOUR = 4;
    const MINUTE = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::YEAR => array(
            'name' => 'year',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MONTH => array(
            'name' => 'month',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAY => array(
            'name' => 'day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HOUR => array(
            'name' => 'hour',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MINUTE => array(
            'name' => 'minute',
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
        $this->values[self::YEAR] = null;
        $this->values[self::MONTH] = null;
        $this->values[self::DAY] = null;
        $this->values[self::HOUR] = null;
        $this->values[self::MINUTE] = null;
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
     * Sets value of 'year' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setYear($value)
    {
        return $this->set(self::YEAR, $value);
    }

    /**
     * Returns value of 'year' property
     *
     * @return integer
     */
    public function getYear()
    {
        $value = $this->get(self::YEAR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'year' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasYear()
    {
        return $this->get(self::YEAR) !== null;
    }

    /**
     * Sets value of 'month' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMonth($value)
    {
        return $this->set(self::MONTH, $value);
    }

    /**
     * Returns value of 'month' property
     *
     * @return integer
     */
    public function getMonth()
    {
        $value = $this->get(self::MONTH);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'month' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMonth()
    {
        return $this->get(self::MONTH) !== null;
    }

    /**
     * Sets value of 'day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay($value)
    {
        return $this->set(self::DAY, $value);
    }

    /**
     * Returns value of 'day' property
     *
     * @return integer
     */
    public function getDay()
    {
        $value = $this->get(self::DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'day' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDay()
    {
        return $this->get(self::DAY) !== null;
    }

    /**
     * Sets value of 'hour' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHour($value)
    {
        return $this->set(self::HOUR, $value);
    }

    /**
     * Returns value of 'hour' property
     *
     * @return integer
     */
    public function getHour()
    {
        $value = $this->get(self::HOUR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'hour' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasHour()
    {
        return $this->get(self::HOUR) !== null;
    }

    /**
     * Sets value of 'minute' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMinute($value)
    {
        return $this->set(self::MINUTE, $value);
    }

    /**
     * Returns value of 'minute' property
     *
     * @return integer
     */
    public function getMinute()
    {
        $value = $this->get(self::MINUTE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'minute' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMinute()
    {
        return $this->get(self::MINUTE) !== null;
    }
}
}