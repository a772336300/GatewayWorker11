<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * Item_Slot message
 */
class Item_Slot extends \ProtobufMessage
{
    /* Field index constants */
    const SLOT = 1;
    const ITEMID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SLOT => array(
            'name' => 'slot',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEMID => array(
            'name' => 'itemid',
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
        $this->values[self::SLOT] = null;
        $this->values[self::ITEMID] = null;
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
     * Sets value of 'slot' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSlot($value)
    {
        return $this->set(self::SLOT, $value);
    }

    /**
     * Returns value of 'slot' property
     *
     * @return integer
     */
    public function getSlot()
    {
        $value = $this->get(self::SLOT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'slot' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSlot()
    {
        return $this->get(self::SLOT) !== null;
    }

    /**
     * Sets value of 'itemid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItemid($value)
    {
        return $this->set(self::ITEMID, $value);
    }

    /**
     * Returns value of 'itemid' property
     *
     * @return integer
     */
    public function getItemid()
    {
        $value = $this->get(self::ITEMID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'itemid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasItemid()
    {
        return $this->get(self::ITEMID) !== null;
    }
}
}