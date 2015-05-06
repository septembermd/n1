<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('main', 'Пользователи'),
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);

$gridColumns = array(
    array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
    array('name'=>'company_id', 'header'=>Yii::t('main', 'Компания'), 'value' => function($data){ return $data->company->title; }),
    array('name'=>'fullname', 'header'=>Yii::t('main', 'Имя')),
    array('name'=>'email', 'header'=>Yii::t('main', 'Email')),
    array('name'=>'phone', 'header'=>Yii::t('main', 'Телефон')),
    array('name'=>'role_id', 'header'=>Yii::t('main', 'Роль'), 'value' => function($data){ return User::getRoleLabel($data->role_id); }),
    array('name'=>'is_active', 'header'=>Yii::t('main', 'Активен'), 'value' => function($data){ return User::getUserStateLabel($data->is_active); }),
    array('name'=>'created', 'header'=>Yii::t('main', 'Создан')),
    array(
        'htmlOptions' => array('nowrap'=>'nowrap'),
        'class'=>'booster.widgets.TbButtonColumn',
        'viewButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/view', array('id'=>$data['id']));
        },
        'updateButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/update', array('id'=>$data['id']));
        },
        'deleteButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/delete', array('id'=>$data['id']));
        },
    )
);
?>

<?php echo CHtml::link(Yii::t('main', 'Добавить Пользователя'), array('user/create'), array('class'=>'btn btn-info pull-right')) ?>

<?php $this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped',
	'dataProvider' => $dataProvider,
    'template' => "{items}",
    'columns' => $gridColumns,
)); ?>