<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	sprintf("%s (%s)", $model->fullname, User::getRoleLabel($model->role_id)),
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php echo CHtml::link(Yii::t('main', 'Назад'), array('user/index'), array('class'=>'btn btn-info pull-right')) ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'label' => Yii::t('main', 'Компания'),
            'value' => $model->company->title
        ),
        array(
            'label' => Yii::t('main', 'Имя пользователя'),
            'value' => $model->fullname
        ),
        array(
            'label' => Yii::t('main', 'Роль пользователя'),
            'value' => User::getRoleLabel($model->role_id)
        ),
        array(
            'label' => Yii::t('main', 'Email'),
            'value' => $model->email
        ),
        array(
            'label' => Yii::t('main', 'Телефон'),
            'value' => $model->phone
        ),
	),
)); ?>
