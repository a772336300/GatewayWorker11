<?php
/**
 * Auto generated from doudizhu.proto at 2019-09-03 10:38:21
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Game_Result message
 */
class SC_Game_Result extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYER_GAME_RESULT = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYER_GAME_RESULT => array(
            'name' => 'player_game_result',
            'repeated' => true,
            'type' => '\Proto\Player_Game_Result'
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
        $this->values[self::PLAYER_GAME_RESULT] = array();
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
     * Appends value to 'player_game_result' list
     *
     * @param \Proto\Player_Game_Result $value Value to append
     *
     * @return null
     */
    public function appendPlayerGameResult(\Proto\Player_Game_Result $value)
    {
        return $this->append(self::PLAYER_GAME_RESULT, $value);
    }

    /**
     * Clears 'player_game_result' list
     *
     * @return null
     */
    public function clearPlayerGameResult()
    {
        return $this->clear(self::PLAYER_GAME_RESULT);
    }

    /**
     * Returns 'player_game_result' list
     *
     * @return \Proto\Player_Game_Result[]
     */
    public function getPlayerGameResult()
    {
        return $this->get(self::PLAYER_GAME_RESULT);
    }

    /**
     * Returns true if 'player_game_result' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPlayerGameResult()
    {
        return count($this->get(self::PLAYER_GAME_RESULT)) !== 0;
    }

    /**
     * Returns 'player_game_result' iterator
     *
     * @return \ArrayIterator
     */
    public function getPlayerGameResultIterator()
    {
        return new \ArrayIterator($this->get(self::PLAYER_GAME_RESULT));
    }

    /**
     * Returns element from 'player_game_result' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\Player_Game_Result
     */
    public function getPlayerGameResultAt($offset)
    {
        return $this->get(self::PLAYER_GAME_RESULT, $offset);
    }

    /**
     * Returns count of 'player_game_result' list
     *
     * @return int
     */
    public function getPlayerGameResultCount()
    {
        return $this->count(self::PLAYER_GAME_RESULT);
    }
}
}