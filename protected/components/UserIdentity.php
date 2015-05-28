<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * @var $user User
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_USER_NOT_ACTIVE = 3;

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
     *
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(email)=?', [strtolower($this->email)]);
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else if (!$user->isActive()) {
            $this->errorCode = self::ERROR_USER_NOT_ACTIVE;
        } else {
            $this->_id = $user->id;
            $this->_fullname = $user->fullname;
            $this->_email = $user->email;
            $this->setState('fullname', $user->fullname);
            $this->setState('role_id', $user->role_id);
            Yii::app()->user->setFlash('success', Yii::t('main', 'You have sucessfully logged in!'));
            $this->errorCode = self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getUserfullname()
    {
        return $this->_fullname;
    }

    /**
     * Get validation errors
     *
     * @return array
     */
    public function getErrors()
    {
        $errors = [];

        if ($this->errorCode === self::ERROR_USERNAME_INVALID || $this->errorCode === self::ERROR_PASSWORD_INVALID) {
            $errors['password'] = [Yii::t('main', 'Incorrect username or password.')];
        }
        if ($this->errorCode == self::ERROR_USER_NOT_ACTIVE) {
            $errors['username'] = [Yii::t('main', 'Your account is disabled.')];
        }

        return $errors;
    }
}