<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * SC_System_Tips_Str message
 */
class SC_System_Tips_Str extends \ProtobufMessage
{
    /* Field index constants */
    const TYPE = 1;
    const TIPSTR = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TIPSTR => array(
            'name' => 'tipStr',
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
        $this->values[self::TYPE] = null;
        $this->values[self::TIPSTR] = null;
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
     * Sets value of 'tipStr' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTipStr($value)
    {
        return $this->set(self::TIPSTR, $value);
    }

    /**
     * Returns value of 'tipStr' property
     *
     * @return string
     */
    public function getTipStr()
    {
        $value = $this->get(self::TIPSTR);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'tipStr' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTipStr()
    {
        return $this->get(self::TIPSTR) !== null;
    }
}
}