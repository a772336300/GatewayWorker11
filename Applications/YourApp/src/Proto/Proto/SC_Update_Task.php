<?php
/**
 * Auto generated from new.proto at 2019-07-03 17:23:45
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Update_Task message
 */
class SC_Update_Task extends \ProtobufMessage
{
    /* Field index constants */
    const TASK = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK => array(
            'name' => 'Task',
            'repeated' => true,
            'type' => '\Proto\E_Task_Info'
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
        $this->values[self::TASK] = array();
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
     * Appends value to 'Task' list
     *
     * @param \Proto\E_Task_Info $value Value to append
     *
     * @return null
     */
    public function appendTask(\Proto\E_Task_Info $value)
    {
        return $this->append(self::TASK, $value);
    }

    /**
     * Clears 'Task' list
     *
     * @return null
     */
    public function clearTask()
    {
        return $this->clear(self::TASK);
    }

    /**
     * Returns 'Task' list
     *
     * @return \Proto\E_Task_Info[]
     */
    public function getTask()
    {
        return $this->get(self::TASK);
    }

    /**
     * Returns true if 'Task' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTask()
    {
        return count($this->get(self::TASK)) !== 0;
    }

    /**
     * Returns 'Task' iterator
     *
     * @return \ArrayIterator
     */
    public function getTaskIterator()
    {
        return new \ArrayIterator($this->get(self::TASK));
    }

    /**
     * Returns element from 'Task' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Task_Info
     */
    public function getTaskAt($offset)
    {
        return $this->get(self::TASK, $offset);
    }

    /**
     * Returns count of 'Task' list
     *
     * @return int
     */
    public function getTaskCount()
    {
        return $this->count(self::TASK);
    }
}
}