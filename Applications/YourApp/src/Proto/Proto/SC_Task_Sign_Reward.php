<?php
/**
 * Auto generated from new.proto at 2019-05-27 11:47:10
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Task_Sign_Reward message
 */
class SC_Task_Sign_Reward extends \ProtobufMessage
{
    /* Field index constants */
    const U_COIN = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::U_COIN => array(
            'name' => 'u_coin',
            'repeated' => true,
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
        $this->values[self::U_COIN] = array();
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
     * Appends value to 'u_coin' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendUCoin($value)
    {
        return $this->append(self::U_COIN, $value);
    }

    /**
     * Clears 'u_coin' list
     *
     * @return null
     */
    public function clearUCoin()
    {
        return $this->clear(self::U_COIN);
    }

    /**
     * Returns 'u_coin' list
     *
     * @return integer[]
     */
    public function getUCoin()
    {
        return $this->get(self::U_COIN);
    }

    /**
     * Returns true if 'u_coin' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUCoin()
    {
        return count($this->get(self::U_COIN)) !== 0;
    }

    /**
     * Returns 'u_coin' iterator
     *
     * @return \ArrayIterator
     */
    public function getUCoinIterator()
    {
        return new \ArrayIterator($this->get(self::U_COIN));
    }

    /**
     * Returns element from 'u_coin' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getUCoinAt($offset)
    {
        return $this->get(self::U_COIN, $offset);
    }

    /**
     * Returns count of 'u_coin' list
     *
     * @return int
     */
    public function getUCoinCount()
    {
        return $this->count(self::U_COIN);
    }
}
}