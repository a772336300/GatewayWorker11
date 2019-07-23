<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:31
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Get_Task_Award message
 */
class SC_User_Get_Task_Award extends \ProtobufMessage
{
    /* Field index constants */
    const CODE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
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