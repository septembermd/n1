<?php

/**
 * Class AccessControlList
 *
 * This class contains business rules to check user access rights
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
        if (!$this->getUser()->isActive()) {
            return false;
        }

        if ($this->getUser()->role_id !== Yii::app()->user->role_id) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canPerformUsersAdminActions()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canPerformSuppliersAdminActions()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canViewUser(User $user)
    {
        // Only administrator can view admin profile
        if (!$this->getUser()->isAdmin() && $user->isAdmin()) {
            return false;
        }
        // Carrier can view only his profile
        if ($this->getUser()->isCarrier() && $this->getUser()->id !== $user->id)
        {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canAccessOrders()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        if ($this->getUser()->isCarrier()) {
            return true;
        }

        return false;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function canViewOrder(Order $order)
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        if ($this->getUser()->isCarrier()) {
            // Carrier cannot view deleted orders
            if ($order->isDeleted()) {
                return false;
            }
            // Carrier can view order only if he is selected for the order
            if ($order->carrier_id === $this->getUser()->id) {
                return true;
            }

            if ($order->isHaulerNeeded()) {
                return true;
            }

        }

        return false;
    }
    
    /**
     * @return bool
     */
    public function canCreateOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canUpdateOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canWithdrawOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canRestoreOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canAccomplishOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canReopenOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canAccessLoadCargo()
    {
        if ($this->getUser()->isCarrier())
        {
            return true;
        }

        return false;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function canLoadCargo(Order $order)
    {
        // Carrier can load cargo only if he is selected for the order
        if ($this->getUser()->isCarrier() && $order->carrier_id === $this->getUser()->id) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canDeleteOrder()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canViewDeletedOrders()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function canViewOrderCreator(Order $order)
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        if ($this->getUser()->isCarrier() && !$order->isHaulerNeeded()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canViewOrderBidsCount()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canCreateOrderBids()
    {
        if ($this->getUser()->isCarrier()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canViewOrderBids()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canAcceptOrderBids()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canAcceptBestOrderBids()
    {
        if ($this->getUser()->isManager()) {
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
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        // Carrier can delete only self created bids
        if ($this->getUser()->isCarrier() && $orderBids->user_id === $this->getUser()->id) {
            return true;
        }

        return false;
    }

    /**
     * @param OrderBids $orderBids
     * @return bool
     */
    public function canWithdrawOrderBid(OrderBids $orderBids)
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        if ($this->getUser()->isSupervisor()) {
            return true;
        }

        if ($this->getUser()->isManager()) {
            // Manager can withdraw only best offer
            $bestOrderBids = OrderBids::model()->findBestOfferByOrder($orderBids->order);
            if ($bestOrderBids->id === $orderBids->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canManageEmailTemplates()
    {
        if ($this->getUser()->isAdmin()) {
            return true;
        }

        return false;
    }
}