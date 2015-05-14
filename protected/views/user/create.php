<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs= [
	'Users'=> ['index'],
	'Create',
];

$this->menu= [
	['label'=>'List User', 'url'=> ['index']],
	['label'=>'Manage User', 'url'=> ['admin']],
];
?>

<h1>Create User</h1>

<?php echo CHtml::link(Yii::t('main', 'Back'), ['user/index'], ['class'=>'btn btn-info pull-right']) ?>

<?php $this->renderPartial('_form', ['model'=>$model]); ?>