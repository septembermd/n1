<?php
$this->breadcrumbs=array(
	'Settings'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'Update Setting','url'=>array('update','id'=>$model->id)),
	array('label'=>'Manage Settings','url'=>array('admin')),
);
?>

<legend>View Setting #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
