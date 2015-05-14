<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs= [
	'Users'=> ['index'],
	$model->id=> ['view','id'=>$model->id],
	'Update',
];

$this->menu= [
	['label'=>'List User', 'url'=> ['index']],
	['label'=>'Create User', 'url'=> ['create']],
	['label'=>'View User', 'url'=> ['view', 'id'=>$model->id]],
	['label'=>'Manage User', 'url'=> ['admin']],
];
?>

<h1>Update User <?php echo $model->fullname; ?></h1>

<?php echo CHtml::link(Yii::t('main', 'Back'), ['user/index'], ['class'=>'btn btn-info pull-right']) ?>

<?php $this->renderPartial('_update_form', ['model'=>$model]); ?>