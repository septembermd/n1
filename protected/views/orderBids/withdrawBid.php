<?php
$this->breadcrumbs = [
    Yii::t('main', 'Orders') => ['order/index'],
    $model->order->id => ['order/view', 'id' => $model->order->id],
    Yii::t('main', 'Decline Offer'),
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Decline Offer'); ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal">
            <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => [
                    'validateOnSubmit' => true,
                ],
            ]); ?>

            <?php echo $form->textAreaGroup($orderBidWithdrawForm, 'reason', ['type' => 'textarea', 'label' => Yii::t('main', 'Please, enter a message describing the reason of offer declining:')]); ?>

            <?php $this->widget(
                'booster.widgets.TbButton',
                [
                    'label' => Yii::t('main', 'Cancel'),
                    'context' => 'primary',
                    'buttonType' => 'link',
                    'url' => ['orderBids/bestOffer', 'orderId' => $orderBidWithdrawForm->orderBid->order_id],
                ]
            ); ?>

            <?php echo CHtml::submitButton(Yii::t('main', 'Decline Offer'), ['class' => 'btn btn-primary btn-large']); ?>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>