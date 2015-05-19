<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'supplier-form',
    'enableAjaxValidation' => false,
]); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'title', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 100]]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('main', $model->isNewRecord ? 'Create' : 'Save'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
