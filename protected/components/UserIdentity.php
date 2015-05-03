<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * @var $user User
 */
class UserIdentity extends CUserIdentity
{
    public $_id;
    public $email;
    public $_email;
    public $_fullname;

    public function __construct($username, $password)
    {
        $this->email = $username;
        $this->password = $password;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the email and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(email)=?', array(strtolower($this->email)));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id = $user->id;
            $this->_fullname = $user->fullname;
            $this->_email = $user->email;            
            $this->errorCode = self::ERROR_NONE;
            Yii::app()->user->setFlash('success', "You have sucessfully logged in!");
        }
        return $this->errorCode == self::ERROR_NONE;
    }


    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_email;
    }

    public function getUserfullname()
    {
        return $this->_fullname;
    }
}