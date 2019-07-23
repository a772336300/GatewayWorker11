<?php
/**
 * Auto generated from new.proto at 2019-07-23 10:32:30
 *
 * proto package
 */

namespace Proto {
/**
 * SC_All_Game_Ranking message
 */
class SC_All_Game_Ranking extends \ProtobufMessage
{
    /* Field index constants */
    const RANKINGDATA = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RANKINGDATA => array(
            'name' => 'rankingdata',
            'repeated' => true,
            'type' => '\Proto\E_Fast_Game_Ranking'
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
        $this->values[self::RANKINGDATA] = array();
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
     * Appends value to 'rankingdata' list
     *
     * @param \Proto\E_Fast_Game_Ranking $value Value to append
     *
     * @return null
     */
    public function appendRankingdata(\Proto\E_Fast_Game_Ranking $value)
    {
        return $this->append(self::RANKINGDATA, $value);
    }

    /**
     * Clears 'rankingdata' list
     *
     * @return null
     */
    public function clearRankingdata()
    {
        return $this->clear(self::RANKINGDATA);
    }

    /**
     * Returns 'rankingdata' list
     *
     * @return \Proto\E_Fast_Game_Ranking[]
     */
    public function getRankingdata()
    {
        return $this->get(self::RANKINGDATA);
    }

    /**
     * Returns true if 'rankingdata' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRankingdata()
    {
        return count($this->get(self::RANKINGDATA)) !== 0;
    }

    /**
     * Returns 'rankingdata' iterator
     *
     * @return \ArrayIterator
     */
    public function getRankingdataIterator()
    {
        return new \ArrayIterator($this->get(self::RANKINGDATA));
    }

    /**
     * Returns element from 'rankingdata' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_Fast_Game_Ranking
     */
    public function getRankingdataAt($offset)
    {
        return $this->get(self::RANKINGDATA, $offset);
    }

    /**
     * Returns count of 'rankingdata' list
     *
     * @return int
     */
    public function getRankingdataCount()
    {
        return $this->count(self::RANKINGDATA);
    }
}
}