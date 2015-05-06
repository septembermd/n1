<?php

/**
 * Class AccessControlList
 */
class AccessControlList {
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function canAuthenticate()
    {
        if (!$this->user->isActive()) {
            return false;
        }

        if ($this->user->role_id != Yii::app()->user->role_id) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canAccessUsers()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canViewCreator()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        if ($this->user->isSupervisor()) {
            return true;
        }

        if ($this->user->isManager()) {
            return true;
        }

        return false;
    }
}