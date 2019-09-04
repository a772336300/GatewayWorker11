<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-04 18:39:38
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Bottom_Cards message
 */
class SC_Bottom_Cards extends \ProtobufMessage
{
    /* Field index constants */
    const CARDS = 1;
    const OWNER = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CARDS => array(
            'name' => 'cards',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OWNER => array(
            'name' => 'owner',
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
        $this->values[self::CARDS] = null;
        $this->values[self::OWNER] = null;
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
     * Sets value of 'cards' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCards($value)
    {
        return $this->set(self::CARDS, $value);
    }

    /**
     * Returns value of 'cards' property
     *
     * @return string
     */
    public function getCards()
    {
        $value = $this->get(self::CARDS);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'cards' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCards()
    {
        return $this->get(self::CARDS) !== null;
    }

    /**
     * Sets value of 'owner' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOwner($value)
    {
        return $this->set(self::OWNER, $value);
    }

    /**
     * Returns value of 'owner' property
     *
     * @return integer
     */
    public function getOwner()
    {
        $value = $this->get(self::OWNER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'owner' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOwner()
    {
        return $this->get(self::OWNER) !== null;
    }
}
}