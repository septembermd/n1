<?php
    /**
    * @var $this BackendController
    * @var $model BackendLoginForm
    * @var $form CActiveForm
    */
?>
<div class="login_box">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>

    <div class="top_b"><?php echo Yii::app()->name; ?> &raquo; Admin Area</div>
    <?php if($model->hasErrors('password')): ?>
        <div class="alert alert-error alert-login">
            <?php echo $form->error($model, 'password'); ?>
        </div>
    <?php endif; ?>
    <div class="cnt_b">
        <div class="formRow">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span><?php echo $form->textField($model, 'username', array('placeholder' => 'Usename')); ?>
            </div>
        </div>
        <div class="formRow">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span><?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password')); ?>
            </div>
        </div>
        <div class="formRow clearfix">
            <?php echo $form->checkBox($model, 'rememberMe',array('class'=>'rme')); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
        </div>
    </div>
    <div class="btm_b clearfix">
        <?php echo CHtml::submitButton('Sign in', array("class" => "btn btn-inverse pull-right")); ?>
    </div>
    <?php $this->endWidget(); ?>

</div>