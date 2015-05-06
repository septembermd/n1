<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Order','url'=>array('index')),
array('label'=>'Create Order','url'=>array('create')),
array('label'=>'Update Order','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
        array(
            'name'=>'creator.fullname',
            'label' => 'Creator'
        ),
		array(
            'name' => 'status_id',
            'label' => 'Status',
            'value' => Order::getStatusLabel($model->status_id)
        ),
        array(
            'name'=>'currency.title',
            'label' => 'Currency'
        ),
        'supplier_id',
        array(
            'name'=>'loading.address',
            'label' => 'Loading Address'
        ),
        array(
            'name'=>'delivery.address',
            'label' => 'Delivery Address'
        ),
        array(
            'name'=>'temperature.title',
            'label' => 'Temperature'
        ),
//		'remark_id',
		'valid_date',
		'load_date',
		'deliver_date',
//		'loaded_on_date',
//		'delivered_on_date',
//		'deleted_on_date',
//		'is_deleted',
		'created',
),
)); ?>

<h3><?php echo Yii::t('main', 'Order Items');?>:</h3>

<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'dataProvider' => new CArrayDataProvider($model->orderItems),
        'template' => "{items}",
        'columns' => array(
            array('name'=>'type', 'header'=>'Type'),
            array('name'=>'amount', 'header'=>'Amount'),
        ),
    )
);

$this->widget('OrderControlsWidget', array('acl' => $this->acl, 'model' => $model));
?>