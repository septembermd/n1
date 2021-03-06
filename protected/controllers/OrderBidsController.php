<?php

class OrderBidsController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        $acl = $this->acl;

        return [
            ['allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => ['create'],
                'expression' => function() use ($acl) {
                    return $acl->canCreateOrderBids();
                }
            ],
            ['allow',
                'actions' => ['index'],
                'expression' => function() use ($acl) {
                    return $acl->canViewOrderBids();
                }
            ],
            ['allow',
                'actions' => ['accept'],
                'expression' => function() use ($acl) {
                    return $acl->canAcceptOrderBids();
                }
            ],
            ['allow',
                'actions' => ['bestOffer'],
                'expression' => function() use ($acl) {
                    return $acl->canAcceptBestOrderBids();
                }
            ],
            ['allow', // allow admin user to perform 'delete' action
                'actions' => ['delete', 'withdraw', 'withdrawBid'],
                'users' => ['@']
            ],
            ['deny',  // deny all users
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Lists all models.
     *
     * @param $orderId
     */
    public function actionIndex($orderId)
    {
        $dataProvider = OrderBids::model()->getCActiveDataProviderByOrderId($orderId);
        $this->render('index', [
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Show best order offer
     *
     * @param $orderId
     * @throws CHttpException
     */
    public function actionBestOffer($orderId)
    {
        $orderModel = Order::model();
        $order = $orderModel->findByPk($orderId);
        if ($order === null) {
            throw new CHttpException(404, Yii::t('main', 'The requested page does not exist.'));
        }
        $orderBid = OrderBids::model()->findBestOfferByOrder($order);
        if ($orderBid === null) {
            throw new CHttpException(404, Yii::t('main', 'The requested page does not exist.'));
        }
        $ordersWithIssuesCount = $orderModel->getOrdersWithIssuesCountByUser($orderBid->user);

        $this->render('bestOffer', [
            'model' => $orderBid,
            'ordersWithIssuesCount' => $ordersWithIssuesCount
        ]);
    }

    /**
     * Withdraw order bid offered by actionBestOffer
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionWithdrawBid($id)
    {
        /** @var OrderBids $orderBid */
        $model = $this->loadModel($id);

        if (!$this->acl->canWithdrawOrderBid($model)) {
            throw new CHttpException('403', Yii::t('main', 'You are not allowed to withdraw this order bid.'));
        }
        $orderBidWithdrawForm = new OrderBidWithdrawForm();
        $orderBidWithdrawForm->orderBid = $model;

        $event = new OrderBidWithdrawnEvent($model, $orderBidWithdrawForm, $this);
        $model->onOrderBidWithdrawn = [$event, 'sendNotification'];

        if (isset($_POST['OrderBidWithdrawForm'])) {
            $orderBidWithdrawForm->attributes = $_POST['OrderBidWithdrawForm'];
            $model->is_deleted = OrderBids::STATE_DELETED;
            if ($model->save()) {
                $this->redirect(['order/view', 'id' => $model->order_id]);
            }
        }
        $this->render('withdrawBid', ['model' => $model, 'orderBidWithdrawForm' => $orderBidWithdrawForm]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param $orderId Order id
     * @throws CHttpException
     */
    public function actionCreate($orderId)
    {
        $currentUser = $this->acl->getUser();

        $order = Order::model()->findByPk($orderId);

        // Do not allow user to create bid if he has already created one
        if ($order->isTransportationOfferedByUser($currentUser)) {
            throw new CHttpException(400, Yii::t('main', 'You have already added a bid for this order.'));
        }

        $model = new OrderBids;

        $event = new OrderBidCreatedEvent($model, $this);
        $model->onOrderBidCreated = [$event, 'sendNotification'];

        $model->user_id = $currentUser->id;
        $model->order_id = $orderId;

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if (isset($_POST['OrderBids'])) {
            $model->attributes = $_POST['OrderBids'];
            if ($model->save()) {
                $this->redirect(['order/view', 'id' => $model->order_id]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Accept transportation offer
     *
     * @param $orderBidId
     * @throws CHttpException
     */
    public function actionAccept($orderBidId)
    {
        /** @var OrderBids $orderBid */
        $orderBid = $this->loadModel($orderBidId);

        $event = new HaulerChosenEvent($orderBid, $this);
        $orderBid->order->onHaulerChosen = [$event, 'sendNotification'];

        // Set flag which shows that this bid won
        $orderBid->setAttribute('is_winner', OrderBids::IS_WINNER);
        // Set carrier id to order
        $orderBid->order->setAttribute('carrier_id', $orderBid->user_id);
        // Set order status 'In transit'
        $orderBid->order->setAttribute('status_id', Order::STATUS_IN_TRANSIT);

        if($orderBid->hasErrors() || $orderBid->order->hasErrors()) {
            throw new CHttpException(400, 'Validation error.');
        }

        if ($orderBid->save() && $orderBid->order->save()) {
            $this->redirect(['order/view', 'id' => $orderBid->order_id]);
        } else {
            throw new CHttpException(400, 'Validation error.');
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        /** @var OrderBids $model */
        $model = $this->loadModel($id);
        if ($this->acl->canDeleteOrderBids($model)) {
            // we only allow deletion via POST request
            $model->delete();
        } else {
            throw new CHttpException(400, Yii::t('main', 'You are not allowed to delete this bid.'));
        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['order/view', 'id' => $model->order_id]);
        }
    }

    /**
     * Withdraw order bid
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionWithdraw($id) {
        /** @var OrderBids $model */
        $model = $this->loadModel($id);

        // Check if user can withdraw this offer
        if (!$this->acl->canWithdrawOrderBid($model)) {
            throw new CHttpException(400, Yii::t('main', 'You are not allowed to withdraw this bid.'));
        }
        $model->setAttribute('is_deleted', OrderBids::STATE_DELETED);
        if ($model->save()) {
            $this->redirect(['order/view', 'id' => $model->order_id]);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @return OrderBids
     * @throws CHttpException
     * @internal param the $integer ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = OrderBids::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-bids-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
