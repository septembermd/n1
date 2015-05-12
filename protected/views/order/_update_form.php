<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', [
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
]); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'item_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

	<?php echo $form->dropDownListGroup($model, 'currency_id', ['widgetOptions'=> ['data'=>Currency::getList(), 'htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->dropDownListGroup($model,'status_id', ['widgetOptions'=> ['data'=>OrderStatus::getList(), 'htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->textFieldGroup($model,'temperature_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->textFieldGroup($model,'supplier_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

	<?php echo $form->textFieldGroup($model,'loading_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

	<?php echo $form->textFieldGroup($model,'delivery_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

	<?php echo $form->textFieldGroup($model,'created', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->textFieldGroup($model,'due_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->textFieldGroup($model,'remark_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

	<?php echo $form->dropDownListGroup($model,'is_deleted', ['widgetOptions'=> ['data'=> ["0"=>"0","1"=>"1",], 'htmlOptions'=> ['class'=>'input-large']]]); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', [
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
    ]); ?>
</div>

<?php $this->endWidget(); ?>
