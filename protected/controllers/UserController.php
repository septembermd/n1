<?php

class UserController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
            ['allow',  // allow authenticated user to perform 'view' action
                'actions' => ['view'],
                'users' => ['@'],
            ],
            ['allow', // allow admin users to perform actions
                'actions' => ['index', 'create', 'update', 'delete'],
                'expression' => function () use ($acl) {
                    return $acl->canPerformUsersAdminActions();
                },
            ],
            ['deny',  // deny all users
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     * @throws CHttpException
     */
    public function actionView($id)
    {
        $user = $this->loadModel($id);
        if (!$this->acl->canViewUser($user)) {
            throw new CHttpException(403, Yii::t('main', 'You are not allowed to view this user.'));
        }
        $this->render('view', [
            'model' => $user,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new User('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        // trigger event created
        $event = new UserCreatedEvent($model);
        $model->onUserCreated = [$event, 'sendMail'];

        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);
            $model->setAttribute('created', date('Y-m-d H:i:s'));

            if ($model->validate(null, false)) {
                $model->setPassword($model->password);
                if ($model->save()) {
                    $this->redirect(['view', 'id' => $model->id]);
                }
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
        /** @var User $model */
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);
            $model->setScenario('update');

            // Don't allow user to disable his own account
            if (!$model->isActive() && $model->isSelf($this->acl->getUser())) {
                $model->addError('is_active', Yii::t('main', 'You cannon disable your own profile.'));
            }

            if ($model->validate(null, false)) {
                if ($model->save()) {
                    $this->redirect(['view', 'id' => $model->id]);
                }
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
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @param $event
     */
    public function onUserCreated($event)
    {
        $user = $event->sender;
    }
}
