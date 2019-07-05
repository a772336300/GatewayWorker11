<?php
/**
 * Auto generated from new.proto at 2019-07-04 15:19:45
 *
 * proto package
 */

namespace Proto {
/**
 * User_BU_Stream_Item message
 */
class User_BU_Stream_Item extends \ProtobufMessage
{
    /* Field index constants */
    const BUVALUE = 1;
    const FLOWTIME = 2;
    const BEHAVIORNAME = 3;
    const PARTNERNAME = 4;
    const BUTYPE = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BUVALUE => array(
            'name' => 'buValue',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FLOWTIME => array(
            'name' => 'flowTime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BEHAVIORNAME => array(
            'name' => 'behaviorName',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PARTNERNAME => array(
            'name' => 'partnerName',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BUTYPE => array(
            'name' => 'buType',
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
        $this->values[self::BUVALUE] = null;
        $this->values[self::FLOWTIME] = null;
        $this->values[self::BEHAVIORNAME] = null;
        $this->values[self::PARTNERNAME] = null;
        $this->values[self::BUTYPE] = null;
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
     * Sets value of 'buValue' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBuValue($value)
    {
        return $this->set(self::BUVALUE, $value);
    }

    /**
     * Returns value of 'buValue' property
     *
     * @return integer
     */
    public function getBuValue()
    {
        $value = $this->get(self::BUVALUE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'buValue' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBuValue()
    {
        return $this->get(self::BUVALUE) !== null;
    }

    /**
     * Sets value of 'flowTime' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setFlowTime($value)
    {
        return $this->set(self::FLOWTIME, $value);
    }

    /**
     * Returns value of 'flowTime' property
     *
     * @return string
     */
    public function getFlowTime()
    {
        $value = $this->get(self::FLOWTIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'flowTime' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasFlowTime()
    {
        return $this->get(self::FLOWTIME) !== null;
    }

    /**
     * Sets value of 'behaviorName' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBehaviorName($value)
    {
        return $this->set(self::BEHAVIORNAME, $value);
    }

    /**
     * Returns value of 'behaviorName' property
     *
     * @return string
     */
    public function getBehaviorName()
    {
        $value = $this->get(self::BEHAVIORNAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'behaviorName' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBehaviorName()
    {
        return $this->get(self::BEHAVIORNAME) !== null;
    }

    /**
     * Sets value of 'partnerName' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPartnerName($value)
    {
        return $this->set(self::PARTNERNAME, $value);
    }

    /**
     * Returns value of 'partnerName' property
     *
     * @return string
     */
    public function getPartnerName()
    {
        $value = $this->get(self::PARTNERNAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'partnerName' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPartnerName()
    {
        return $this->get(self::PARTNERNAME) !== null;
    }

    /**
     * Sets value of 'buType' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBuType($value)
    {
        return $this->set(self::BUTYPE, $value);
    }

    /**
     * Returns value of 'buType' property
     *
     * @return string
     */
    public function getBuType()
    {
        $value = $this->get(self::BUTYPE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'buType' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBuType()
    {
        return $this->get(self::BUTYPE) !== null;
    }
}
}