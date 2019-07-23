<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:31
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Get_User_Active message
 */
class SC_Get_User_Active extends \ProtobufMessage
{
    /* Field index constants */
    const USER_ACTIVE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_ACTIVE => array(
            'name' => 'user_active',
            'repeated' => true,
            'type' => '\Proto\E_User_Active'
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
        $this->values[self::USER_ACTIVE] = array();
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
     * Appends value to 'user_active' list
     *
     * @param \Proto\E_User_Active $value Value to append
     *
     * @return null
     */
    public function appendUserActive(\Proto\E_User_Active $value)
    {
        return $this->append(self::USER_ACTIVE, $value);
    }

    /**
     * Clears 'user_active' list
     *
     * @return null
     */
    public function clearUserActive()
    {
        return $this->clear(self::USER_ACTIVE);
    }

    /**
     * Returns 'user_active' list
     *
     * @return \Proto\E_User_Active[]
     */
    public function getUserActive()
    {
        return $this->get(self::USER_ACTIVE);
    }

    /**
     * Returns true if 'user_active' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserActive()
    {
        return count($this->get(self::USER_ACTIVE)) !== 0;
    }

    /**
     * Returns 'user_active' iterator
     *
     * @return \ArrayIterator
     */
    public function getUserActiveIterator()
    {
        return new \ArrayIterator($this->get(self::USER_ACTIVE));
    }

    /**
     * Returns element from 'user_active' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_User_Active
     */
    public function getUserActiveAt($offset)
    {
        return $this->get(self::USER_ACTIVE, $offset);
    }

    /**
     * Returns count of 'user_active' list
     *
     * @return int
     */
    public function getUserActiveCount()
    {
        return $this->count(self::USER_ACTIVE);
    }
}
}