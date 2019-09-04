<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 16:57:37
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Play message
 */
class CS_Play extends \ProtobufMessage
{
    /* Field index constants */
    const PLAY_DATA = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAY_DATA => array(
            'name' => 'play_data',
            'required' => false,
            'type' => '\Proto\Play_Data'
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
        $this->values[self::PLAY_DATA] = null;
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
     * Sets value of 'play_data' property
     *
     * @param \Proto\Play_Data $value Property value
     *
     * @return null
     */
    public function setPlayData(\Proto\Play_Data $value=null)
    {
        return $this->set(self::PLAY_DATA, $value);
    }

    /**
     * Returns value of 'play_data' property
     *
     * @return \Proto\Play_Data
     */
    public function getPlayData()
    {
        return $this->get(self::PLAY_DATA);
    }

    /**
     * Returns true if 'play_data' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayData()
    {
        return $this->get(self::PLAY_DATA) !== null;
    }
}
}