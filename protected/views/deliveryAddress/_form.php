<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'delivery-address-form',
    'enableAjaxValidation' => false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'country_id', ['widgetOptions' => ['data' => Country::getList(), 'htmlOptions' => ['class' => 'span5']]]); ?>

<?php echo $form->textFieldGroup($model, 'address', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
