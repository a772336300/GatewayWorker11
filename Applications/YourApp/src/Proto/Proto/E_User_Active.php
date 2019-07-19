<?php
/**
 * Auto generated from new.proto at 2019-07-19 16:12:55
 *
 * proto package
 */

namespace Proto {
/**
 * E_User_Active message
 */
class E_User_Active extends \ProtobufMessage
{
    /* Field index constants */
    const _ID = 1;
    const TITLE = 2;
    const CONTENT = 3;
    const START_TIME = 4;
    const END_TIME = 5;
    const ACTIVE_TYPE = 6;
    const SKIP_TYPE = 7;
    const SKIP_URL = 8;
    const IMG_URL = 9;
    const OPEN_TIME = 10;
    const CLOSE_TIME = 11;
    const AWARD_DES = 12;
    const TOTOAL_STEP = 13;
    const ATTACH = 14;
    const STEP = 15;
    const STATE = 16;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::_ID => array(
            'name' => '_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TITLE => array(
            'name' => 'title',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CONTENT => array(
            'name' => 'content',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::START_TIME => array(
            'name' => 'start_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::END_TIME => array(
            'name' => 'end_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ACTIVE_TYPE => array(
            'name' => 'active_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SKIP_TYPE => array(
            'name' => 'skip_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SKIP_URL => array(
            'name' => 'skip_url',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMG_URL => array(
            'name' => 'img_url',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OPEN_TIME => array(
            'name' => 'open_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CLOSE_TIME => array(
            'name' => 'close_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::AWARD_DES => array(
            'name' => 'award_des',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TOTOAL_STEP => array(
            'name' => 'totoal_step',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ATTACH => array(
            'name' => 'attach',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STEP => array(
            'name' => 'step',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STATE => array(
            'name' => 'state',
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
        $this->values[self::_ID] = null;
        $this->values[self::TITLE] = null;
        $this->values[self::CONTENT] = null;
        $this->values[self::START_TIME] = null;
        $this->values[self::END_TIME] = null;
        $this->values[self::ACTIVE_TYPE] = null;
        $this->values[self::SKIP_TYPE] = null;
        $this->values[self::SKIP_URL] = null;
        $this->values[self::IMG_URL] = null;
        $this->values[self::OPEN_TIME] = null;
        $this->values[self::CLOSE_TIME] = null;
        $this->values[self::AWARD_DES] = null;
        $this->values[self::TOTOAL_STEP] = null;
        $this->values[self::ATTACH] = array();
        $this->values[self::STEP] = null;
        $this->values[self::STATE] = null;
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
     * Sets value of '_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::_ID, $value);
    }

    /**
     * Returns value of '_id' property
     *
     * @return string
     */
    public function getId()
    {
        $value = $this->get(self::_ID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if '_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasId()
    {
        return $this->get(self::_ID) !== null;
    }

    /**
     * Sets value of 'title' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTitle($value)
    {
        return $this->set(self::TITLE, $value);
    }

    /**
     * Returns value of 'title' property
     *
     * @return string
     */
    public function getTitle()
    {
        $value = $this->get(self::TITLE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'title' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTitle()
    {
        return $this->get(self::TITLE) !== null;
    }

    /**
     * Sets value of 'content' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setContent($value)
    {
        return $this->set(self::CONTENT, $value);
    }

    /**
     * Returns value of 'content' property
     *
     * @return string
     */
    public function getContent()
    {
        $value = $this->get(self::CONTENT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'content' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasContent()
    {
        return $this->get(self::CONTENT) !== null;
    }

    /**
     * Sets value of 'start_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStartTime($value)
    {
        return $this->set(self::START_TIME, $value);
    }

    /**
     * Returns value of 'start_time' property
     *
     * @return integer
     */
    public function getStartTime()
    {
        $value = $this->get(self::START_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'start_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasStartTime()
    {
        return $this->get(self::START_TIME) !== null;
    }

    /**
     * Sets value of 'end_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEndTime($value)
    {
        return $this->set(self::END_TIME, $value);
    }

    /**
     * Returns value of 'end_time' property
     *
     * @return integer
     */
    public function getEndTime()
    {
        $value = $this->get(self::END_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'end_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEndTime()
    {
        return $this->get(self::END_TIME) !== null;
    }

    /**
     * Sets value of 'active_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setActiveType($value)
    {
        return $this->set(self::ACTIVE_TYPE, $value);
    }

    /**
     * Returns value of 'active_type' property
     *
     * @return integer
     */
    public function getActiveType()
    {
        $value = $this->get(self::ACTIVE_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'active_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasActiveType()
    {
        return $this->get(self::ACTIVE_TYPE) !== null;
    }

    /**
     * Sets value of 'skip_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSkipType($value)
    {
        return $this->set(self::SKIP_TYPE, $value);
    }

    /**
     * Returns value of 'skip_type' property
     *
     * @return integer
     */
    public function getSkipType()
    {
        $value = $this->get(self::SKIP_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'skip_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSkipType()
    {
        return $this->get(self::SKIP_TYPE) !== null;
    }

    /**
     * Sets value of 'skip_url' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSkipUrl($value)
    {
        return $this->set(self::SKIP_URL, $value);
    }

    /**
     * Returns value of 'skip_url' property
     *
     * @return string
     */
    public function getSkipUrl()
    {
        $value = $this->get(self::SKIP_URL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'skip_url' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSkipUrl()
    {
        return $this->get(self::SKIP_URL) !== null;
    }

    /**
     * Sets value of 'img_url' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImgUrl($value)
    {
        return $this->set(self::IMG_URL, $value);
    }

    /**
     * Returns value of 'img_url' property
     *
     * @return string
     */
    public function getImgUrl()
    {
        $value = $this->get(self::IMG_URL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'img_url' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasImgUrl()
    {
        return $this->get(self::IMG_URL) !== null;
    }

    /**
     * Sets value of 'open_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOpenTime($value)
    {
        return $this->set(self::OPEN_TIME, $value);
    }

    /**
     * Returns value of 'open_time' property
     *
     * @return string
     */
    public function getOpenTime()
    {
        $value = $this->get(self::OPEN_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'open_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOpenTime()
    {
        return $this->get(self::OPEN_TIME) !== null;
    }

    /**
     * Sets value of 'close_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCloseTime($value)
    {
        return $this->set(self::CLOSE_TIME, $value);
    }

    /**
     * Returns value of 'close_time' property
     *
     * @return string
     */
    public function getCloseTime()
    {
        $value = $this->get(self::CLOSE_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'close_time' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCloseTime()
    {
        return $this->get(self::CLOSE_TIME) !== null;
    }

    /**
     * Sets value of 'award_des' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAwardDes($value)
    {
        return $this->set(self::AWARD_DES, $value);
    }

    /**
     * Returns value of 'award_des' property
     *
     * @return string
     */
    public function getAwardDes()
    {
        $value = $this->get(self::AWARD_DES);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'award_des' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasAwardDes()
    {
        return $this->get(self::AWARD_DES) !== null;
    }

    /**
     * Sets value of 'totoal_step' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTotoalStep($value)
    {
        return $this->set(self::TOTOAL_STEP, $value);
    }

    /**
     * Returns value of 'totoal_step' property
     *
     * @return integer
     */
    public function getTotoalStep()
    {
        $value = $this->get(self::TOTOAL_STEP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'totoal_step' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTotoalStep()
    {
        return $this->get(self::TOTOAL_STEP) !== null;
    }

    /**
     * Appends value to 'attach' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendAttach($value)
    {
        return $this->append(self::ATTACH, $value);
    }

    /**
     * Clears 'attach' list
     *
     * @return null
     */
    public function clearAttach()
    {
        return $this->clear(self::ATTACH);
    }

    /**
     * Returns 'attach' list
     *
     * @return integer[]
     */
    public function getAttach()
    {
        return $this->get(self::ATTACH);
    }

    /**
     * Returns true if 'attach' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasAttach()
    {
        return count($this->get(self::ATTACH)) !== 0;
    }

    /**
     * Returns 'attach' iterator
     *
     * @return \ArrayIterator
     */
    public function getAttachIterator()
    {
        return new \ArrayIterator($this->get(self::ATTACH));
    }

    /**
     * Returns element from 'attach' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getAttachAt($offset)
    {
        return $this->get(self::ATTACH, $offset);
    }

    /**
     * Returns count of 'attach' list
     *
     * @return int
     */
    public function getAttachCount()
    {
        return $this->count(self::ATTACH);
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
     * Sets value of 'state' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setState($value)
    {
        return $this->set(self::STATE, $value);
    }

    /**
     * Returns value of 'state' property
     *
     * @return integer
     */
    public function getState()
    {
        $value = $this->get(self::STATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'state' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasState()
    {
        return $this->get(self::STATE) !== null;
    }
}
}