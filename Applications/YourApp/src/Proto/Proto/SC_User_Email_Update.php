<?php
/**
 * Auto generated from new.proto at 2019-08-01 15:29:42
 *
 * proto package
 */

namespace Proto {
/**
 * SC_User_Email_Update message
 */
class SC_User_Email_Update extends \ProtobufMessage
{
    /* Field index constants */
    const USER_MAIL = 1;
    const TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::USER_MAIL => array(
            'name' => 'user_mail',
            'required' => false,
            'type' => '\Proto\E_User_mail'
        ),
        self::TYPE => array(
            'name' => 'type',
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
        $this->values[self::USER_MAIL] = null;
        $this->values[self::TYPE] = null;
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
     * Sets value of 'user_mail' property
     *
     * @param \Proto\E_User_mail $value Property value
     *
     * @return null
     */
    public function setUserMail(\Proto\E_User_mail $value=null)
    {
        return $this->set(self::USER_MAIL, $value);
    }

    /**
     * Returns value of 'user_mail' property
     *
     * @return \Proto\E_User_mail
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
        return $this->get(self::USER_MAIL) !== null;
    }

    /**
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasType()
    {
        return $this->get(self::TYPE) !== null;
    }
}
}