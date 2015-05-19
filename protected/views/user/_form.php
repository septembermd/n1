<?php
Yii::app()->clientScript->registerScriptFile("/js/scripts/user/form.js", CClientScript::POS_END);
/** @var User $model */

/** @var TbActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => [
        'data-phone-prototype' => $this->renderPartial(
            '/user/_prototype_phone',
            [
                'model' => $model,
                'index' => '__proto_name__',
                'value' => '',
                'display' => 'block',
            ],
            true
        )
    ]
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

<h5><strong><?php echo Yii::t('main', 'Phone Numbers'); ?>:</strong></h5>

<?php
if(empty($model->phone_numbers)) {
    $this->renderPartial('/user/_prototype_phone', [
        'model' => $model,
        'index' => 0,
        'value' => '',
        'display' => 'block'
    ]);
} else {
    foreach ($model->phone_numbers as $index => $phone) {
        $this->renderPartial('/user/_prototype_phone', [
            'model' => $model,
            'value' => $phone,
            'index' => $index,
            'display' => 'block'
        ]);
    }
}
?>

<div class="form-group clearfix">
    <?php echo CHtml::link(Yii::t('main', 'Add'), '#', ['class'=>'pull-right glyphicon glyphicon-plus btn btn-sm btn-default add-user-phone']); ?>
</div>

<?php if ($model->isNewRecord) : ?>
    <?php echo $form->textFieldGroup($model, 'password', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 255, 'autocomplete' => 'off']]]); ?>
<?php else : ?>
    <?php echo $form->textFieldGroup($model,'new_password', ['widgetOptions'=> ['htmlOptions'=> ['placeholder'=>Yii::t('main', 'Leave blank if you don\'t wish to change'),'class'=>'span5','maxlength'=>255]]]); ?>
<?php endif; ?>

<?php echo $form->dropDownListGroup($model, 'is_active', ['widgetOptions' => ['data' => User::$userStateList, 'htmlOptions' => ['class' => 'input-large']]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('main', $model->isNewRecord ? 'Create' : 'Save'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
