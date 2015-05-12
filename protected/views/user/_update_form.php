<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', [
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
]); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model,'role_id', ['widgetOptions'=> ['data'=>User::$roleMap,'htmlOptions'=> ['class'=>'span5']]]); ?>

<?php echo $form->dropDownListGroup($model,'company_id', ['widgetOptions'=> ['data'=>Company::getList(),'htmlOptions'=> ['class'=>'span5','maxlength'=>5]]]); ?>

<?php echo $form->textFieldGroup($model,'fullname', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>100]]]); ?>

<?php echo $form->textFieldGroup($model,'email', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>100]]]); ?>

<?php echo $form->textFieldGroup($model,'phone', ['widgetOptions'=> ['htmlOptions'=> ['class'=>'span5','maxlength'=>20]]]); ?>

<?php echo $form->textFieldGroup($model,'new_password', ['widgetOptions'=> ['htmlOptions'=> ['placeholder'=>Yii::t('main', 'Leave blank if you don\'t wish to change'),'class'=>'span5','maxlength'=>255]]]); ?>

<?php echo $form->dropDownListGroup($model,'is_active', ['widgetOptions'=> ['data'=>User::$userStateList, 'htmlOptions'=> ['class'=>'input-large']]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType'=>'submit',
        'context'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    ]); ?>
</div>

<?php $this->endWidget(); ?>
