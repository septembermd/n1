<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'type'=>'horizontal',
)); ?>

<?php echo $model->requiredAlert(); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'surname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php if($model->isNewRecord){ ?>
    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>64)); ?>
    <?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>64)); ?>
<?php } ?>

<?php echo $form->checkBoxRow($model, 'is_active'); ?>

<?php echo $form->checkBoxRow($model, 'is_staff'); ?>



<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'label' => $model->isNewRecord ? 'Create' : 'Save',
)); ?>
</div>

<?php $this->endWidget(); ?>
