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
    public $username;
    public $_username;
    public $_name;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $user->id;
            $this->_name = $user->name;
            $this->_username = $user->username;
            $this->setState('surname', $user->surname);
            $this->setState('is_staff', $user->is_staff);
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
        return $this->_name;
    }

    public function getUsername()
    {
        return $this->_username;
    }
}