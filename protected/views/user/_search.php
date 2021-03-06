<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', [
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
]); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id', ['size'=>9,'maxlength'=>9]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id', ['size'=>5,'maxlength'=>5]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname', ['size'=>60,'maxlength'=>100]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email', ['size'=>60,'maxlength'=>100]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone', ['size'=>20,'maxlength'=>20]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salt'); ?>
		<?php echo $form->textField($model,'salt', ['size'=>60,'maxlength'=>255]); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role_id'); ?>
		<?php echo $form->textField($model,'role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active', ['size'=>1,'maxlength'=>1]); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('main', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->