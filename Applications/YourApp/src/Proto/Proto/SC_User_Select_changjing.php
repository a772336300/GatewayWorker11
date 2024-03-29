<?php
/**
 * Auto generated from new.proto at 2019-05-27 11:47:10
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Select_changjing message
 */
class SC_User_Select_changjing extends \ProtobufMessage
{
    /* Field index constants */
    const CHANGJING = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CHANGJING => array(
            'name' => 'changjing',
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
        $this->values[self::CHANGJING] = null;
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
     * Sets value of 'changjing' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setChangjing($value)
    {
        return $this->set(self::CHANGJING, $value);
    }

    /**
     * Returns value of 'changjing' property
     *
     * @return integer
     */
    public function getChangjing()
    {
        $value = $this->get(self::CHANGJING);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'changjing' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasChangjing()
    {
        return $this->get(self::CHANGJING) !== null;
    }
}
}