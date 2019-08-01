<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Get_Spread_Award message
 */
class CS_User_Get_Spread_Award extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
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
        $this->values[self::UID] = null;
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
     * Sets value of 'uid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUid($value)
    {
        return $this->set(self::UID, $value);
    }

    /**
     * Returns value of 'uid' property
     *
     * @return integer
     */
    public function getUid()
    {
        $value = $this->get(self::UID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'uid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUid()
    {
        return $this->get(self::UID) !== null;
    }
}
}