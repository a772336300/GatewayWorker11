<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * E_User_mail message
 */
class E_User_mail extends \ProtobufMessage
{
    /* Field index constants */
    const _ID = 1;
    const SID = 2;
    const TITLE = 3;
    const CONTENT = 4;
    const START_TIME = 5;
    const END_TIME = 6;
    const ATTACH = 7;
    const ISREAD = 8;
    const ISDELETE = 9;
    const GET_ATTACH = 10;
    const UID = 11;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::_ID => array(
            'name' => '_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::SID => array(
            'name' => 'sid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        self::ATTACH => array(
            'name' => 'attach',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ISREAD => array(
            'name' => 'isread',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ISDELETE => array(
            'name' => 'isdelete',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::GET_ATTACH => array(
            'name' => 'get_attach',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::_ID] = null;
        $this->values[self::SID] = null;
        $this->values[self::TITLE] = null;
        $this->values[self::CONTENT] = null;
        $this->values[self::START_TIME] = null;
        $this->values[self::END_TIME] = null;
        $this->values[self::ATTACH] = array();
        $this->values[self::ISREAD] = null;
        $this->values[self::ISDELETE] = null;
        $this->values[self::GET_ATTACH] = null;
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
     * Sets value of 'sid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSid($value)
    {
        return $this->set(self::SID, $value);
    }

    /**
     * Returns value of 'sid' property
     *
     * @return integer
     */
    public function getSid()
    {
        $value = $this->get(self::SID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'sid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSid()
    {
        return $this->get(self::SID) !== null;
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
     * Sets value of 'isread' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIsread($value)
    {
        return $this->set(self::ISREAD, $value);
    }

    /**
     * Returns value of 'isread' property
     *
     * @return integer
     */
    public function getIsread()
    {
        $value = $this->get(self::ISREAD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'isread' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIsread()
    {
        return $this->get(self::ISREAD) !== null;
    }

    /**
     * Sets value of 'isdelete' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsdelete($value)
    {
        return $this->set(self::ISDELETE, $value);
    }

    /**
     * Returns value of 'isdelete' property
     *
     * @return boolean
     */
    public function getIsdelete()
    {
        $value = $this->get(self::ISDELETE);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'isdelete' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIsdelete()
    {
        return $this->get(self::ISDELETE) !== null;
    }

    /**
     * Sets value of 'get_attach' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setGetAttach($value)
    {
        return $this->set(self::GET_ATTACH, $value);
    }

    /**
     * Returns value of 'get_attach' property
     *
     * @return boolean
     */
    public function getGetAttach()
    {
        $value = $this->get(self::GET_ATTACH);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'get_attach' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGetAttach()
    {
        return $this->get(self::GET_ATTACH) !== null;
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