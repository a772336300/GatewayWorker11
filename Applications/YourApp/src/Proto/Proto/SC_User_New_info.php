<?php
/**
 * Auto generated from new.proto at 2019-07-15 14:47:40
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_New_info message
 */
class SC_User_New_info extends \ProtobufMessage
{
    /* Field index constants */
    const MODULE_ID = 1;
    const _ID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MODULE_ID => array(
            'name' => 'module_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::_ID => array(
            'name' => '_id',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::MODULE_ID] = null;
        $this->values[self::_ID] = array();
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
     * Sets value of 'module_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setModuleId($value)
    {
        return $this->set(self::MODULE_ID, $value);
    }

    /**
     * Returns value of 'module_id' property
     *
     * @return integer
     */
    public function getModuleId()
    {
        $value = $this->get(self::MODULE_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'module_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasModuleId()
    {
        return $this->get(self::MODULE_ID) !== null;
    }

    /**
     * Appends value to '_id' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendId($value)
    {
        return $this->append(self::_ID, $value);
    }

    /**
     * Clears '_id' list
     *
     * @return null
     */
    public function clearId()
    {
        return $this->clear(self::_ID);
    }

    /**
     * Returns '_id' list
     *
     * @return string[]
     */
    public function getId()
    {
        return $this->get(self::_ID);
    }

    /**
     * Returns true if '_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return count($this->get(self::_ID)) !== 0;
    }

    /**
     * Returns '_id' iterator
     *
     * @return \ArrayIterator
     */
    public function getIdIterator()
    {
        return new \ArrayIterator($this->get(self::_ID));
    }

    /**
     * Returns element from '_id' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getIdAt($offset)
    {
        return $this->get(self::_ID, $offset);
    }

    /**
     * Returns count of '_id' list
     *
     * @return int
     */
    public function getIdCount()
    {
        return $this->count(self::_ID);
    }
}
}