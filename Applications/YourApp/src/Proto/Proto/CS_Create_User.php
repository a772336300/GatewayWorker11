<?php
/**
 * Auto generated from new.proto at 2019-05-17 11:04:22
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Create_User message
 */
class CS_Create_User extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const GENDER = 2;
    const CONSTELLATION = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GENDER => array(
            'name' => 'gender',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSTELLATION => array(
            'name' => 'constellation',
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
        $this->values[self::NAME] = null;
        $this->values[self::GENDER] = null;
        $this->values[self::CONSTELLATION] = null;
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
     * Sets value of 'constellation' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConstellation($value)
    {
        return $this->set(self::CONSTELLATION, $value);
    }

    /**
     * Returns value of 'constellation' property
     *
     * @return integer
     */
    public function getConstellation()
    {
        $value = $this->get(self::CONSTELLATION);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'constellation' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasConstellation()
    {
        return $this->get(self::CONSTELLATION) !== null;
    }
}
}