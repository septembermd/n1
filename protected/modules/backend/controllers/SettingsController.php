<?php

class SettingsController extends BackendController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
    public $sidebar_tab = "configuration";
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

    public function actionEditable(){
        Yii::import('ext.editable.EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('Settings');  // 'User' is classname of model to be updated
        $es->update();
    }

	public function actionCreate()
	{
		$model=new Settings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
/*	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if (isset($_FILES["Settings"]["name"]["file"]))
        {
             $filename = $_FILES["Settings"]["name"]["file"];
             $type = explode('.', $filename);
             $tyre = $type[count($type) - 1];
             $tyre = strtolower($tyre);
             if ($tyre != 'jpg' && $tyre != 'gif' && $tyre != 'png')
             {
                 Yii::app()->user->setFlash('error', Yii::t("main", "Файл должен быть картинкой"));
                 $this->redirect(Yii::app()->request->urlReferrer);
             }
             $model->value = 'images/'.$_FILES["Settings"]["name"]["file"];
             if ($model->save()) {
                 $obj =  CUploadedFile::getInstance($model, 'file');
                 $obj->saveAs('images/'.$_FILES["Settings"]["name"]["file"]);
                      $this->redirect(array('view','id'=>$model->id));
             }
        }

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        if ($id == 1)
        {
            $this->render('photo',array(
                'model'=>$model,
            ));
        }
        elseif ($id == 4)
        {
            $this->render('photo',array(
                'model'=>$model,
            ));
        }

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Settings']))
        {
            $model->scenario = 'nonfile';
            $model->attributes=$_POST['Settings'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        if (isset($_FILES["Settings"]["name"]["value"]))
        {
            $model->scenario = 'file';
            $model->value=$_FILES["Settings"]["name"]["value"];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        if ($id == 1)
        {
            $this->render('photo',array(
                'model'=>$model,
            ));
            Yii::app()->end();
        }
        elseif ($id == 4)
        {
            $this->render('photo',array(
                'model'=>$model,
            ));
            Yii::app()->end();
        }


        $this->render('update',array(
            'model'=>$model,
        ));
    }



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Settings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
