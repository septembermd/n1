<?php
$this->breadcrumbs = [
    'Orders' => ['index'],
    'Manage',
];

$this->menu = [
    ['label' => 'List Order', 'url' => ['index']],
    ['label' => 'Create Order', 'url' => ['create']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Manage Orders'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php $this->widget('booster.widgets.TbGridView', [
            'id' => 'order-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => [
                [
                    'name' => 'id',
                    'htmlOptions' => ['width' => '4%']
                ],
                [
                    'name' => 'creator.fullname',
                    'header' => Yii::t('main', 'Creator'),
                    'type' => 'raw',
                    'value' => function($order) {
                        return CHtml::link($order->creator->fullname, ['user/view', 'id' => $order->creator_id]);
                    }
                ],
                [
                    'name' => 'carrier.fullname',
                    'header' => Yii::t('main', 'Carrier'),
                    'type' => 'raw',
                    'value' => function($order) {
                        return $order->carrier ? CHtml::link($order->carrier->fullname, ['user/view', 'id' => $order->carrier_id]) : Yii::t('main', 'Not set');
                    }
                ],
                [
                    'name' => 'currency.title',
                    'header' => Yii::t('main', 'Currency'),
                    'value' => function($order) {
                        return $order->currency->title;
                    }
                ],
                [
                    'name' => 'status_id',
                    'header' => Yii::t('main', 'Status'),
                    'value' => function($order) {
                        return Order::getStatusLabel($order->status_id);

                    },
                    'htmlOptions' => ['width' => '10%']
                ],
                [
                    'name' => 'supplier.fullname',
                    'header' => Yii::t('main', 'Supplier'),
                    'value' => function($order) {
                        return $order->supplier->title;
                    }
                ],
                [
                    'name' => 'loading.address',
                    'header' => Yii::t('main', 'Loading address'),
                    'value' => function($order) {
                        return sprintf("%s, %s", $order->loading->country->title, $order->loading->address);
                    }
                ],
                [
                    'name' => 'delivery.address',
                    'header' => Yii::t('main', 'Delivery address'),
                    'value' => function($order) {
                        return sprintf("%s, %s", $order->delivery->country->title, $order->delivery->address);
                    }
                ],
                /*
                'delivery_id',
                'temperature_id',
                'remark_id',
                'valid_date',
                'load_date',
                'deliver_date',
                'loaded_on_date',
                'delivered_on_date',
                'deleted_on_date',
                'is_deleted',
                'created',
                */
                [
                    'class' => 'booster.widgets.TbButtonColumn',
                ],
            ],
        ]); ?>

    </div>
</div>

