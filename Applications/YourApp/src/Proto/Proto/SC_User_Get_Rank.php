<?php
/**
 * Auto generated from new.proto at 2019-07-04 15:19:45
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Get_Rank message
 */
class SC_User_Get_Rank extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const TOUXIANG = 2;
    const NAME = 3;
    const WIN_NUM = 4;
    const RANK = 5;
    const USER_RANK = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TOUXIANG => array(
            'name' => 'touxiang',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::WIN_NUM => array(
            'name' => 'win_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RANK => array(
            'name' => 'rank',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::USER_RANK => array(
            'name' => 'user_rank',
            'repeated' => true,
            'type' => '\Proto\E_User_Rank'
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
        $this->values[self::TOUXIANG] = null;
        $this->values[self::NAME] = null;
        $this->values[self::WIN_NUM] = null;
        $this->values[self::RANK] = null;
        $this->values[self::USER_RANK] = array();
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
     * Sets value of 'win_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWinNum($value)
    {
        return $this->set(self::WIN_NUM, $value);
    }

    /**
     * Returns value of 'win_num' property
     *
     * @return integer
     */
    public function getWinNum()
    {
        $value = $this->get(self::WIN_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'win_num' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasWinNum()
    {
        return $this->get(self::WIN_NUM) !== null;
    }

    /**
     * Sets value of 'rank' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRank($value)
    {
        return $this->set(self::RANK, $value);
    }

    /**
     * Returns value of 'rank' property
     *
     * @return integer
     */
    public function getRank()
    {
        $value = $this->get(self::RANK);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'rank' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRank()
    {
        return $this->get(self::RANK) !== null;
    }

    /**
     * Appends value to 'user_rank' list
     *
     * @param \Proto\E_User_Rank $value Value to append
     *
     * @return null
     */
    public function appendUserRank(\Proto\E_User_Rank $value)
    {
        return $this->append(self::USER_RANK, $value);
    }

    /**
     * Clears 'user_rank' list
     *
     * @return null
     */
    public function clearUserRank()
    {
        return $this->clear(self::USER_RANK);
    }

    /**
     * Returns 'user_rank' list
     *
     * @return \Proto\E_User_Rank[]
     */
    public function getUserRank()
    {
        return $this->get(self::USER_RANK);
    }

    /**
     * Returns true if 'user_rank' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserRank()
    {
        return count($this->get(self::USER_RANK)) !== 0;
    }

    /**
     * Returns 'user_rank' iterator
     *
     * @return \ArrayIterator
     */
    public function getUserRankIterator()
    {
        return new \ArrayIterator($this->get(self::USER_RANK));
    }

    /**
     * Returns element from 'user_rank' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_User_Rank
     */
    public function getUserRankAt($offset)
    {
        return $this->get(self::USER_RANK, $offset);
    }

    /**
     * Returns count of 'user_rank' list
     *
     * @return int
     */
    public function getUserRankCount()
    {
        return $this->count(self::USER_RANK);
    }
}
}