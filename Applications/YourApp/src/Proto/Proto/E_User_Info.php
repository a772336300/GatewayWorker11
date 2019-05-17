<?php
/**
 * Auto generated from new.proto at 2019-05-17 11:04:22
 *
 * proto package
 */

namespace Proto {
/**
 * E_User_Info message
 */
class E_User_Info extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const GENDER = 2;
    const NAME = 3;
    const GOLD = 4;
    const BU = 5;
    const VIGOUR = 6;
    const XINGZHU = 7;
    const TOUXIANG = 8;
    const SIGN_DATE = 9;
    const MOXING_IDS = 10;
    const MOXING_ID = 11;
    const CHANGJING_IDS = 12;
    const CHANGJING_ID = 13;
    const BSIGN = 14;
    const BAGENT = 15;
    const BREALNAME = 16;
    const BWX = 17;
    const PHONE = 18;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GENDER => array(
            'name' => 'gender',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BU => array(
            'name' => 'BU',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIGOUR => array(
            'name' => 'vigour',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::XINGZHU => array(
            'name' => 'xingzhu',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TOUXIANG => array(
            'name' => 'touxiang',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::SIGN_DATE => array(
            'name' => 'sign_date',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MOXING_IDS => array(
            'name' => 'moxing_ids',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MOXING_ID => array(
            'name' => 'moxing_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CHANGJING_IDS => array(
            'name' => 'changjing_ids',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANGJING_ID => array(
            'name' => 'changjing_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BSIGN => array(
            'name' => 'bsign',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::BAGENT => array(
            'name' => 'bAgent',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::BREALNAME => array(
            'name' => 'bRealName',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::BWX => array(
            'name' => 'bWx',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::PHONE => array(
            'name' => 'phone',
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
        $this->values[self::UID] = null;
        $this->values[self::GENDER] = null;
        $this->values[self::NAME] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::BU] = null;
        $this->values[self::VIGOUR] = null;
        $this->values[self::XINGZHU] = null;
        $this->values[self::TOUXIANG] = null;
        $this->values[self::SIGN_DATE] = null;
        $this->values[self::MOXING_IDS] = null;
        $this->values[self::MOXING_ID] = null;
        $this->values[self::CHANGJING_IDS] = null;
        $this->values[self::CHANGJING_ID] = null;
        $this->values[self::BSIGN] = null;
        $this->values[self::BAGENT] = null;
        $this->values[self::BREALNAME] = null;
        $this->values[self::BWX] = null;
        $this->values[self::PHONE] = null;
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

    /**
     * Sets value of 'gender' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGender($value)
    {
        return $this->set(self::GENDER, $value);
    }

    /**
     * Returns value of 'gender' property
     *
     * @return integer
     */
    public function getGender()
    {
        $value = $this->get(self::GENDER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gender' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGender()
    {
        return $this->get(self::GENDER) !== null;
    }

    /**
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasName()
    {
        return $this->get(self::NAME) !== null;
    }

    /**
     * Sets value of 'gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGold($value)
    {
        return $this->set(self::GOLD, $value);
    }

    /**
     * Returns value of 'gold' property
     *
     * @return integer
     */
    public function getGold()
    {
        $value = $this->get(self::GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gold' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGold()
    {
        return $this->get(self::GOLD) !== null;
    }

    /**
     * Sets value of 'BU' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBU($value)
    {
        return $this->set(self::BU, $value);
    }

    /**
     * Returns value of 'BU' property
     *
     * @return integer
     */
    public function getBU()
    {
        $value = $this->get(self::BU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'BU' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBU()
    {
        return $this->get(self::BU) !== null;
    }

    /**
     * Sets value of 'vigour' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVigour($value)
    {
        return $this->set(self::VIGOUR, $value);
    }

    /**
     * Returns value of 'vigour' property
     *
     * @return integer
     */
    public function getVigour()
    {
        $value = $this->get(self::VIGOUR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'vigour' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasVigour()
    {
        return $this->get(self::VIGOUR) !== null;
    }

    /**
     * Sets value of 'xingzhu' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setXingzhu($value)
    {
        return $this->set(self::XINGZHU, $value);
    }

    /**
     * Returns value of 'xingzhu' property
     *
     * @return integer
     */
    public function getXingzhu()
    {
        $value = $this->get(self::XINGZHU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'xingzhu' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasXingzhu()
    {
        return $this->get(self::XINGZHU) !== null;
    }

    /**
     * Sets value of 'touxiang' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTouxiang($value)
    {
        return $this->set(self::TOUXIANG, $value);
    }

    /**
     * Returns value of 'touxiang' property
     *
     * @return string
     */
    public function getTouxiang()
    {
        $value = $this->get(self::TOUXIANG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'touxiang' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasTouxiang()
    {
        return $this->get(self::TOUXIANG) !== null;
    }

    /**
     * Sets value of 'sign_date' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSignDate($value)
    {
        return $this->set(self::SIGN_DATE, $value);
    }

    /**
     * Returns value of 'sign_date' property
     *
     * @return integer
     */
    public function getSignDate()
    {
        $value = $this->get(self::SIGN_DATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'sign_date' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSignDate()
    {
        return $this->get(self::SIGN_DATE) !== null;
    }

    /**
     * Sets value of 'moxing_ids' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMoxingIds($value)
    {
        return $this->set(self::MOXING_IDS, $value);
    }

    /**
     * Returns value of 'moxing_ids' property
     *
     * @return string
     */
    public function getMoxingIds()
    {
        $value = $this->get(self::MOXING_IDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'moxing_ids' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMoxingIds()
    {
        return $this->get(self::MOXING_IDS) !== null;
    }

    /**
     * Sets value of 'moxing_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMoxingId($value)
    {
        return $this->set(self::MOXING_ID, $value);
    }

    /**
     * Returns value of 'moxing_id' property
     *
     * @return integer
     */
    public function getMoxingId()
    {
        $value = $this->get(self::MOXING_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'moxing_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMoxingId()
    {
        return $this->get(self::MOXING_ID) !== null;
    }

    /**
     * Sets value of 'changjing_ids' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setChangjingIds($value)
    {
        return $this->set(self::CHANGJING_IDS, $value);
    }

    /**
     * Returns value of 'changjing_ids' property
     *
     * @return string
     */
    public function getChangjingIds()
    {
        $value = $this->get(self::CHANGJING_IDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'changjing_ids' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasChangjingIds()
    {
        return $this->get(self::CHANGJING_IDS) !== null;
    }

    /**
     * Sets value of 'changjing_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setChangjingId($value)
    {
        return $this->set(self::CHANGJING_ID, $value);
    }

    /**
     * Returns value of 'changjing_id' property
     *
     * @return integer
     */
    public function getChangjingId()
    {
        $value = $this->get(self::CHANGJING_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'changjing_id' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasChangjingId()
    {
        return $this->get(self::CHANGJING_ID) !== null;
    }

    /**
     * Sets value of 'bsign' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setBsign($value)
    {
        return $this->set(self::BSIGN, $value);
    }

    /**
     * Returns value of 'bsign' property
     *
     * @return boolean
     */
    public function getBsign()
    {
        $value = $this->get(self::BSIGN);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'bsign' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBsign()
    {
        return $this->get(self::BSIGN) !== null;
    }

    /**
     * Sets value of 'bAgent' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setBAgent($value)
    {
        return $this->set(self::BAGENT, $value);
    }

    /**
     * Returns value of 'bAgent' property
     *
     * @return boolean
     */
    public function getBAgent()
    {
        $value = $this->get(self::BAGENT);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'bAgent' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBAgent()
    {
        return $this->get(self::BAGENT) !== null;
    }

    /**
     * Sets value of 'bRealName' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setBRealName($value)
    {
        return $this->set(self::BREALNAME, $value);
    }

    /**
     * Returns value of 'bRealName' property
     *
     * @return boolean
     */
    public function getBRealName()
    {
        $value = $this->get(self::BREALNAME);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'bRealName' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBRealName()
    {
        return $this->get(self::BREALNAME) !== null;
    }

    /**
     * Sets value of 'bWx' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setBWx($value)
    {
        return $this->set(self::BWX, $value);
    }

    /**
     * Returns value of 'bWx' property
     *
     * @return boolean
     */
    public function getBWx()
    {
        $value = $this->get(self::BWX);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'bWx' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasBWx()
    {
        return $this->get(self::BWX) !== null;
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
}
}