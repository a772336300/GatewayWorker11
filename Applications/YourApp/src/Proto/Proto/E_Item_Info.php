<?php
/**
 * Auto generated from new.proto at 2019-05-14 14:02:04
 *
 * proto package
 */

namespace Proto {
/**
 * E_Item_Info message
 */
class E_Item_Info extends \ProtobufMessage
{
    /* Field index constants */
    const ITEMID = 1;
    const POS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ITEMID => array(
            'name' => 'itemid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POS => array(
            'name' => 'pos',
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
        $this->values[self::ITEMID] = null;
        $this->values[self::POS] = null;
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
     * Sets value of 'itemid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItemid($value)
    {
        return $this->set(self::ITEMID, $value);
    }

    /**
     * Returns value of 'itemid' property
     *
     * @return integer
     */
    public function getItemid()
    {
        $value = $this->get(self::ITEMID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'itemid' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasItemid()
    {
        return $this->get(self::ITEMID) !== null;
    }

    /**
     * Sets value of 'pos' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPos($value)
    {
        return $this->set(self::POS, $value);
    }

    /**
     * Returns value of 'pos' property
     *
     * @return integer
     */
    public function getPos()
    {
        $value = $this->get(self::POS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'pos' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPos()
    {
        return $this->get(self::POS) !== null;
    }
}
}