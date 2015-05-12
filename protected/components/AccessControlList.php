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

    /**
     * @return User
     */
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

        if ($this->user->role_id !== Yii::app()->user->role_id) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canPerformUsersAdminActions()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canAccessOrders()
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

        if ($this->user->isCarrier()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canCreateOrder()
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

    /**
     * @return bool
     */
    public function canDeleteOrder()
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canViewDeletedOrders()
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

    /**
     * @return bool
     */
    public function canCreateOrderBids()
    {
        if ($this->user->isCarrier()) {
            return true;
        }

        return false;
    }

    /**
     * @param OrderBids $orderBids
     * @return bool
     */
    public function canDeleteOrderBids(OrderBids $orderBids)
    {
        if ($this->user->isAdmin()) {
            return true;
        }

        // Carrier can delete only self created bids
        if ($this->user->isCarrier() && $orderBids->user_id === $this->user->id) {
            return true;
        }

        return false;
    }

    /**
     * @param OrderBids $orderBids
     * @return bool
     */
    public function canWithdrawOrderBid(OrderBids $orderBids) {
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