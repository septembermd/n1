<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', [
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
]); ?>

		<?php echo $form->textFieldGroup($model,'id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

		<?php echo $form->textFieldGroup($model,'creator_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

		<?php echo $form->textFieldGroup($model,'currency_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->dropDownListGroup($model,'status_id', ['widgetOptions'=> ['data'=> ["1"=>"1","2"=>"2","3"=>"3","4"=>"4",], 'htmlOptions'=> ['class'=>'input-large']]]); ?>

		<?php echo $form->textFieldGroup($model,'supplier_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

		<?php echo $form->textFieldGroup($model,'loading_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

		<?php echo $form->textFieldGroup($model,'delivery_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>9]]]); ?>

		<?php echo $form->textFieldGroup($model,'temperature_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'remark_id', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'valid_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'load_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'deliver_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'loaded_on_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'delivered_on_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->textFieldGroup($model,'deleted_on_date', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

		<?php echo $form->dropDownListGroup($model,'is_deleted', ['widgetOptions'=> ['data'=> ["0"=>"0","1"=>"1",], 'htmlOptions'=> ['class'=>'input-large']]]); ?>

		<?php echo $form->textFieldGroup($model,'created', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5']]]); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', [
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
        ]); ?>
	</div>

<?php $this->endWidget(); ?>
