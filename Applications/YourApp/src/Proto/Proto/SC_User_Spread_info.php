<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Spread_info message
 */
class SC_User_Spread_info extends \ProtobufMessage
{
    /* Field index constants */
    const INVITED_CODE = 1;
    const AGENT_ID = 2;
    const SPREAD_INFO = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INVITED_CODE => array(
            'name' => 'invited_code',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::AGENT_ID => array(
            'name' => 'agent_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SPREAD_INFO => array(
            'name' => 'spread_info',
            'repeated' => true,
            'type' => '\Proto\E_Spread_Info'
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
        $this->values[self::INVITED_CODE] = null;
        $this->values[self::AGENT_ID] = null;
        $this->values[self::SPREAD_INFO] = array();
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
     * Sets value of 'invited_code' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setInvitedCode($value)
    {
        return $this->set(self::INVITED_CODE, $value);
    }

    /**
     * Returns value of 'invited_code' property
     *
     * @return integer
     */
    public function getInvitedCode()
    {
        $value = $this->get(self::INVITED_CODE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'invited_code' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasInvitedCode()
    {
        return $this->get(self::INVITED_CODE) !== null;
    }

    /**
     * Sets value of 'agent_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAgentId($value)
    {
        return $this->set(self::AGENT_ID, $value);
    }

    /**
     * Returns value of 'agent_id' property
     *
     * @return integer
     */
    public function getAgentId()
    {
        $value = $this->get(self::AGENT_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'agent_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasAgentId()
    {
        return $this->get(self::AGENT_ID) !== null;
    }

    /**
     * Appends value to 'spread_info' list
     *
     * @param \Proto\E_Spread_Info $value Value to append
     *
     * @return null
     */
    public function appendSpreadInfo(\Proto\E_Spread_Info $value)
    {
        return $this->append(self::SPREAD_INFO, $value);
    }

    /**
     * Clears 'spread_info' list
     *
     * @return null
     */
    public function clearSpreadInfo()
    {
        return $this->clear(self::SPREAD_INFO);
    }

    /**
     * Returns 'spread_info' list
     *
     * @return \Proto\E_Spread_Info[]
     */
    public function getSpreadInfo()
    {
        return $this->get(self::SPREAD_INFO);
    }

    /**
     * Returns true if 'spread_info' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSpreadInfo()
    {
        return count($this->get(self::SPREAD_INFO)) !== 0;
    }

    /**
     * Returns 'spread_info' iterator
     *
     * @return \ArrayIterator
     */
    public function getSpreadInfoIterator()
    {
        return new \ArrayIterator($this->get(self::SPREAD_INFO));
    }

    /**
     * Returns element from 'spread_info' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Spread_Info
     */
    public function getSpreadInfoAt($offset)
    {
        return $this->get(self::SPREAD_INFO, $offset);
    }

    /**
     * Returns count of 'spread_info' list
     *
     * @return int
     */
    public function getSpreadInfoCount()
    {
        return $this->count(self::SPREAD_INFO);
    }
}
}