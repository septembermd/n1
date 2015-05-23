<?php

class EmailTemplateController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
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

        return array(
            array('allow',  // allow all users to perform 'view', 'update', 'admin' actions
                'actions' => array('view', 'update', 'admin'),
                'expression' => function() use ($acl) {
                    return $acl->canManageEmailTemplates();
                },
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EmailTemplate'])) {
            $model->attributes = $_POST['EmailTemplate'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new EmailTemplate('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EmailTemplate']))
            $model->attributes = $_GET['EmailTemplate'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     * @return EmailTemplate
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        /** @var EmailTemplate $model */
        $model = EmailTemplate::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param EmailTemplate $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'email-template-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
