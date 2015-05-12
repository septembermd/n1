<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs= [
	'Login',
];
?>
<div class="row">
    <div class="col-md-12">
        <h1><?php echo Yii::t('main', 'Login'); ?></h1>

        <p><?php echo Yii::t('main', 'Please fill out the following form with your login credentials'); ?>:</p>

        <div class="form">
        <?php $form=$this->beginWidget('booster.widgets.TbActiveForm', [
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=> [
                'validateOnSubmit'=>true,
            ],
        ]); ?>
            <?php echo $form->textFieldGroup($model,'username'); ?>

            <?php echo $form->passwordFieldGroup($model,'password'); ?>

            <?php echo CHtml::submitButton(Yii::t('main', 'Login'), ['class' => 'btn btn-primary btn-large']); ?>

            <?php echo $form->checkBoxGroup($model,'rememberMe'); ?>

            <p><?php echo CHtml::link(Yii::t('main', 'Запросить доступ'), ['site/accessRequest']);?></p>
            <p><?php echo CHtml::link(Yii::t('main', 'Забыли пароль'), ['site/accessRestoreRequest']);?></p>

        <?php $this->endWidget(); ?>
        </div><!-- form -->

    </div>
</div>