<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row">
    <div class="col-md-12">
        <h1><?php echo Yii::t('main', 'Login'); ?></h1>

        <p><?php echo Yii::t('main', 'Please fill out the following form with your login credentials'); ?>:</p>

        <div class="form">
        <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
            <?php echo $form->textFieldGroup($model,'username'); ?>

            <?php echo $form->passwordFieldGroup($model,'password'); ?>

            <?php echo CHtml::submitButton(Yii::t('main', 'Login'), array('class' => 'btn btn-primary btn-large')); ?>

            <?php echo $form->checkBoxGroup($model,'rememberMe'); ?>

            <p><?php echo CHtml::link(Yii::t('main', 'Запросить доступ'), array('site/accessRequest'));?></p>
            <p><?php echo CHtml::link(Yii::t('main', 'Забыли пароль'), array('site/accessRestoreRequest'));?></p>

        <?php $this->endWidget(); ?>
        </div><!-- form -->

    </div>
</div>