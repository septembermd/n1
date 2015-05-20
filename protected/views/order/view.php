<?php
$this->breadcrumbs = [
    'Orders' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Order #<?php echo $model->id; ?></h3>
    </div>
    <div class="panel-body">
        <?php $this->widget('booster.widgets.TbDetailView', [
            'data' => $model,
            'attributes' => [
                'id',
                [
                    'name' => 'creator.fullname',
                    'label' => Yii::t('main', 'Creator'),
                    'type' => 'raw',
                    'value' => function($order) {
                        return CHtml::link($order->creator->fullname, ['user/view', 'id' => $order->creator_id]);
                    }
                ],
                [
                    'name' => 'status_id',
                    'label' => Yii::t('main', 'Status'),
                    'value' => Order::getStatusLabel($model->status_id)
                ],
                [
                    'name' => 'currency.title',
                    'label' => Yii::t('main', 'Currency')
                ],
                [
                    'name' => 'supplier.title',
                    'label' => Yii::t('main', 'Supplier Company'),
                ],
                [
                    'name' => 'loading.country.title',
                    'label' => Yii::t('main', 'Supplier Country')
                ],
                [
                    'name' => 'loading.address',
                    'label' => Yii::t('main', 'Supplier Address')
                ],

                [
                    'name' => 'delivery.country.title',
                    'label' => Yii::t('main', 'Delivery Country')
                ],
                [
                    'name' => 'delivery.address',
                    'label' => Yii::t('main', 'Delivery Address')
                ],
                [
                    'name' => 'temperature.title',
                    'label' => Yii::t('main', 'Temperature Control')
                ],
                [
                    'name' => 'carrier.company.title',
                    'label' => Yii::t('main', 'Hauler'),
                    'type' => 'raw',
                    'value' => function($order) {
                        if ($order->carrier) {
                            return CHtml::link($order->carrier->fullname, ['user/view', 'id' => $order->carrier_id]);
                        }
                    }
                ],
//		'remark_id',
                'valid_date',
                'load_date',
                'deliver_date',
                'loaded_on_date',
                'delivered_on_date',
//		'deleted_on_date',
//		'is_deleted',
                'created',
            ],
        ]); ?>

        <h3><?php echo Yii::t('main', 'Order Items'); ?>:</h3>
        <?php $this->widget(
            'booster.widgets.TbGridView',
            [
                'dataProvider' => new CArrayDataProvider($model->orderItems),
                'template' => "{items}",
                'columns' => [
                    ['name' => 'type', 'header' => 'Type'],
                    ['name' => 'amount', 'header' => 'Amount'],
                ],
            ]
        );?>
    </div>
    <div class="panel-footer">
        <?php $this->widget('OrderControlsWidget', ['acl' => $this->acl, 'model' => $model]); ?>
    </div>
</div>



