<?php
$this->breadcrumbs = [
    'Orders' => ['index'],
    'Accomplish Order',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>

<h1><?php echo Yii::t('main', 'Accomplish Order'); ?></h1>

<p><?php echo Yii::t('main', 'Please, add your remark to quality of transportation'); ?></p>

<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'order-bids-form',
    'enableAjaxValidation' => false,
]); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->hiddenField($model, 'id'); ?>

<?php echo $form->dropDownListGroup($model, 'remark_id', ['widgetOptions' => ['data' => Remark::getList(), 'htmlOptions' => ['class' => 'span5', 'maxlength' => 7]]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'link',
        'url' => ['order/view', 'id' => $model->id],
        'context' => 'danger',
        'label' => Yii::t('main', 'Cancel'),
    ]); ?>
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('main', $model->isNewRecord ? 'Send Request' : 'Update'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
