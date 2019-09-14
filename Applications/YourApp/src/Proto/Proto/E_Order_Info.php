<?php
/**
 * Auto generated from new.proto at 2019-09-14 15:30:04
 *
 * proto package
 */

namespace Proto {
/**
 * E_Order_Info message
 */
class E_Order_Info extends \ProtobufMessage
{
    /* Field index constants */
    const USER_SUBMIT_TIME = 1;
    const GOODS_NAME = 2;
    const TOTAL_PRICE = 3;
    const AUDIT_STATUS = 4;
    const OPER_SUBMIT_TIME = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_SUBMIT_TIME => array(
            'name' => 'user_submit_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GOODS_NAME => array(
            'name' => 'goods_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TOTAL_PRICE => array(
            'name' => 'total_price',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::AUDIT_STATUS => array(
            'name' => 'audit_status',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OPER_SUBMIT_TIME => array(
            'name' => 'oper_submit_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::USER_SUBMIT_TIME] = null;
        $this->values[self::GOODS_NAME] = null;
        $this->values[self::TOTAL_PRICE] = null;
        $this->values[self::AUDIT_STATUS] = null;
        $this->values[self::OPER_SUBMIT_TIME] = null;
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
     * Sets value of 'user_submit_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUserSubmitTime($value)
    {
        return $this->set(self::USER_SUBMIT_TIME, $value);
    }

    /**
     * Returns value of 'user_submit_time' property
     *
     * @return string
     */
    public function getUserSubmitTime()
    {
        $value = $this->get(self::USER_SUBMIT_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'user_submit_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserSubmitTime()
    {
        return $this->get(self::USER_SUBMIT_TIME) !== null;
    }

    /**
     * Sets value of 'goods_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGoodsName($value)
    {
        return $this->set(self::GOODS_NAME, $value);
    }

    /**
     * Returns value of 'goods_name' property
     *
     * @return string
     */
    public function getGoodsName()
    {
        $value = $this->get(self::GOODS_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'goods_name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGoodsName()
    {
        return $this->get(self::GOODS_NAME) !== null;
    }

    /**
     * Sets value of 'total_price' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTotalPrice($value)
    {
        return $this->set(self::TOTAL_PRICE, $value);
    }

    /**
     * Returns value of 'total_price' property
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        $value = $this->get(self::TOTAL_PRICE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'total_price' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTotalPrice()
    {
        return $this->get(self::TOTAL_PRICE) !== null;
    }

    /**
     * Sets value of 'audit_status' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAuditStatus($value)
    {
        return $this->set(self::AUDIT_STATUS, $value);
    }

    /**
     * Returns value of 'audit_status' property
     *
     * @return integer
     */
    public function getAuditStatus()
    {
        $value = $this->get(self::AUDIT_STATUS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'audit_status' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasAuditStatus()
    {
        return $this->get(self::AUDIT_STATUS) !== null;
    }

    /**
     * Sets value of 'oper_submit_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOperSubmitTime($value)
    {
        return $this->set(self::OPER_SUBMIT_TIME, $value);
    }

    /**
     * Returns value of 'oper_submit_time' property
     *
     * @return string
     */
    public function getOperSubmitTime()
    {
        $value = $this->get(self::OPER_SUBMIT_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'oper_submit_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOperSubmitTime()
    {
        return $this->get(self::OPER_SUBMIT_TIME) !== null;
    }
}
}