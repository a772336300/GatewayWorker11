<?php
/**
 * Auto generated from new.proto at 2019-09-10 15:37:25
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Spread_Lhd_info message
 */
class SC_User_Spread_Lhd_info extends \ProtobufMessage
{
    /* Field index constants */
    const SPREAD_LHD_INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SPREAD_LHD_INFO => array(
            'name' => 'spread_lhd_info',
            'repeated' => true,
            'type' => '\Proto\E_Spread_Lhd_Info'
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
        $this->values[self::SPREAD_LHD_INFO] = array();
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
     * Appends value to 'spread_lhd_info' list
     *
     * @param \Proto\E_Spread_Lhd_Info $value Value to append
     *
     * @return null
     */
    public function appendSpreadLhdInfo(\Proto\E_Spread_Lhd_Info $value)
    {
        return $this->append(self::SPREAD_LHD_INFO, $value);
    }

    /**
     * Clears 'spread_lhd_info' list
     *
     * @return null
     */
    public function clearSpreadLhdInfo()
    {
        return $this->clear(self::SPREAD_LHD_INFO);
    }

    /**
     * Returns 'spread_lhd_info' list
     *
     * @return \Proto\E_Spread_Lhd_Info[]
     */
    public function getSpreadLhdInfo()
    {
        return $this->get(self::SPREAD_LHD_INFO);
    }

    /**
     * Returns true if 'spread_lhd_info' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSpreadLhdInfo()
    {
        return count($this->get(self::SPREAD_LHD_INFO)) !== 0;
    }

    /**
     * Returns 'spread_lhd_info' iterator
     *
     * @return \ArrayIterator
     */
    public function getSpreadLhdInfoIterator()
    {
        return new \ArrayIterator($this->get(self::SPREAD_LHD_INFO));
    }

    /**
     * Returns element from 'spread_lhd_info' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Spread_Lhd_Info
     */
    public function getSpreadLhdInfoAt($offset)
    {
        return $this->get(self::SPREAD_LHD_INFO, $offset);
    }

    /**
     * Returns count of 'spread_lhd_info' list
     *
     * @return int
     */
    public function getSpreadLhdInfoCount()
    {
        return $this->count(self::SPREAD_LHD_INFO);
    }
}
}