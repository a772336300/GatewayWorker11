<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:41
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Get_Password message
 */
class CS_Get_Password extends \ProtobufMessage
{
    /* Field index constants */
    const PHONE = 1;
    const CHANNEL_ID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PHONE => array(
            'name' => 'phone',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANNEL_ID => array(
            'name' => 'channel_id',
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
        $this->values[self::PHONE] = null;
        $this->values[self::CHANNEL_ID] = null;
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
     * Sets value of 'phone' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhone($value)
    {
        return $this->set(self::PHONE, $value);
    }

    /**
     * Returns value of 'phone' property
     *
     * @return string
     */
    public function getPhone()
    {
        $value = $this->get(self::PHONE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'phone' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhone()
    {
        return $this->get(self::PHONE) !== null;
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
}
}