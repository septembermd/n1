<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Create User</h1>

<?php echo CHtml::link(Yii::t('main', 'Назад'), array('user/index'), array('class'=>'btn btn-info pull-right')) ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>