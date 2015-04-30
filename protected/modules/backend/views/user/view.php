<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User','url'=>array('admin')),
	array('label'=>'Change Password','url'=>array('updatePassword','id'=>$model->id)),
);
?>

<legend>View User #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'username',
        'name',
        'surname',
        'email',
        'is_active:boolean',
        'is_staff:boolean',
        'last_login',
        'date_joined',
    ),
)); ?>