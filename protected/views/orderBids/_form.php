<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'order-bids-form',
    'enableAjaxValidation' => false,
]); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'user_id'); ?>

<?php echo $form->hiddenField($model, 'order_id'); ?>


<p class="help-block"><?php echo Yii::t('main', 'Please, note that currency is set to: <strong>{currency}</strong>', ['{currency}' => $model->order->currency->title]); ?></p>

<?php echo $form->textFieldGroup($model, 'cost', [
    'widgetOptions' => [
        'htmlOptions' => [
            'class' => 'span5',
            'maxlength' => 7,
            'autocomplete' => 'off',
            'placeholder' => Yii::t('main', 'Currency: {currency}', ['{currency}' => $model->order->currency->title])]
        ]
    ]
); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'link',
        'url' => ['order/view', 'id' => $model->order_id],
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
