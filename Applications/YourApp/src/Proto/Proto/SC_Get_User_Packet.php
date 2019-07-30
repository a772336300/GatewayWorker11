<?php
/**
 * Auto generated from new.proto at 2019-07-30 16:58:53
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Get_User_Packet message
 */
class SC_Get_User_Packet extends \ProtobufMessage
{
    /* Field index constants */
    const USER_PACKET = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_PACKET => array(
            'name' => 'user_packet',
            'repeated' => true,
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
        $this->values[self::USER_PACKET] = array();
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
     * Appends value to 'user_packet' list
     *
     * @param \Proto\E_User_Packet $value Value to append
     *
     * @return null
     */
    public function appendUserPacket(\Proto\E_User_Packet $value)
    {
        return $this->append(self::USER_PACKET, $value);
    }

    /**
     * Clears 'user_packet' list
     *
     * @return null
     */
    public function clearUserPacket()
    {
        return $this->clear(self::USER_PACKET);
    }

    /**
     * Returns 'user_packet' list
     *
     * @return \Proto\E_User_Packet[]
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
        return count($this->get(self::USER_PACKET)) !== 0;
    }

    /**
     * Returns 'user_packet' iterator
     *
     * @return \ArrayIterator
     */
    public function getUserPacketIterator()
    {
        return new \ArrayIterator($this->get(self::USER_PACKET));
    }

    /**
     * Returns element from 'user_packet' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_User_Packet
     */
    public function getUserPacketAt($offset)
    {
        return $this->get(self::USER_PACKET, $offset);
    }

    /**
     * Returns count of 'user_packet' list
     *
     * @return int
     */
    public function getUserPacketCount()
    {
        return $this->count(self::USER_PACKET);
    }
}
}