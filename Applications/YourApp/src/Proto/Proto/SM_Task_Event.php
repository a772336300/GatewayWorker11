<?php
/**
 * Auto generated from task.proto at 2019-05-14 16:23:00
 *
 * proto package
 */

namespace Proto {
/**
 * SM_Task_Event message
 */
class SM_Task_Event extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_TYPE = 1;
    const HANDLER = 2;
    const REMARK = 3;
    const UID = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_TYPE => array(
            'name' => 'task_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HANDLER => array(
            'name' => 'handler',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::REMARK => array(
            'name' => 'remark',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::UID => array(
            'name' => 'uid',
            'required' => false,
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
        $this->values[self::TASK_TYPE] = null;
        $this->values[self::HANDLER] = array();
        $this->values[self::REMARK] = null;
        $this->values[self::UID] = null;
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
     * Sets value of 'task_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskType($value)
    {
        return $this->set(self::TASK_TYPE, $value);
    }

    /**
     * Returns value of 'task_type' property
     *
     * @return integer
     */
    public function getTaskType()
    {
        $value = $this->get(self::TASK_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'task_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskType()
    {
        return $this->get(self::TASK_TYPE) !== null;
    }

    /**
     * Appends value to 'handler' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendHandler($value)
    {
        return $this->append(self::HANDLER, $value);
    }

    /**
     * Clears 'handler' list
     *
     * @return null
     */
    public function clearHandler()
    {
        return $this->clear(self::HANDLER);
    }

    /**
     * Returns 'handler' list
     *
     * @return integer[]
     */
    public function getHandler()
    {
        return $this->get(self::HANDLER);
    }

    /**
     * Returns true if 'handler' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasHandler()
    {
        return count($this->get(self::HANDLER)) !== 0;
    }

    /**
     * Returns 'handler' iterator
     *
     * @return \ArrayIterator
     */
    public function getHandlerIterator()
    {
        return new \ArrayIterator($this->get(self::HANDLER));
    }

    /**
     * Returns element from 'handler' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getHandlerAt($offset)
    {
        return $this->get(self::HANDLER, $offset);
    }

    /**
     * Returns count of 'handler' list
     *
     * @return int
     */
    public function getHandlerCount()
    {
        return $this->count(self::HANDLER);
    }

    /**
     * Sets value of 'remark' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRemark($value)
    {
        return $this->set(self::REMARK, $value);
    }

    /**
     * Returns value of 'remark' property
     *
     * @return string
     */
    public function getRemark()
    {
        $value = $this->get(self::REMARK);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'remark' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRemark()
    {
        return $this->get(self::REMARK) !== null;
    }

    /**
     * Sets value of 'uid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUid($value)
    {
        return $this->set(self::UID, $value);
    }

    /**
     * Returns value of 'uid' property
     *
     * @return integer
     */
    public function getUid()
    {
        $value = $this->get(self::UID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'uid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUid()
    {
        return $this->get(self::UID) !== null;
    }
}
}