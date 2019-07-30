<?php
/**
 * Auto generated from new.proto at 2019-07-30 16:58:52
 *
 * proto package
 */

namespace Proto {
/**
 * CS_Game_Over_Score message
 */
class CS_Game_Over_Score extends \ProtobufMessage
{
    /* Field index constants */
    const GAMEID = 1;
    const VALUE1 = 2;
    const VALUE2 = 3;
    const VALUE3 = 4;
    const VALUE4 = 5;
    const VALUE5 = 6;
    const VALUE6 = 7;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GAMEID => array(
            'name' => 'gameid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE1 => array(
            'name' => 'value1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE2 => array(
            'name' => 'value2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE3 => array(
            'name' => 'value3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE4 => array(
            'name' => 'value4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE5 => array(
            'name' => 'value5',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VALUE6 => array(
            'name' => 'value6',
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
        $this->values[self::GAMEID] = null;
        $this->values[self::VALUE1] = null;
        $this->values[self::VALUE2] = null;
        $this->values[self::VALUE3] = null;
        $this->values[self::VALUE4] = null;
        $this->values[self::VALUE5] = null;
        $this->values[self::VALUE6] = null;
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
     * Sets value of 'gameid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameid($value)
    {
        return $this->set(self::GAMEID, $value);
    }

    /**
     * Returns value of 'gameid' property
     *
     * @return integer
     */
    public function getGameid()
    {
        $value = $this->get(self::GAMEID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'gameid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGameid()
    {
        return $this->get(self::GAMEID) !== null;
    }

    /**
     * Sets value of 'value1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue1($value)
    {
        return $this->set(self::VALUE1, $value);
    }

    /**
     * Returns value of 'value1' property
     *
     * @return integer
     */
    public function getValue1()
    {
        $value = $this->get(self::VALUE1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value1' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue1()
    {
        return $this->get(self::VALUE1) !== null;
    }

    /**
     * Sets value of 'value2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue2($value)
    {
        return $this->set(self::VALUE2, $value);
    }

    /**
     * Returns value of 'value2' property
     *
     * @return integer
     */
    public function getValue2()
    {
        $value = $this->get(self::VALUE2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value2' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue2()
    {
        return $this->get(self::VALUE2) !== null;
    }

    /**
     * Sets value of 'value3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue3($value)
    {
        return $this->set(self::VALUE3, $value);
    }

    /**
     * Returns value of 'value3' property
     *
     * @return integer
     */
    public function getValue3()
    {
        $value = $this->get(self::VALUE3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value3' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue3()
    {
        return $this->get(self::VALUE3) !== null;
    }

    /**
     * Sets value of 'value4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue4($value)
    {
        return $this->set(self::VALUE4, $value);
    }

    /**
     * Returns value of 'value4' property
     *
     * @return integer
     */
    public function getValue4()
    {
        $value = $this->get(self::VALUE4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value4' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue4()
    {
        return $this->get(self::VALUE4) !== null;
    }

    /**
     * Sets value of 'value5' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue5($value)
    {
        return $this->set(self::VALUE5, $value);
    }

    /**
     * Returns value of 'value5' property
     *
     * @return integer
     */
    public function getValue5()
    {
        $value = $this->get(self::VALUE5);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value5' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue5()
    {
        return $this->get(self::VALUE5) !== null;
    }

    /**
     * Sets value of 'value6' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue6($value)
    {
        return $this->set(self::VALUE6, $value);
    }

    /**
     * Returns value of 'value6' property
     *
     * @return integer
     */
    public function getValue6()
    {
        $value = $this->get(self::VALUE6);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'value6' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue6()
    {
        return $this->get(self::VALUE6) !== null;
    }
}
}