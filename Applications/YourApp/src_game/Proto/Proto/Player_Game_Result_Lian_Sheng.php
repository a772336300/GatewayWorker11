<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-24 15:16:42
 *
 * proto package
 */

namespace Proto {
/**
 * Lian_Sheng message embedded in Player_Game_Result message
 */
class Player_Game_Result_Lian_Sheng extends \ProtobufMessage
{
    /* Field index constants */
    const COUNT = 1;
    const BASE_BU = 2;
    const EXTRA_BU = 3;
    const EXTRA_GOODS = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::COUNT => array(
            'name' => 'count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BASE_BU => array(
            'name' => 'base_BU',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EXTRA_BU => array(
            'name' => 'extra_BU',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EXTRA_GOODS => array(
            'name' => 'extra_goods',
            'repeated' => true,
            'type' => '\Proto\Player_Game_Result_Lian_Sheng_Goods'
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
        $this->values[self::COUNT] = null;
        $this->values[self::BASE_BU] = null;
        $this->values[self::EXTRA_BU] = null;
        $this->values[self::EXTRA_GOODS] = array();
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
     * Sets value of 'count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCount($value)
    {
        return $this->set(self::COUNT, $value);
    }

    /**
     * Returns value of 'count' property
     *
     * @return integer
     */
    public function getCount()
    {
        $value = $this->get(self::COUNT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'count' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCount()
    {
        return $this->get(self::COUNT) !== null;
    }

    /**
     * Sets value of 'base_BU' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBaseBU($value)
    {
        return $this->set(self::BASE_BU, $value);
    }

    /**
     * Returns value of 'base_BU' property
     *
     * @return integer
     */
    public function getBaseBU()
    {
        $value = $this->get(self::BASE_BU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'base_BU' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBaseBU()
    {
        return $this->get(self::BASE_BU) !== null;
    }

    /**
     * Sets value of 'extra_BU' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExtraBU($value)
    {
        return $this->set(self::EXTRA_BU, $value);
    }

    /**
     * Returns value of 'extra_BU' property
     *
     * @return integer
     */
    public function getExtraBU()
    {
        $value = $this->get(self::EXTRA_BU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'extra_BU' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasExtraBU()
    {
        return $this->get(self::EXTRA_BU) !== null;
    }

    /**
     * Appends value to 'extra_goods' list
     *
     * @param \Proto\Player_Game_Result_Lian_Sheng_Goods $value Value to append
     *
     * @return null
     */
    public function appendExtraGoods(\Proto\Player_Game_Result_Lian_Sheng_Goods $value)
    {
        return $this->append(self::EXTRA_GOODS, $value);
    }

    /**
     * Clears 'extra_goods' list
     *
     * @return null
     */
    public function clearExtraGoods()
    {
        return $this->clear(self::EXTRA_GOODS);
    }

    /**
     * Returns 'extra_goods' list
     *
     * @return \Proto\Player_Game_Result_Lian_Sheng_Goods[]
     */
    public function getExtraGoods()
    {
        return $this->get(self::EXTRA_GOODS);
    }

    /**
     * Returns true if 'extra_goods' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasExtraGoods()
    {
        return count($this->get(self::EXTRA_GOODS)) !== 0;
    }

    /**
     * Returns 'extra_goods' iterator
     *
     * @return \ArrayIterator
     */
    public function getExtraGoodsIterator()
    {
        return new \ArrayIterator($this->get(self::EXTRA_GOODS));
    }

    /**
     * Returns element from 'extra_goods' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\Player_Game_Result_Lian_Sheng_Goods
     */
    public function getExtraGoodsAt($offset)
    {
        return $this->get(self::EXTRA_GOODS, $offset);
    }

    /**
     * Returns count of 'extra_goods' list
     *
     * @return int
     */
    public function getExtraGoodsCount()
    {
        return $this->count(self::EXTRA_GOODS);
    }
}
}