<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Packet_Update message
 */
class SC_User_Packet_Update extends \ProtobufMessage
{
    /* Field index constants */
    const USER_PACKET = 1;
    const TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_PACKET => array(
            'name' => 'user_packet',
            'required' => false,
            'type' => '\Proto\E_User_Packet'
        ),
        self::TYPE => array(
            'name' => 'type',
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
        $this->values[self::USER_PACKET] = null;
        $this->values[self::TYPE] = null;
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
}
}