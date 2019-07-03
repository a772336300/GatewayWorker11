<?php
/**
 * Auto generated from new.proto at 2019-07-03 17:23:45
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Get_Task_ReWard message
 */
class CS_Get_Task_ReWard extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_ID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_ID => array(
            'name' => 'Task_id',
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
        $this->values[self::TASK_ID] = array();
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
     * Appends value to 'Task_id' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendTaskId($value)
    {
        return $this->append(self::TASK_ID, $value);
    }

    /**
     * Clears 'Task_id' list
     *
     * @return null
     */
    public function clearTaskId()
    {
        return $this->clear(self::TASK_ID);
    }

    /**
     * Returns 'Task_id' list
     *
     * @return integer[]
     */
    public function getTaskId()
    {
        return $this->get(self::TASK_ID);
    }

    /**
     * Returns true if 'Task_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskId()
    {
        return count($this->get(self::TASK_ID)) !== 0;
    }

    /**
     * Returns 'Task_id' iterator
     *
     * @return \ArrayIterator
     */
    public function getTaskIdIterator()
    {
        return new \ArrayIterator($this->get(self::TASK_ID));
    }

    /**
     * Returns element from 'Task_id' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getTaskIdAt($offset)
    {
        return $this->get(self::TASK_ID, $offset);
    }

    /**
     * Returns count of 'Task_id' list
     *
     * @return int
     */
    public function getTaskIdCount()
    {
        return $this->count(self::TASK_ID);
    }
}
}