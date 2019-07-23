<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Vip message
 */
class SC_User_Vip extends \ProtobufMessage
{
    /* Field index constants */
    const VIP_DAY = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::VIP_DAY => array(
            'name' => 'vip_day',
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
        $this->values[self::VIP_DAY] = null;
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
     * Sets value of 'vip_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVipDay($value)
    {
        return $this->set(self::VIP_DAY, $value);
    }

    /**
     * Returns value of 'vip_day' property
     *
     * @return integer
     */
    public function getVipDay()
    {
        $value = $this->get(self::VIP_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'vip_day' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasVipDay()
    {
        return $this->get(self::VIP_DAY) !== null;
    }
}
}