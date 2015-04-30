<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<legend>Create User</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>