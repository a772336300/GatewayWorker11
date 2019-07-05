<?php
/**
 * Auto generated from new.proto at 2019-07-04 15:19:44
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Use_Equip_Result message
 */
class SC_User_Use_Equip_Result extends \ProtobufMessage
{
    /* Field index constants */
    const EQUIP_ITEMID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::EQUIP_ITEMID => array(
            'name' => 'equip_itemid',
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
        $this->values[self::EQUIP_ITEMID] = array();
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
     * Appends value to 'equip_itemid' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendEquipItemid($value)
    {
        return $this->append(self::EQUIP_ITEMID, $value);
    }

    /**
     * Clears 'equip_itemid' list
     *
     * @return null
     */
    public function clearEquipItemid()
    {
        return $this->clear(self::EQUIP_ITEMID);
    }

    /**
     * Returns 'equip_itemid' list
     *
     * @return integer[]
     */
    public function getEquipItemid()
    {
        return $this->get(self::EQUIP_ITEMID);
    }

    /**
     * Returns true if 'equip_itemid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEquipItemid()
    {
        return count($this->get(self::EQUIP_ITEMID)) !== 0;
    }

    /**
     * Returns 'equip_itemid' iterator
     *
     * @return \ArrayIterator
     */
    public function getEquipItemidIterator()
    {
        return new \ArrayIterator($this->get(self::EQUIP_ITEMID));
    }

    /**
     * Returns element from 'equip_itemid' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getEquipItemidAt($offset)
    {
        return $this->get(self::EQUIP_ITEMID, $offset);
    }

    /**
     * Returns count of 'equip_itemid' list
     *
     * @return int
     */
    public function getEquipItemidCount()
    {
        return $this->count(self::EQUIP_ITEMID);
    }
}
}