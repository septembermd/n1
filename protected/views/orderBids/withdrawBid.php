<div class="form">
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]); ?>

    <?php echo $form->textAreaGroup($model, 'reason', ['type' => 'textarea', 'label' => Yii::t('main', 'Please, enter a message describing the reason of offer declining:')]); ?>

    <?php $this->widget(
        'booster.widgets.TbButton',
        [
            'label' => Yii::t('main', 'Cancel'),
            'context' => 'primary',
            'buttonType' => 'link',
            'url' => ['orderBids/bestOffer', 'orderId' => $model->orderBid->order_id],
        ]
    ); ?>

    <?php echo CHtml::submitButton(Yii::t('main', 'Decline Offer'), ['class' => 'btn btn-primary btn-large']); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->