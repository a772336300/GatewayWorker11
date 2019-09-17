<?php
/**
 * Auto generated from new.proto at 2019-09-17 10:52:12
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Today_Huilv message
 */
class SC_Today_Huilv extends \ProtobufMessage
{
    /* Field index constants */
    const LV = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LV => array(
            'name' => 'lv',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
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
        $this->values[self::LV] = null;
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
     * Sets value of 'lv' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setLv($value)
    {
        return $this->set(self::LV, $value);
    }

    /**
     * Returns value of 'lv' property
     *
     * @return double
     */
    public function getLv()
    {
        $value = $this->get(self::LV);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Returns true if 'lv' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLv()
    {
        return $this->get(self::LV) !== null;
    }
}
}