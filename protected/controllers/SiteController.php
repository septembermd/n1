<?php

class SiteController extends Controller
{
    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions' => ['login', 'accessRequest', 'accessRestoreRequest'],
                'users' => ['?'],
                'deniedCallback' => [$this, 'redirectToHomePage']
            ],
            ['allow',
                'actions' => ['index', 'logout'],
                'users' => ['@'],
                'deniedCallback' => [$this, 'redirectToLoginPage']
            ],
            ['allow',
                'actions' => ['error'],
                'users' => ['*']

            ],
            ['deny',  // deny all users
                'users' => ['*'],
                'message' => Yii::t('main', 'This page can be accessed by unauthorized users only.'),
            ],
        ];
    }

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return [
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=> [
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
            ],
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=> [
				'class'=>'CViewAction',
            ],
        ];
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        $error = Yii::app()->errorHandler->error;
		if ($error) {
			if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
				$this->render('error', $error);
            }
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', ['model'=>$model]);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = 'login';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
		}
		// display the login form
		$this->render('login', ['model'=>$model]);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirectToLoginPage();
	}

    /**
     * Request access page
     */
    public function actionAccessRequest()
    {
        $this->layout = 'login';
        $this->render('accessRequest');
    }

    /**
     * Restore access request page
     */
    public function actionAccessRestoreRequest()
    {
        $this->layout = 'login';
        $this->render('accessRestoreRequest');
    }
}