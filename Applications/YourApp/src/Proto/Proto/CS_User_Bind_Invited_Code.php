<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:31
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Bind_Invited_Code message
 */
class CS_User_Bind_Invited_Code extends \ProtobufMessage
{
    /* Field index constants */
    const AGENT_ID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::AGENT_ID => array(
            'name' => 'agent_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::AGENT_ID] = null;
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
     * Sets value of 'agent_id' property
     *
     * @param string $value Property value
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
     * @return string
     */
    public function getAgentId()
    {
        $value = $this->get(self::AGENT_ID);
        return $value === null ? (string)$value : $value;
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
}
}