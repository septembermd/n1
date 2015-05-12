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
            ['allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => ['delete', 'withdraw'],
                'users' => ['@']
            ],
            ['deny',  // deny all users
                'users' => ['*'],
            ],
        ];
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

        $model->user_id = $currentUser->id;
        $model->order_id = $orderId;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OrderBids'])) {
            $model->attributes = $_POST['OrderBids'];
            if ($model->save()) {
                // todo: send email notification
                $this->redirect(['order/view', 'id' => $model->order_id]);
            }
        }

        $this->render('create', [
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
//        if (Yii::app()->request->isPostRequest) {
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
//        } else {
//            throw new CHttpException(400, Yii::t('main', 'Invalid request. Please do not repeat this request again.'));
//        }
    }

    public function actionWithdraw($id) {
//        if (Yii::app()->request->isPostRequest) {
            /** @var OrderBids $model */
            $model = $this->loadModel($id);
            if ($this->acl->canWithdrawOrderBid($model)) {
                $model->setAttribute('is_deleted', OrderBids::STATE_DELETED);
                if ($model->save()) {
                    $this->redirect(['order/view', 'id' => $model->order_id]);
                } else {
                    var_dump($model->getErrors());
                }
            } else {
                throw new CHttpException(400, Yii::t('main', 'You are not allowed to withdraw this bid.'));
            }
//        } else {
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @return static
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
