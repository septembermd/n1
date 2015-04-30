<?php
$this->breadcrumbs=array(
	'Settings'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Settings','url'=>array('admin')),
);
?>

<legend>Create Setting</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>