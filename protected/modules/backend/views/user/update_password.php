<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<legend>Update User <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form_password',array('model'=>$model)); ?>