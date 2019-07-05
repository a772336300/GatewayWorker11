<?php
/**
 * Auto generated from new.proto at 2019-07-04 15:19:45
 *
 * proto package
 */

namespace Proto {
/**
 * Task_Reward_Result message
 */
class Task_Reward_Result extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_ID = 1;
    const IS_SUCCESS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_ID => array(
            'name' => 'Task_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::IS_SUCCESS => array(
            'name' => 'is_success',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::TASK_ID] = null;
        $this->values[self::IS_SUCCESS] = null;
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
     * Sets value of 'Task_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskId($value)
    {
        return $this->set(self::TASK_ID, $value);
    }

    /**
     * Returns value of 'Task_id' property
     *
     * @return integer
     */
    public function getTaskId()
    {
        $value = $this->get(self::TASK_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Task_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskId()
    {
        return $this->get(self::TASK_ID) !== null;
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
}
}