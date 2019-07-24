<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-24 15:16:42
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Is_Gaming message
 */
class CS_Is_Gaming extends \ProtobufMessage
{
    /* Field index constants */
    const DATA = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATA => array(
            'name' => 'data',
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
        $this->values[self::DATA] = null;
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
     * Sets value of 'data' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setData($value)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return integer
     */
    public function getData()
    {
        $value = $this->get(self::DATA);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'data' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasData()
    {
        return $this->get(self::DATA) !== null;
    }
}
}