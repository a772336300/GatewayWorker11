<?php
/**
 * Auto generated from new.proto at 2019-07-04 15:19:44
 *
 * proto package
 */

namespace Proto {
/**
 * E_Task_Info message
 */
class E_Task_Info extends \ProtobufMessage
{
    /* Field index constants */
    const TASK_ID = 1;
    const TASK_NAME = 2;
    const TASK_CONTENT = 3;
    const CHANNEL_ID = 4;
    const TASK_PARAM_TYPE = 5;
    const TASK_SKIP_TYPE = 6;
    const SKIP = 7;
    const TASK_PRE = 8;
    const ARCH_TASK = 9;
    const U_COIN = 10;
    const GOLD_COIN = 11;
    const PROP_ID = 12;
    const SCRIPT_ID = 13;
    const TASK_STATE = 14;
    const STEP = 15;
    const STEP_DONE = 16;
    const ID = 17;
    const POWER_POINT = 18;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASK_ID => array(
            'name' => 'Task_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TASK_NAME => array(
            'name' => 'Task_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TASK_CONTENT => array(
            'name' => 'Task_content',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANNEL_ID => array(
            'name' => 'channel_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TASK_PARAM_TYPE => array(
            'name' => 'Task_param_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TASK_SKIP_TYPE => array(
            'name' => 'Task_skip_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SKIP => array(
            'name' => 'skip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TASK_PRE => array(
            'name' => 'Task_pre',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ARCH_TASK => array(
            'name' => 'arch_task',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::U_COIN => array(
            'name' => 'u_coin',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_COIN => array(
            'name' => 'gold_coin',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PROP_ID => array(
            'name' => 'prop_id',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCRIPT_ID => array(
            'name' => 'script_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TASK_STATE => array(
            'name' => 'Task_state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STEP => array(
            'name' => 'step',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STEP_DONE => array(
            'name' => 'step_done',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POWER_POINT => array(
            'name' => 'power_point',
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
        $this->values[self::TASK_NAME] = null;
        $this->values[self::TASK_CONTENT] = null;
        $this->values[self::CHANNEL_ID] = null;
        $this->values[self::TASK_PARAM_TYPE] = null;
        $this->values[self::TASK_SKIP_TYPE] = null;
        $this->values[self::SKIP] = null;
        $this->values[self::TASK_PRE] = null;
        $this->values[self::ARCH_TASK] = null;
        $this->values[self::U_COIN] = null;
        $this->values[self::GOLD_COIN] = null;
        $this->values[self::PROP_ID] = array();
        $this->values[self::SCRIPT_ID] = null;
        $this->values[self::TASK_STATE] = null;
        $this->values[self::STEP] = null;
        $this->values[self::STEP_DONE] = null;
        $this->values[self::ID] = null;
        $this->values[self::POWER_POINT] = null;
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
     * Sets value of 'Task_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTaskName($value)
    {
        return $this->set(self::TASK_NAME, $value);
    }

    /**
     * Returns value of 'Task_name' property
     *
     * @return string
     */
    public function getTaskName()
    {
        $value = $this->get(self::TASK_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'Task_name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskName()
    {
        return $this->get(self::TASK_NAME) !== null;
    }

    /**
     * Sets value of 'Task_content' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTaskContent($value)
    {
        return $this->set(self::TASK_CONTENT, $value);
    }

    /**
     * Returns value of 'Task_content' property
     *
     * @return string
     */
    public function getTaskContent()
    {
        $value = $this->get(self::TASK_CONTENT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'Task_content' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskContent()
    {
        return $this->get(self::TASK_CONTENT) !== null;
    }

    /**
     * Sets value of 'channel_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setChannelId($value)
    {
        return $this->set(self::CHANNEL_ID, $value);
    }

    /**
     * Returns value of 'channel_id' property
     *
     * @return integer
     */
    public function getChannelId()
    {
        $value = $this->get(self::CHANNEL_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'channel_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasChannelId()
    {
        return $this->get(self::CHANNEL_ID) !== null;
    }

    /**
     * Sets value of 'Task_param_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskParamType($value)
    {
        return $this->set(self::TASK_PARAM_TYPE, $value);
    }

    /**
     * Returns value of 'Task_param_type' property
     *
     * @return integer
     */
    public function getTaskParamType()
    {
        $value = $this->get(self::TASK_PARAM_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Task_param_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskParamType()
    {
        return $this->get(self::TASK_PARAM_TYPE) !== null;
    }

    /**
     * Sets value of 'Task_skip_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskSkipType($value)
    {
        return $this->set(self::TASK_SKIP_TYPE, $value);
    }

    /**
     * Returns value of 'Task_skip_type' property
     *
     * @return integer
     */
    public function getTaskSkipType()
    {
        $value = $this->get(self::TASK_SKIP_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Task_skip_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskSkipType()
    {
        return $this->get(self::TASK_SKIP_TYPE) !== null;
    }

    /**
     * Sets value of 'skip' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSkip($value)
    {
        return $this->set(self::SKIP, $value);
    }

    /**
     * Returns value of 'skip' property
     *
     * @return string
     */
    public function getSkip()
    {
        $value = $this->get(self::SKIP);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'skip' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSkip()
    {
        return $this->get(self::SKIP) !== null;
    }

    /**
     * Sets value of 'Task_pre' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTaskPre($value)
    {
        return $this->set(self::TASK_PRE, $value);
    }

    /**
     * Returns value of 'Task_pre' property
     *
     * @return string
     */
    public function getTaskPre()
    {
        $value = $this->get(self::TASK_PRE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'Task_pre' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskPre()
    {
        return $this->get(self::TASK_PRE) !== null;
    }

    /**
     * Sets value of 'arch_task' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setArchTask($value)
    {
        return $this->set(self::ARCH_TASK, $value);
    }

    /**
     * Returns value of 'arch_task' property
     *
     * @return string
     */
    public function getArchTask()
    {
        $value = $this->get(self::ARCH_TASK);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'arch_task' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasArchTask()
    {
        return $this->get(self::ARCH_TASK) !== null;
    }

    /**
     * Sets value of 'u_coin' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUCoin($value)
    {
        return $this->set(self::U_COIN, $value);
    }

    /**
     * Returns value of 'u_coin' property
     *
     * @return integer
     */
    public function getUCoin()
    {
        $value = $this->get(self::U_COIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'u_coin' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUCoin()
    {
        return $this->get(self::U_COIN) !== null;
    }

    /**
     * Sets value of 'gold_coin' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldCoin($value)
    {
        return $this->set(self::GOLD_COIN, $value);
    }

    /**
     * Returns value of 'gold_coin' property
     *
     * @return integer
     */
    public function getGoldCoin()
    {
        $value = $this->get(self::GOLD_COIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gold_coin' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGoldCoin()
    {
        return $this->get(self::GOLD_COIN) !== null;
    }

    /**
     * Appends value to 'prop_id' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendPropId($value)
    {
        return $this->append(self::PROP_ID, $value);
    }

    /**
     * Clears 'prop_id' list
     *
     * @return null
     */
    public function clearPropId()
    {
        return $this->clear(self::PROP_ID);
    }

    /**
     * Returns 'prop_id' list
     *
     * @return integer[]
     */
    public function getPropId()
    {
        return $this->get(self::PROP_ID);
    }

    /**
     * Returns true if 'prop_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPropId()
    {
        return count($this->get(self::PROP_ID)) !== 0;
    }

    /**
     * Returns 'prop_id' iterator
     *
     * @return \ArrayIterator
     */
    public function getPropIdIterator()
    {
        return new \ArrayIterator($this->get(self::PROP_ID));
    }

    /**
     * Returns element from 'prop_id' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getPropIdAt($offset)
    {
        return $this->get(self::PROP_ID, $offset);
    }

    /**
     * Returns count of 'prop_id' list
     *
     * @return int
     */
    public function getPropIdCount()
    {
        return $this->count(self::PROP_ID);
    }

    /**
     * Sets value of 'script_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScriptId($value)
    {
        return $this->set(self::SCRIPT_ID, $value);
    }

    /**
     * Returns value of 'script_id' property
     *
     * @return integer
     */
    public function getScriptId()
    {
        $value = $this->get(self::SCRIPT_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'script_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasScriptId()
    {
        return $this->get(self::SCRIPT_ID) !== null;
    }

    /**
     * Sets value of 'Task_state' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskState($value)
    {
        return $this->set(self::TASK_STATE, $value);
    }

    /**
     * Returns value of 'Task_state' property
     *
     * @return integer
     */
    public function getTaskState()
    {
        $value = $this->get(self::TASK_STATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'Task_state' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTaskState()
    {
        return $this->get(self::TASK_STATE) !== null;
    }

    /**
     * Sets value of 'step' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStep($value)
    {
        return $this->set(self::STEP, $value);
    }

    /**
     * Returns value of 'step' property
     *
     * @return integer
     */
    public function getStep()
    {
        $value = $this->get(self::STEP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'step' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasStep()
    {
        return $this->get(self::STEP) !== null;
    }

    /**
     * Sets value of 'step_done' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStepDone($value)
    {
        return $this->set(self::STEP_DONE, $value);
    }

    /**
     * Returns value of 'step_done' property
     *
     * @return integer
     */
    public function getStepDone()
    {
        $value = $this->get(self::STEP_DONE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'step_done' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasStepDone()
    {
        return $this->get(self::STEP_DONE) !== null;
    }

    /**
     * Sets value of 'id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::ID, $value);
    }

    /**
     * Returns value of 'id' property
     *
     * @return integer
     */
    public function getId()
    {
        $value = $this->get(self::ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return $this->get(self::ID) !== null;
    }

    /**
     * Sets value of 'power_point' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPowerPoint($value)
    {
        return $this->set(self::POWER_POINT, $value);
    }

    /**
     * Returns value of 'power_point' property
     *
     * @return integer
     */
    public function getPowerPoint()
    {
        $value = $this->get(self::POWER_POINT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'power_point' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPowerPoint()
    {
        return $this->get(self::POWER_POINT) !== null;
    }
}
}