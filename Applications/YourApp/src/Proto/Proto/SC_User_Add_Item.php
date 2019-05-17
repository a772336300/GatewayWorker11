<?php
/**
 * Auto generated from new.proto at 2019-05-17 11:04:22
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Add_Item message
 */
class SC_User_Add_Item extends \ProtobufMessage
{
    /* Field index constants */
    const ITEMID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ITEMID => array(
            'name' => 'itemid',
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
        $this->values[self::ITEMID] = array();
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
     * Appends value to 'itemid' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendItemid($value)
    {
        return $this->append(self::ITEMID, $value);
    }

    /**
     * Clears 'itemid' list
     *
     * @return null
     */
    public function clearItemid()
    {
        return $this->clear(self::ITEMID);
    }

    /**
     * Returns 'itemid' list
     *
     * @return integer[]
     */
    public function getItemid()
    {
        return $this->get(self::ITEMID);
    }

    /**
     * Returns true if 'itemid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasItemid()
    {
        return count($this->get(self::ITEMID)) !== 0;
    }

    /**
     * Returns 'itemid' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemidIterator()
    {
        return new \ArrayIterator($this->get(self::ITEMID));
    }

    /**
     * Returns element from 'itemid' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getItemidAt($offset)
    {
        return $this->get(self::ITEMID, $offset);
    }

    /**
     * Returns count of 'itemid' list
     *
     * @return int
     */
    public function getItemidCount()
    {
        return $this->count(self::ITEMID);
    }
}
}