<?php

class SupplierController extends Controller
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
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        $acl = $this->acl;

        return [
            ['allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => ['admin', 'create', 'update', 'delete'],
                'expression' => function() use ($acl) {
                    return $acl->canPerformSuppliersAdminActions();
                },
            ],
            ['deny',  // deny all users
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Supplier;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Supplier'])) {
            $model->attributes = $_POST['Supplier'];
            if ($model->save()) {
                $this->redirect(['admin']);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        /** @var Supplier $model */
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Supplier'])) {
            $model->attributes = $_POST['Supplier'];
            if ($model->save()) {
                $this->redirect(['admin']);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request

            /** @var Supplier $model */
            $model = $this->loadModel($id);
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Supplier('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Supplier'])) {
            $model->attributes = $_GET['Supplier'];
        }
        $this->render('admin', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param string $id the $integer ID of the model to be loaded
     * @return static
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Supplier::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'supplier-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
