<?php
/**
 * Auto generated from new.proto at 2019-05-27 09:30:50
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Info_Bag message
 */
class SC_User_Info_Bag extends \ProtobufMessage
{
    /* Field index constants */
    const EQUIPMENTING_ITEM = 1;
    const HAVING_ITEM = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::EQUIPMENTING_ITEM => array(
            'name' => 'equipmenting_item',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HAVING_ITEM => array(
            'name' => 'having_item',
            'repeated' => true,
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
        $this->values[self::EQUIPMENTING_ITEM] = array();
        $this->values[self::HAVING_ITEM] = array();
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
     * Appends value to 'equipmenting_item' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendEquipmentingItem($value)
    {
        return $this->append(self::EQUIPMENTING_ITEM, $value);
    }

    /**
     * Clears 'equipmenting_item' list
     *
     * @return null
     */
    public function clearEquipmentingItem()
    {
        return $this->clear(self::EQUIPMENTING_ITEM);
    }

    /**
     * Returns 'equipmenting_item' list
     *
     * @return integer[]
     */
    public function getEquipmentingItem()
    {
        return $this->get(self::EQUIPMENTING_ITEM);
    }

    /**
     * Returns true if 'equipmenting_item' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEquipmentingItem()
    {
        return count($this->get(self::EQUIPMENTING_ITEM)) !== 0;
    }

    /**
     * Returns 'equipmenting_item' iterator
     *
     * @return \ArrayIterator
     */
    public function getEquipmentingItemIterator()
    {
        return new \ArrayIterator($this->get(self::EQUIPMENTING_ITEM));
    }

    /**
     * Returns element from 'equipmenting_item' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getEquipmentingItemAt($offset)
    {
        return $this->get(self::EQUIPMENTING_ITEM, $offset);
    }

    /**
     * Returns count of 'equipmenting_item' list
     *
     * @return int
     */
    public function getEquipmentingItemCount()
    {
        return $this->count(self::EQUIPMENTING_ITEM);
    }

    /**
     * Appends value to 'having_item' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendHavingItem($value)
    {
        return $this->append(self::HAVING_ITEM, $value);
    }

    /**
     * Clears 'having_item' list
     *
     * @return null
     */
    public function clearHavingItem()
    {
        return $this->clear(self::HAVING_ITEM);
    }

    /**
     * Returns 'having_item' list
     *
     * @return integer[]
     */
    public function getHavingItem()
    {
        return $this->get(self::HAVING_ITEM);
    }

    /**
     * Returns true if 'having_item' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasHavingItem()
    {
        return count($this->get(self::HAVING_ITEM)) !== 0;
    }

    /**
     * Returns 'having_item' iterator
     *
     * @return \ArrayIterator
     */
    public function getHavingItemIterator()
    {
        return new \ArrayIterator($this->get(self::HAVING_ITEM));
    }

    /**
     * Returns element from 'having_item' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getHavingItemAt($offset)
    {
        return $this->get(self::HAVING_ITEM, $offset);
    }

    /**
     * Returns count of 'having_item' list
     *
     * @return int
     */
    public function getHavingItemCount()
    {
        return $this->count(self::HAVING_ITEM);
    }
}
}