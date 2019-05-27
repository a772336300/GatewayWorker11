<?php
/**
 * Auto generated from new.proto at 2019-05-27 10:49:43
 *
 * proto package
 */

namespace Proto {
/**
 * SC_XinTiao message
 */
class SC_XinTiao extends \ProtobufMessage
{
    /* Field index constants */
    const DATE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATE => array(
            'name' => 'date',
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
        $this->values[self::DATE] = null;
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
     * Sets value of 'date' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDate($value)
    {
        return $this->set(self::DATE, $value);
    }

    /**
     * Returns value of 'date' property
     *
     * @return integer
     */
    public function getDate()
    {
        $value = $this->get(self::DATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'date' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDate()
    {
        return $this->get(self::DATE) !== null;
    }
}
}