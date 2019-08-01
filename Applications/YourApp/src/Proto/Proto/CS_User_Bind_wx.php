<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:41
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_Bind_wx message
 */
class CS_User_Bind_wx extends \ProtobufMessage
{
    /* Field index constants */
    const UNIONID = 1;
    const OPENID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UNIONID => array(
            'name' => 'unionid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OPENID => array(
            'name' => 'openid',
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
        $this->values[self::UNIONID] = null;
        $this->values[self::OPENID] = null;
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
     * Sets value of 'unionid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUnionid($value)
    {
        return $this->set(self::UNIONID, $value);
    }

    /**
     * Returns value of 'unionid' property
     *
     * @return string
     */
    public function getUnionid()
    {
        $value = $this->get(self::UNIONID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'unionid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUnionid()
    {
        return $this->get(self::UNIONID) !== null;
    }

    /**
     * Sets value of 'openid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOpenid($value)
    {
        return $this->set(self::OPENID, $value);
    }

    /**
     * Returns value of 'openid' property
     *
     * @return string
     */
    public function getOpenid()
    {
        $value = $this->get(self::OPENID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'openid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOpenid()
    {
        return $this->get(self::OPENID) !== null;
    }
}
}