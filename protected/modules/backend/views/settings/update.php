<?php
$this->breadcrumbs=array(
	'Settings'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Setting','url'=>array('create')),
	array('label'=>'View Setting','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Settings','url'=>array('admin')),
);
?>

<legend>Update "<?php echo $model->name; ?>" Setting</legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>