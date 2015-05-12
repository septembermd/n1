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
     */
    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
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
            throw new CHttpException(400, Yii::t('main', 'You are not allowed to view deleted orders.'));
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
     * @param $supplierId
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
