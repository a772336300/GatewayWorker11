<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-05 16:14:51
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Init_Cards message
 */
class SC_Init_Cards extends \ProtobufMessage
{
    /* Field index constants */
    const CARDS = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CARDS => array(
            'name' => 'cards',
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
        $this->values[self::CARDS] = null;
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
}
}