<?php
/**
 * Auto generated from new.proto at 2019-09-19 10:53:53
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Game_Over_Score message
 */
class CS_Game_Over_Score extends \ProtobufMessage
{
    /* Field index constants */
    const VALUE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::VALUE => array(
            'name' => 'value',
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
        $this->values[self::VALUE] = array();
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
     * Appends value to 'value' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendValue($value)
    {
        return $this->append(self::VALUE, $value);
    }

    /**
     * Clears 'value' list
     *
     * @return null
     */
    public function clearValue()
    {
        return $this->clear(self::VALUE);
    }

    /**
     * Returns 'value' list
     *
     * @return integer[]
     */
    public function getValue()
    {
        return $this->get(self::VALUE);
    }

    /**
     * Returns true if 'value' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue()
    {
        return count($this->get(self::VALUE)) !== 0;
    }

    /**
     * Returns 'value' iterator
     *
     * @return \ArrayIterator
     */
    public function getValueIterator()
    {
        return new \ArrayIterator($this->get(self::VALUE));
    }

    /**
     * Returns element from 'value' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getValueAt($offset)
    {
        return $this->get(self::VALUE, $offset);
    }

    /**
     * Returns count of 'value' list
     *
     * @return int
     */
    public function getValueCount()
    {
        return $this->count(self::VALUE);
    }
}
}