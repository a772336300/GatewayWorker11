<?php
/**
 * Auto generated from new.proto at 2019-07-30 16:58:53
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Get_Task_Award message
 */
class CS_User_Get_Task_Award extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_ID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_ID => array(
            'name' => 'task_id',
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
        $this->values[self::TASK_ID] = null;
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
     * Sets value of 'task_id' property
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
     * Returns value of 'task_id' property
     *
     * @return integer
     */
    public function getTaskId()
    {
        $value = $this->get(self::TASK_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'task_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskId()
    {
        return $this->get(self::TASK_ID) !== null;
    }
}
}