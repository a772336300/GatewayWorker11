<?php
/**
 * Auto generated from new.proto at 2019-09-10 15:42:34
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_LHD message
 */
class SC_User_LHD extends \ProtobufMessage
{
    /* Field index constants */
    const LHD = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LHD => array(
            'name' => 'lhd',
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
        $this->values[self::LHD] = null;
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
     * Sets value of 'lhd' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLhd($value)
    {
        return $this->set(self::LHD, $value);
    }

    /**
     * Returns value of 'lhd' property
     *
     * @return integer
     */
    public function getLhd()
    {
        $value = $this->get(self::LHD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'lhd' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLhd()
    {
        return $this->get(self::LHD) !== null;
    }
}
}