<?php
/**
 * Auto generated from new.proto at 2019-07-11 16:20:47
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Packet_Add_Goods message
 */
class SC_User_Packet_Add_Goods extends \ProtobufMessage
{
    /* Field index constants */
    const USER_PACKET = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_PACKET => array(
            'name' => 'user_packet',
            'required' => false,
            'type' => '\Proto\E_User_Packet'
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
        $this->values[self::USER_PACKET] = null;
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
     * Sets value of 'user_packet' property
     *
     * @param \Proto\E_User_Packet $value Property value
     *
     * @return null
     */
    public function setUserPacket(\Proto\E_User_Packet $value=null)
    {
        return $this->set(self::USER_PACKET, $value);
    }

    /**
     * Returns value of 'user_packet' property
     *
     * @return \Proto\E_User_Packet
     */
    public function getUserPacket()
    {
        return $this->get(self::USER_PACKET);
    }

    /**
     * Returns true if 'user_packet' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserPacket()
    {
        return $this->get(self::USER_PACKET) !== null;
    }
}
}