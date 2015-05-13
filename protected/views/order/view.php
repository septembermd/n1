<?php
$this->breadcrumbs= [
	'Orders'=> ['index'],
	$model->id,
];

$this->menu= [
['label'=>'List Order','url'=> ['index']],
['label'=>'Create Order','url'=> ['create']],
['label'=>'Update Order','url'=> ['update','id'=>$model->id]],
['label'=>'Delete Order','url'=>'#','linkOptions'=> ['submit'=> ['delete','id'=>$model->id],'confirm'=>'Are you sure you want to delete this item?']],
['label'=>'Manage Order','url'=> ['admin']],
];
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView', [
'data'=>$model,
'attributes'=> [
		'id',
        [
            'name'=>'creator.fullname',
            'label' => 'Creator'
        ],
		[
            'name' => 'status_id',
            'label' => 'Status',
            'value' => Order::getStatusLabel($model->status_id)
        ],
        [
            'name'=>'currency.title',
            'label' => 'Currency'
        ],
        [
            'name'=>'supplier.title',
            'label' => 'Supplier'
        ],
        [
            'name'=>'loading.address',
            'label' => 'Loading Address'
        ],
        [
            'name'=>'delivery.address',
            'label' => 'Delivery Address'
        ],
        [
            'name'=>'temperature.title',
            'label' => 'Temperature'
        ],
        [
            'name'=>'carrier.company.title',
            'label' => 'Carrier'
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

<h3><?php echo Yii::t('main', 'Order Items');?>:</h3>

<?php $this->widget(
    'booster.widgets.TbGridView',
    [
        'dataProvider' => new CArrayDataProvider($model->orderItems),
        'template' => "{items}",
        'columns' => [
            ['name'=>'type', 'header'=>'Type'],
            ['name'=>'amount', 'header'=>'Amount'],
        ],
    ]
);

$this->widget('OrderControlsWidget', ['acl' => $this->acl, 'model' => $model]);
?>