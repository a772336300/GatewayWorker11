<?php
/**
 * Auto generated from new.proto at 2019-09-11 15:27:06
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Back_White message
 */
class SC_Back_White extends \ProtobufMessage
{
    /* Field index constants */
    const IS_WHITE_USER = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::IS_WHITE_USER => array(
            'name' => 'is_white_user',
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
        $this->values[self::IS_WHITE_USER] = null;
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
     * Sets value of 'is_white_user' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsWhiteUser($value)
    {
        return $this->set(self::IS_WHITE_USER, $value);
    }

    /**
     * Returns value of 'is_white_user' property
     *
     * @return boolean
     */
    public function getIsWhiteUser()
    {
        $value = $this->get(self::IS_WHITE_USER);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'is_white_user' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIsWhiteUser()
    {
        return $this->get(self::IS_WHITE_USER) !== null;
    }
}
}