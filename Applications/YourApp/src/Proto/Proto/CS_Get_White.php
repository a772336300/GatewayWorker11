<?php
/**
 * Auto generated from new.proto at 2019-09-11 15:27:06
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Get_White message
 */
class CS_Get_White extends \ProtobufMessage
{
    /* Field index constants */
    const PHONE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PHONE => array(
            'name' => 'phone',
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
        $this->values[self::PHONE] = null;
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
     * Sets value of 'phone' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhone($value)
    {
        return $this->set(self::PHONE, $value);
    }

    /**
     * Returns value of 'phone' property
     *
     * @return string
     */
    public function getPhone()
    {
        $value = $this->get(self::PHONE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'phone' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhone()
    {
        return $this->get(self::PHONE) !== null;
    }
}
}