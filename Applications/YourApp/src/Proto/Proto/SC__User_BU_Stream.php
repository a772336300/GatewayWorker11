<?php
/**
 * Auto generated from new.proto at 2019-07-30 16:58:52
 *
 * proto package
 */

namespace Proto {
/**
 * SC__User_BU_Stream message
 */
class SC__User_BU_Stream extends \ProtobufMessage
{
    /* Field index constants */
    const IS_SUCCESS = 1;
    const ITEM = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::IS_SUCCESS => array(
            'name' => 'is_success',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::ITEM => array(
            'name' => 'item',
            'repeated' => true,
            'type' => '\Proto\User_BU_Stream_Item'
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
        $this->values[self::ITEM] = array();
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
     * Appends value to 'item' list
     *
     * @param \Proto\User_BU_Stream_Item $value Value to append
     *
     * @return null
     */
    public function appendItem(\Proto\User_BU_Stream_Item $value)
    {
        return $this->append(self::ITEM, $value);
    }

    /**
     * Clears 'item' list
     *
     * @return null
     */
    public function clearItem()
    {
        return $this->clear(self::ITEM);
    }

    /**
     * Returns 'item' list
     *
     * @return \Proto\User_BU_Stream_Item[]
     */
    public function getItem()
    {
        return $this->get(self::ITEM);
    }

    /**
     * Returns true if 'item' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasItem()
    {
        return count($this->get(self::ITEM)) !== 0;
    }

    /**
     * Returns 'item' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemIterator()
    {
        return new \ArrayIterator($this->get(self::ITEM));
    }

    /**
     * Returns element from 'item' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\User_BU_Stream_Item
     */
    public function getItemAt($offset)
    {
        return $this->get(self::ITEM, $offset);
    }

    /**
     * Returns count of 'item' list
     *
     * @return int
     */
    public function getItemCount()
    {
        return $this->count(self::ITEM);
    }
}
}