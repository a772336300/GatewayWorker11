<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-02 10:55:55
 *
 * proto package
 */

namespace Proto {
/**
 * SC_ComPetition_Group message
 */
class SC_ComPetition_Group extends \ProtobufMessage
{
    /* Field index constants */
    const GROUP = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GROUP => array(
            'name' => 'group',
            'repeated' => true,
            'type' => '\Proto\ComPetition'
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
        $this->values[self::GROUP] = array();
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
     * Appends value to 'group' list
     *
     * @param \Proto\ComPetition $value Value to append
     *
     * @return null
     */
    public function appendGroup(\Proto\ComPetition $value)
    {
        return $this->append(self::GROUP, $value);
    }

    /**
     * Clears 'group' list
     *
     * @return null
     */
    public function clearGroup()
    {
        return $this->clear(self::GROUP);
    }

    /**
     * Returns 'group' list
     *
     * @return \Proto\ComPetition[]
     */
    public function getGroup()
    {
        return $this->get(self::GROUP);
    }

    /**
     * Returns true if 'group' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGroup()
    {
        return count($this->get(self::GROUP)) !== 0;
    }

    /**
     * Returns 'group' iterator
     *
     * @return \ArrayIterator
     */
    public function getGroupIterator()
    {
        return new \ArrayIterator($this->get(self::GROUP));
    }

    /**
     * Returns element from 'group' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\ComPetition
     */
    public function getGroupAt($offset)
    {
        return $this->get(self::GROUP, $offset);
    }

    /**
     * Returns count of 'group' list
     *
     * @return int
     */
    public function getGroupCount()
    {
        return $this->count(self::GROUP);
    }
}
}