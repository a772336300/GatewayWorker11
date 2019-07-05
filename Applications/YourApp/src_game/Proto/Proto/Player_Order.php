<?php
/**
 * Auto generated from doudizhu.proto at 2019-07-05 15:09:44
 *
 * proto package
 */

namespace Proto {
/**
 * Player_Order message
 */
class Player_Order extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
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
        $this->values[self::ID] = array();
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
     * Appends value to 'id' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendId($value)
    {
        return $this->append(self::ID, $value);
    }

    /**
     * Clears 'id' list
     *
     * @return null
     */
    public function clearId()
    {
        return $this->clear(self::ID);
    }

    /**
     * Returns 'id' list
     *
     * @return integer[]
     */
    public function getId()
    {
        return $this->get(self::ID);
    }

    /**
     * Returns true if 'id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return count($this->get(self::ID)) !== 0;
    }

    /**
     * Returns 'id' iterator
     *
     * @return \ArrayIterator
     */
    public function getIdIterator()
    {
        return new \ArrayIterator($this->get(self::ID));
    }

    /**
     * Returns element from 'id' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getIdAt($offset)
    {
        return $this->get(self::ID, $offset);
    }

    /**
     * Returns count of 'id' list
     *
     * @return int
     */
    public function getIdCount()
    {
        return $this->count(self::ID);
    }
}
}