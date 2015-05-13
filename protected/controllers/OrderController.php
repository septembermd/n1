<?php

class OrderController extends Controller
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
            ['allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => ['index', 'view'],
                'users' => ['@'],
            ],
            ['allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => ['create', 'update', 'getLoadingAddressList'],
                'expression' => function() use ($acl) {
                    return $acl->canCreateOrder();
                },
            ],
            ['allow', // allow to perform 'accomplish' action
                'actions' => ['withdraw'],
                'expression' => function() use ($acl) {
                    return $acl->canWithdrawOrder();
                },
            ],
            ['allow', // allow to perform 'accomplish' action
                'actions' => ['accomplish'],
                'expression' => function() use ($acl) {
                    return $acl->canAccomplishOrder();
                },
            ],
            ['allow', // allow to perform 'accomplish' action
                'actions' => ['reopen'],
                'expression' => function() use ($acl) {
                    return $acl->canReopenOrder();
                },
            ],
            ['allow', // allow to perform 'loadCargo' action
                'actions' => ['loadCargo'],
                'expression' => function() use ($acl) {
                    return $acl->canAccessLoadCargo();
                },
            ],
            ['allow', // allow to perform 'delete' action
                'actions' => ['delete'],
                'expression' => function() use ($acl) {
                    return $acl->canDeleteOrder();
                },
            ],
            ['allow', // allow admin user to perform 'admin' action
                'actions' => ['admin'],
                'expression' => function() use ($acl) {
                    return $acl->getUser()->isAdmin();
                },
            ],
            ['deny',  // deny all users
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     * @throws CHttpException
     */
    public function actionView($id)
    {
        $order = $this->loadModel($id);
        if (!$this->acl->canViewOrder($order)) {
            throw new CHttpException(403, Yii::t('main', 'You cannot view this order'));
        }
        $this->render('view', [
            'model' => $order,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Order;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $model->setAttribute('creator_id', Yii::app()->user->getId());
            $model->orderItems = $_POST['OrderItems'];
            if ($model->saveWithRelated('orderItems')) {
                $this->redirect(['view', 'id' => $model->id]);
            }

        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $model->orderItems = $_POST['OrderItems'];
            if ($model->saveWithRelated('orderItems')) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Withdraw order
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionWithdraw($id)
    {
        /** @var Order $order */
        $order = $this->loadModel($id);
        $order->setAttribute('status_id', Order::STATUS_WITHDRAWN);
        if ($order->save()) {
            $this->redirect(['order/index', 'status' => Order::STATUS_WITHDRAWN]);
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
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Accomplish order action.
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionAccomplish($id)
    {
        /** @var Order $order */
        $order = $this->loadModel($id);

        if (isset($_POST['Order'])) {
            $order->setAttributes($_POST['Order']);
            // Set order status to 'Delivered'
            $order->setAttribute('status_id', Order::STATUS_DELIVERED);
            $order->setAttribute('delivered_on_date', new CDbExpression('NOW()'));
            // todo: send email notification to carrier, manager, supervisor
            if ($order->save()) {
                $this->redirect(['order/index', 'status' => Order::STATUS_DELIVERED]);
            }
        }

        $this->render('accomplish', ['model' => $order]);
    }

    /**
     * Reopen order action.
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionReopen($id)
    {
        /** @var Order $order */
        $order = $this->loadModel($id);

        // Reset status id to 'In transit'
        $order->setAttribute('status_id', Order::STATUS_IN_TRANSIT);
        // Clear remark and loaded cargo date
        $CDbNull = new CDbExpression('NULL');
        $order->setAttribute('remark_id', $CDbNull);
        $order->setAttribute('loaded_on_date', $CDbNull);
        $order->setAttribute('delivered_on_date', $CDbNull);

        if ($order->save()) {
            // todo: send email notification to supervisor, manager, carrier
            $this->redirect(['order/view', 'id' => $order->id]);
        } else var_dump($order->getErrors());
    }

    /**
     * Load cargo action
     *
     * @param $id
     * @throws CHttpException
     */
    public function actionLoadCargo($id)
    {
        /** @var Order $order */
        $order = $this->loadModel($id);
        // Check if user can load cargo on this order
        if (!$this->acl->canLoadCargo($order)) {
            throw new CHttpException(403, Yii::t('main', 'You are not allowed to load cargo for this order.'));
        }
        // Allow to load only cargo in transit
        if (!$order->isInTransit()) {
            throw new CHttpException(400, Yii::t('main', 'You are not allowed to load cargo which is not in transit.'));
        }
        $order->setAttribute('loaded_on_date', new CDbExpression('NOW()'));
        if ($order->save()) {
            // todo: send email notification to carrier, manager ... ?
            $this->redirect(['order/view', 'id' => $order->id]);
        }
    }

    /**
     * Lists all models.
     *
     * @param int $status
     * @param int $deleted
     * @throws CHttpException
     */
    public function actionIndex($status = Order::STATUS_HAULER_NEEDED, $deleted = Order::IS_ACTIVE)
    {
        $status = intval($status);
        $isDeleted = $deleted == Order::IS_DELETED;
        $currentUser = $this->acl->getUser();
        // Filter access for deleted orders tab
        if(!$this->acl->canViewDeletedOrders() && $isDeleted) {
            throw new CHttpException(403, Yii::t('main', 'You are not allowed to view deleted orders.'));
        }
        $dataProvider = Order::model()->getCActiveDataProviderByUserAndStatus($currentUser, $status, $deleted);
        $this->render('index', [
            'dataProvider' => $dataProvider,
            'currentStatus' => $status,
            'isDeleted' => $isDeleted
        ]);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('admin', [
            'model' => $model,
        ]);
    }

    /**
     * Ajax action. Get list of Supplier Addresses.
     *
     * @throws CHttpException
     */
    public function actionGetLoadingAddressList()
    {
        if (Yii::app()->request->isPostRequest) {
            $order = new Order();
            $order->setAttributes($_POST['Order']);
            $supplierAddressesList = SupplierAddresses::getListBySupplierId($order->supplier_id);
            foreach ($supplierAddressesList as $value => $name) {
                echo CHtml::tag('option', ['value' => $value], CHtml::encode($name));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return static
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Order::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
