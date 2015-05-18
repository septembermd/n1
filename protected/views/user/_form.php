<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'user-form',
    'enableAjaxValidation' => false,
]); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListGroup($model, 'role_id', ['widgetOptions' => ['data' => User::$roleMap, 'htmlOptions' => ['class' => 'span5']]]); ?>

<?php echo $form->select2Group($model, 'company_id', [
    'widgetOptions' => [
        'options' => [
            'tags' => Company::getSelect2List(),
            'createSearchChoice' => 'js:function(term, data) {
                var filter = function() {
                   return this.text.localeCompare(term) === 0;
                };
                if ( $(data).filter(filter).length === 0 ) {
                    return {id:term, text:term};
                }
            }',

            'tokenSeparators' => [','],
            'maximumSelectionSize' => 1
        ],

        'asDropDownList' => false,
        'data' => Company::getList(),
        'htmlOptions' => ['class' => 'span5', 'maxlength' => 5]
    ]
]); ?>

<?php echo $form->textFieldGroup($model, 'fullname', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 100]]]); ?>

<?php echo $form->textFieldGroup($model, 'email', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 100]]]); ?>

<?php echo $form->textFieldGroup($model, 'phone', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 20]]]); ?>

<?php echo $form->textFieldGroup($model, 'password', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 255, 'autocomplete' => 'off']]]); ?>

<?php echo $form->dropDownListGroup($model, 'is_active', ['widgetOptions' => ['data' => User::$userStateList, 'htmlOptions' => ['class' => 'input-large']]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('main', $model->isNewRecord ? 'Create' : 'Save'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
