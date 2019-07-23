<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:31
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Buy_Goods message
 */
class SC_User_Buy_Goods extends \ProtobufMessage
{
    /* Field index constants */
    const IS_SUCCESS = 1;
    const CODE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::IS_SUCCESS => array(
            'name' => 'is_success',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::CODE => array(
            'name' => 'code',
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
        $this->values[self::IS_SUCCESS] = null;
        $this->values[self::CODE] = null;
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
     * Sets value of 'is_success' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsSuccess($value)
    {
        return $this->set(self::IS_SUCCESS, $value);
    }

    /**
     * Returns value of 'is_success' property
     *
     * @return boolean
     */
    public function getIsSuccess()
    {
        $value = $this->get(self::IS_SUCCESS);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'is_success' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIsSuccess()
    {
        return $this->get(self::IS_SUCCESS) !== null;
    }

    /**
     * Sets value of 'code' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCode($value)
    {
        return $this->set(self::CODE, $value);
    }

    /**
     * Returns value of 'code' property
     *
     * @return integer
     */
    public function getCode()
    {
        $value = $this->get(self::CODE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'code' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCode()
    {
        return $this->get(self::CODE) !== null;
    }
}
}