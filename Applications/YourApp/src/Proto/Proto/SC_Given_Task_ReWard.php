<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Given_Task_ReWard message
 */
class SC_Given_Task_ReWard extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_REWARD_RESULT = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_REWARD_RESULT => array(
            'name' => 'task_reward_result',
            'repeated' => true,
            'type' => '\Proto\Task_Reward_Result'
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
        $this->values[self::TASK_REWARD_RESULT] = array();
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
     * Appends value to 'task_reward_result' list
     *
     * @param \Proto\Task_Reward_Result $value Value to append
     *
     * @return null
     */
    public function appendTaskRewardResult(\Proto\Task_Reward_Result $value)
    {
        return $this->append(self::TASK_REWARD_RESULT, $value);
    }

    /**
     * Clears 'task_reward_result' list
     *
     * @return null
     */
    public function clearTaskRewardResult()
    {
        return $this->clear(self::TASK_REWARD_RESULT);
    }

    /**
     * Returns 'task_reward_result' list
     *
     * @return \Proto\Task_Reward_Result[]
     */
    public function getTaskRewardResult()
    {
        return $this->get(self::TASK_REWARD_RESULT);
    }

    /**
     * Returns true if 'task_reward_result' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskRewardResult()
    {
        return count($this->get(self::TASK_REWARD_RESULT)) !== 0;
    }

    /**
     * Returns 'task_reward_result' iterator
     *
     * @return \ArrayIterator
     */
    public function getTaskRewardResultIterator()
    {
        return new \ArrayIterator($this->get(self::TASK_REWARD_RESULT));
    }

    /**
     * Returns element from 'task_reward_result' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\Task_Reward_Result
     */
    public function getTaskRewardResultAt($offset)
    {
        return $this->get(self::TASK_REWARD_RESULT, $offset);
    }

    /**
     * Returns count of 'task_reward_result' list
     *
     * @return int
     */
    public function getTaskRewardResultCount()
    {
        return $this->count(self::TASK_REWARD_RESULT);
    }
}
}