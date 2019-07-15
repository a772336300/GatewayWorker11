<?php
/**
 * Auto generated from new.proto at 2019-07-15 14:47:39
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_UB message
 */
class SC_User_UB extends \ProtobufMessage
{
    /* Field index constants */
    const INIT_BU = 1;
    const BU = 2;
    const GOLD = 3;
    const VIGOUR = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INIT_BU => array(
            'name' => 'init_bu',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::BU => array(
            'name' => 'BU',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIGOUR => array(
            'name' => 'vigour',
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
        $this->values[self::INIT_BU] = null;
        $this->values[self::BU] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::VIGOUR] = null;
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
     * Sets value of 'init_bu' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setInitBu($value)
    {
        return $this->set(self::INIT_BU, $value);
    }

    /**
     * Returns value of 'init_bu' property
     *
     * @return boolean
     */
    public function getInitBu()
    {
        $value = $this->get(self::INIT_BU);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'init_bu' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasInitBu()
    {
        return $this->get(self::INIT_BU) !== null;
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
}
}