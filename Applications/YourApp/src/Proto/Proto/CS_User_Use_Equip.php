<?php
/**
 * Auto generated from new.proto at 2019-05-27 09:30:50
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Use_Equip message
 */
class CS_User_Use_Equip extends \ProtobufMessage
{
    /* Field index constants */
    const MOXING = 1;
    const ITEM_SLOT = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MOXING => array(
            'name' => 'moxing',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM_SLOT => array(
            'name' => 'item_slot',
            'repeated' => true,
            'type' => '\Proto\Item_Slot'
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
        $this->values[self::MOXING] = null;
        $this->values[self::ITEM_SLOT] = array();
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
     * Sets value of 'moxing' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMoxing($value)
    {
        return $this->set(self::MOXING, $value);
    }

    /**
     * Returns value of 'moxing' property
     *
     * @return integer
     */
    public function getMoxing()
    {
        $value = $this->get(self::MOXING);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'moxing' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMoxing()
    {
        return $this->get(self::MOXING) !== null;
    }

    /**
     * Appends value to 'item_slot' list
     *
     * @param \Proto\Item_Slot $value Value to append
     *
     * @return null
     */
    public function appendItemSlot(\Proto\Item_Slot $value)
    {
        return $this->append(self::ITEM_SLOT, $value);
    }

    /**
     * Clears 'item_slot' list
     *
     * @return null
     */
    public function clearItemSlot()
    {
        return $this->clear(self::ITEM_SLOT);
    }

    /**
     * Returns 'item_slot' list
     *
     * @return \Proto\Item_Slot[]
     */
    public function getItemSlot()
    {
        return $this->get(self::ITEM_SLOT);
    }

    /**
     * Returns true if 'item_slot' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasItemSlot()
    {
        return count($this->get(self::ITEM_SLOT)) !== 0;
    }

    /**
     * Returns 'item_slot' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemSlotIterator()
    {
        return new \ArrayIterator($this->get(self::ITEM_SLOT));
    }

    /**
     * Returns element from 'item_slot' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\Item_Slot
     */
    public function getItemSlotAt($offset)
    {
        return $this->get(self::ITEM_SLOT, $offset);
    }

    /**
     * Returns count of 'item_slot' list
     *
     * @return int
     */
    public function getItemSlotCount()
    {
        return $this->count(self::ITEM_SLOT);
    }
}
}