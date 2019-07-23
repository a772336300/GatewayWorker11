<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * CS_User_BU_Steam message
 */
class CS_User_BU_Steam extends \ProtobufMessage
{
    /* Field index constants */
    const FLAG = 1;
    const DATEFLAG = 2;
    const PAGE = 3;
    const PAGESIZE = 4;
    const UNIXTIMESTAMP = 5;
    const SHOWALL = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FLAG => array(
            'name' => 'flag',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DATEFLAG => array(
            'name' => 'dateFlag',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAGE => array(
            'name' => 'page',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAGESIZE => array(
            'name' => 'pageSize',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UNIXTIMESTAMP => array(
            'name' => 'unixTimestamp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SHOWALL => array(
            'name' => 'showAll',
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
        $this->values[self::FLAG] = null;
        $this->values[self::DATEFLAG] = null;
        $this->values[self::PAGE] = null;
        $this->values[self::PAGESIZE] = null;
        $this->values[self::UNIXTIMESTAMP] = null;
        $this->values[self::SHOWALL] = null;
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
     * Sets value of 'flag' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFlag($value)
    {
        return $this->set(self::FLAG, $value);
    }

    /**
     * Returns value of 'flag' property
     *
     * @return integer
     */
    public function getFlag()
    {
        $value = $this->get(self::FLAG);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'flag' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasFlag()
    {
        return $this->get(self::FLAG) !== null;
    }

    /**
     * Sets value of 'dateFlag' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDateFlag($value)
    {
        return $this->set(self::DATEFLAG, $value);
    }

    /**
     * Returns value of 'dateFlag' property
     *
     * @return integer
     */
    public function getDateFlag()
    {
        $value = $this->get(self::DATEFLAG);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'dateFlag' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDateFlag()
    {
        return $this->get(self::DATEFLAG) !== null;
    }

    /**
     * Sets value of 'page' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPage($value)
    {
        return $this->set(self::PAGE, $value);
    }

    /**
     * Returns value of 'page' property
     *
     * @return integer
     */
    public function getPage()
    {
        $value = $this->get(self::PAGE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'page' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPage()
    {
        return $this->get(self::PAGE) !== null;
    }

    /**
     * Sets value of 'pageSize' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPageSize($value)
    {
        return $this->set(self::PAGESIZE, $value);
    }

    /**
     * Returns value of 'pageSize' property
     *
     * @return integer
     */
    public function getPageSize()
    {
        $value = $this->get(self::PAGESIZE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'pageSize' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPageSize()
    {
        return $this->get(self::PAGESIZE) !== null;
    }

    /**
     * Sets value of 'unixTimestamp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUnixTimestamp($value)
    {
        return $this->set(self::UNIXTIMESTAMP, $value);
    }

    /**
     * Returns value of 'unixTimestamp' property
     *
     * @return integer
     */
    public function getUnixTimestamp()
    {
        $value = $this->get(self::UNIXTIMESTAMP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'unixTimestamp' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUnixTimestamp()
    {
        return $this->get(self::UNIXTIMESTAMP) !== null;
    }

    /**
     * Sets value of 'showAll' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setShowAll($value)
    {
        return $this->set(self::SHOWALL, $value);
    }

    /**
     * Returns value of 'showAll' property
     *
     * @return integer
     */
    public function getShowAll()
    {
        $value = $this->get(self::SHOWALL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'showAll' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasShowAll()
    {
        return $this->get(self::SHOWALL) !== null;
    }
}
}