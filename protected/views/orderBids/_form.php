<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', [
	'id'=>'order-bids-form',
	'enableAjaxValidation'=>false,
]); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'user_id'); ?>

	<?php echo $form->hiddenField($model,'order_id'); ?>

	<?php echo $form->textFieldGroup($model,'cost', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>7]]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType'=>'link',
        'url' => ['order/view', 'id' => $model->order_id],
        'context'=>'danger',
        'label'=>Yii::t('main', 'Cancel'),
    ]); ?>
	<?php $this->widget('booster.widgets.TbButton', [
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>Yii::t('main', $model->isNewRecord ? 'Send Request' : 'Update'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
