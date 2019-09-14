<?php
/**
 * Auto generated from new.proto at 2019-09-14 15:30:04
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Order_List message
 */
class SC_User_Order_List extends \ProtobufMessage
{
    /* Field index constants */
    const ORDER_INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ORDER_INFO => array(
            'name' => 'order_info',
            'repeated' => true,
            'type' => '\Proto\E_Order_Info'
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
        $this->values[self::ORDER_INFO] = array();
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
     * Appends value to 'order_info' list
     *
     * @param \Proto\E_Order_Info $value Value to append
     *
     * @return null
     */
    public function appendOrderInfo(\Proto\E_Order_Info $value)
    {
        return $this->append(self::ORDER_INFO, $value);
    }

    /**
     * Clears 'order_info' list
     *
     * @return null
     */
    public function clearOrderInfo()
    {
        return $this->clear(self::ORDER_INFO);
    }

    /**
     * Returns 'order_info' list
     *
     * @return \Proto\E_Order_Info[]
     */
    public function getOrderInfo()
    {
        return $this->get(self::ORDER_INFO);
    }

    /**
     * Returns true if 'order_info' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOrderInfo()
    {
        return count($this->get(self::ORDER_INFO)) !== 0;
    }

    /**
     * Returns 'order_info' iterator
     *
     * @return \ArrayIterator
     */
    public function getOrderInfoIterator()
    {
        return new \ArrayIterator($this->get(self::ORDER_INFO));
    }

    /**
     * Returns element from 'order_info' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Order_Info
     */
    public function getOrderInfoAt($offset)
    {
        return $this->get(self::ORDER_INFO, $offset);
    }

    /**
     * Returns count of 'order_info' list
     *
     * @return int
     */
    public function getOrderInfoCount()
    {
        return $this->count(self::ORDER_INFO);
    }
}
}