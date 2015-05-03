<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'company_id'); ?>
        <?php echo $form->dropDownList($model,'company_id',Company::getList(), array()); ?>
        <?php echo $form->error($model,'company_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'fullname'); ?>
        <?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'fullname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'new password'); ?>
        <?php echo $form->textField($model,'new_password',array('size'=>60,'maxlength'=>255,)); ?>
        <?php echo $form->error($model,'new_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'role_id'); ?>
        <?php echo $form->dropDownList($model,'role_id', Role::getList()); ?>
        <?php echo $form->error($model,'role_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'is_active'); ?>
        <?php echo $form->dropDownList($model,'is_active',User::$userStateList, array()); ?>
        <?php echo $form->error($model,'is_active'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->