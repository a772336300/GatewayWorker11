<?php
/**
 * Auto generated from new.proto at 2019-07-03 17:23:45
 *
 * proto package
 */

namespace Proto {
/**
 * SC_Get_User_Mail message
 */
class SC_Get_User_Mail extends \ProtobufMessage
{
    /* Field index constants */
    const USER_MAIL = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_MAIL => array(
            'name' => 'user_mail',
            'repeated' => true,
            'type' => '\Proto\E_User_mail'
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
        $this->values[self::USER_MAIL] = array();
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
     * Appends value to 'user_mail' list
     *
     * @param \Proto\E_User_mail $value Value to append
     *
     * @return null
     */
    public function appendUserMail(\Proto\E_User_mail $value)
    {
        return $this->append(self::USER_MAIL, $value);
    }

    /**
     * Clears 'user_mail' list
     *
     * @return null
     */
    public function clearUserMail()
    {
        return $this->clear(self::USER_MAIL);
    }

    /**
     * Returns 'user_mail' list
     *
     * @return \Proto\E_User_mail[]
     */
    public function getUserMail()
    {
        return $this->get(self::USER_MAIL);
    }

    /**
     * Returns true if 'user_mail' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUserMail()
    {
        return count($this->get(self::USER_MAIL)) !== 0;
    }

    /**
     * Returns 'user_mail' iterator
     *
     * @return \ArrayIterator
     */
    public function getUserMailIterator()
    {
        return new \ArrayIterator($this->get(self::USER_MAIL));
    }

    /**
     * Returns element from 'user_mail' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Proto\E_User_mail
     */
    public function getUserMailAt($offset)
    {
        return $this->get(self::USER_MAIL, $offset);
    }

    /**
     * Returns count of 'user_mail' list
     *
     * @return int
     */
    public function getUserMailCount()
    {
        return $this->count(self::USER_MAIL);
    }
}
}