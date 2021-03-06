<?php
/** @var TbActiveForm $form */
/** @var Order $model */
Yii::app()->clientScript->registerScript('orderStatusMap', "ORDER_STATUS = $.parseJSON('".CJSON::encode(Order::getStatusMap())."');");
Yii::app()->clientScript->registerScriptFile("/js/scripts/order/form.js", CClientScript::POS_END);
?>
<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'id' => 'order-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => [
        'data-orderItem-prototype' => $this->renderPartial(
            '/orderItems/_prototype_form',
            [
                'model' => new OrderItems(),
                'index' => '__proto_name__',
                'display' => 'block',
            ],
            true
        )
    ]
]); ?>

<?php echo $form->errorSummary($model); ?>

<?php if ($model->isNewRecord || $model->isDraft() || $model->isHaulerNeeded()) {
    echo $form->hiddenField($model, 'status_id', ['value' => Order::STATUS_HAULER_NEEDED]);
} ?>

<?php echo $form->dropDownListGroup($model, 'supplier_id', [
    'widgetOptions' => [
        'data' => Supplier::getList(),
        'htmlOptions' => [
            'class' => 'span5',
            'maxlength' => 9,
            'ajax' => [
                'type' => 'POST',
                'url' => ['getLoadingAddressList'],
                'update' => '#Order_loading_id',
                'error' => "function(data){
                    $('#Order_loading_id').empty().html('<option value=\"\">Select supplier address</option>');
                }"
            ],
            'empty' => 'Select supplier company'
        ]
    ]
]); ?>

<?php echo $form->dropDownListGroup($model, 'loading_id', [
    'widgetOptions' => [
        'data' => [],
        'htmlOptions' => [
            'class' => 'span5',
            'maxlength' => 9,
            'empty' => 'Select supplier address'
        ]
    ]
]); ?>

<?php echo $form->dropDownListGroup($model, 'delivery_id', [
    'widgetOptions' => [
        'data' => DeliveryAddress::getList(),
        'htmlOptions' => [
            'class' => 'span5',
            'maxlength' => 9,
            'empty' => 'Select delivery address'
        ]
    ]
]); ?>

<?php echo $form->dropDownListGroup($model, 'currency_id', [
    'widgetOptions' => [
        'data' => Currency::getList(),
        'htmlOptions' => [
            'class' => 'span5',
            'empty' => 'Select currency'
        ]
    ]
]); ?>

<?php echo $form->dropDownListGroup($model, 'temperature_id', [
    'widgetOptions' => [
        'data' => Temperature::getList(),
        'htmlOptions' => [
            'class' => 'span5',
            'empty' => 'Select temperature'
        ]
    ]
]); ?>

<?php echo $form->datePickerGroup($model, 'valid_date', [
    'widgetOptions' => [
        'options' => [
            'format' => 'yyyy-mm-dd',
            'startDate'=>'0d',
            'autoclose' => true
        ],
        'htmlOptions' => [
            'class' => 'span5',
            'placeholder' => 'Select date'
        ]
    ]
]); ?>

<?php echo $form->datePickerGroup($model, 'load_date', [
    'widgetOptions' => [
        'options' => [
            'format' => 'yyyy-mm-dd',
            'startDate'=>'0d',
            'autoclose' => true
        ],
        'htmlOptions' => [
            'class' => 'span5',
            'placeholder' => 'Select date'
        ]
    ]
]); ?>

<?php echo $form->datePickerGroup($model, 'deliver_date', [
    'widgetOptions' => [
        'options' => [
            'format' => 'yyyy-mm-dd',
            'startDate'=>'0d',
            'autoclose' => true
        ],
        'htmlOptions' => [
            'class' => 'span5',
            'placeholder' => 'Select date'
        ]
    ]
]); ?>

<h5><strong><?php echo Yii::t('main', 'Order Items'); ?>:</strong></h5>

<?php
if (empty($model->orderItems)) {
    $this->renderPartial('/orderItems/_prototype_form', [
        'model' => new OrderItems(),
        'index' => 0,
        'display' => 'block'
    ]);
} else {
    foreach ($model->orderItems as $index => $orderItem) {
        $this->renderPartial('/orderItems/_prototype_form', [
            'model' => $orderItem,
            'index' => $index,
            'display' => 'block'
        ]);
    }
}
?>

<div class="form-group">
    <?php echo CHtml::link(Yii::t('main', 'Add'), '#', ['class' => 'pull-right glyphicon glyphicon-plus btn btn-sm btn-default add-order-item']); ?>
</div>

<div class="form-actions text-center">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('main', $model->isNewRecord ? 'Create' : 'Save'),
    ]); ?>
</div>

<?php $this->endWidget(); ?>
