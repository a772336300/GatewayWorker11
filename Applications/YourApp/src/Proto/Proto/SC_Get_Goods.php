<?php
/**
 * Auto generated from new.proto at 2019-07-19 16:12:55
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Get_Goods message
 */
class SC_Get_Goods extends \ProtobufMessage
{
    /* Field index constants */
    const GOODS_INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GOODS_INFO => array(
            'name' => 'goods_info',
            'repeated' => true,
            'type' => '\Proto\E_Goods_Info'
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
        $this->values[self::GOODS_INFO] = array();
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
     * Appends value to 'goods_info' list
     *
     * @param \Proto\E_Goods_Info $value Value to append
     *
     * @return null
     */
    public function appendGoodsInfo(\Proto\E_Goods_Info $value)
    {
        return $this->append(self::GOODS_INFO, $value);
    }

    /**
     * Clears 'goods_info' list
     *
     * @return null
     */
    public function clearGoodsInfo()
    {
        return $this->clear(self::GOODS_INFO);
    }

    /**
     * Returns 'goods_info' list
     *
     * @return \Proto\E_Goods_Info[]
     */
    public function getGoodsInfo()
    {
        return $this->get(self::GOODS_INFO);
    }

    /**
     * Returns true if 'goods_info' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGoodsInfo()
    {
        return count($this->get(self::GOODS_INFO)) !== 0;
    }

    /**
     * Returns 'goods_info' iterator
     *
     * @return \ArrayIterator
     */
    public function getGoodsInfoIterator()
    {
        return new \ArrayIterator($this->get(self::GOODS_INFO));
    }

    /**
     * Returns element from 'goods_info' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Goods_Info
     */
    public function getGoodsInfoAt($offset)
    {
        return $this->get(self::GOODS_INFO, $offset);
    }

    /**
     * Returns count of 'goods_info' list
     *
     * @return int
     */
    public function getGoodsInfoCount()
    {
        return $this->count(self::GOODS_INFO);
    }
}
}