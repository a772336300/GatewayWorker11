<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:31
 *
 * proto package
 */

namespace Proto {
/**
 * E_Goods_Info message
 */
class E_Goods_Info extends \ProtobufMessage
{
    /* Field index constants */
    const _ID = 1;
    const PROP_ID = 2;
    const NAME = 3;
    const DES = 4;
    const IMG = 5;
    const MALL_TYPE = 6;
    const PRICE_TYPE = 7;
    const PRICE = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::_ID => array(
            'name' => '_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PROP_ID => array(
            'name' => 'prop_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DES => array(
            'name' => 'des',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMG => array(
            'name' => 'img',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MALL_TYPE => array(
            'name' => 'mall_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRICE_TYPE => array(
            'name' => 'price_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRICE => array(
            'name' => 'price',
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
        $this->values[self::_ID] = null;
        $this->values[self::PROP_ID] = null;
        $this->values[self::NAME] = null;
        $this->values[self::DES] = null;
        $this->values[self::IMG] = null;
        $this->values[self::MALL_TYPE] = null;
        $this->values[self::PRICE_TYPE] = null;
        $this->values[self::PRICE] = null;
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
     * Sets value of '_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::_ID, $value);
    }

    /**
     * Returns value of '_id' property
     *
     * @return string
     */
    public function getId()
    {
        $value = $this->get(self::_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if '_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return $this->get(self::_ID) !== null;
    }

    /**
     * Sets value of 'prop_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPropId($value)
    {
        return $this->set(self::PROP_ID, $value);
    }

    /**
     * Returns value of 'prop_id' property
     *
     * @return string
     */
    public function getPropId()
    {
        $value = $this->get(self::PROP_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'prop_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPropId()
    {
        return $this->get(self::PROP_ID) !== null;
    }

    /**
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasName()
    {
        return $this->get(self::NAME) !== null;
    }

    /**
     * Sets value of 'des' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDes($value)
    {
        return $this->set(self::DES, $value);
    }

    /**
     * Returns value of 'des' property
     *
     * @return string
     */
    public function getDes()
    {
        $value = $this->get(self::DES);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'des' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDes()
    {
        return $this->get(self::DES) !== null;
    }

    /**
     * Sets value of 'img' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImg($value)
    {
        return $this->set(self::IMG, $value);
    }

    /**
     * Returns value of 'img' property
     *
     * @return string
     */
    public function getImg()
    {
        $value = $this->get(self::IMG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'img' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasImg()
    {
        return $this->get(self::IMG) !== null;
    }

    /**
     * Sets value of 'mall_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMallType($value)
    {
        return $this->set(self::MALL_TYPE, $value);
    }

    /**
     * Returns value of 'mall_type' property
     *
     * @return integer
     */
    public function getMallType()
    {
        $value = $this->get(self::MALL_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'mall_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMallType()
    {
        return $this->get(self::MALL_TYPE) !== null;
    }

    /**
     * Sets value of 'price_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPriceType($value)
    {
        return $this->set(self::PRICE_TYPE, $value);
    }

    /**
     * Returns value of 'price_type' property
     *
     * @return integer
     */
    public function getPriceType()
    {
        $value = $this->get(self::PRICE_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'price_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPriceType()
    {
        return $this->get(self::PRICE_TYPE) !== null;
    }

    /**
     * Sets value of 'price' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPrice($value)
    {
        return $this->set(self::PRICE, $value);
    }

    /**
     * Returns value of 'price' property
     *
     * @return integer
     */
    public function getPrice()
    {
        $value = $this->get(self::PRICE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'price' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPrice()
    {
        return $this->get(self::PRICE) !== null;
    }
}
}