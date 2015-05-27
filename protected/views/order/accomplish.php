<?php
/** @var Order $model */

$this->breadcrumbs = [
    'Orders' => ['index'],
    'Accomplish Order',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Accomplish Order'); ?>
        </h3>
    </div>
    <div class="panel-body">
        <p><?php echo Yii::t('main', 'Please, add your remark to quality of transportation'); ?></p>

        <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
            'id' => 'order-bids-form',
            'enableAjaxValidation' => false,
        ]); ?>

        <?php echo $form->hiddenField($model, 'id'); ?>

        <?php echo $form->dropDownListGroup($model, 'remark_id', [
            'widgetOptions' => [
                'data' => Remark::getList(),
                'htmlOptions' => [
                    'class' => 'span5',
                    'maxlength' => 7,
                    'options' => [
                        Order::REMARK_SUCCESS => [
                            'disabled' => $model->isDeliveryDelayed()
                        ],
                        Order::REMARK_DELIVERY_DELAYED => [
                            'selected' => $model->isDeliveryDelayed()
                        ],
                        ORDER::REMARK_CARGO_SPOILED => [
                            'disabled' => $model->isDeliveryDelayed()
                        ]
                    ]
                ]
            ]
        ]); ?>

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

    </div>
</div>