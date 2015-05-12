<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs= [
	Yii::t('main', 'Пользователи'),
];

$this->menu= [
	['label'=>'Create User', 'url'=> ['create']],
	['label'=>'Manage User', 'url'=> ['admin']],
];

$gridColumns = [
    ['name'=>'id', 'header'=>'#', 'htmlOptions'=> ['style'=>'width: 60px']],
    ['name'=>'company_id', 'header'=>Yii::t('main', 'Компания'), 'value' => function($data){ return $data->company->title; }],
    ['name'=>'fullname', 'header'=>Yii::t('main', 'Имя')],
    ['name'=>'email', 'header'=>Yii::t('main', 'Email')],
    ['name'=>'phone', 'header'=>Yii::t('main', 'Телефон')],
    ['name'=>'role_id', 'header'=>Yii::t('main', 'Роль'), 'value' => function($data){ return User::getRoleLabel($data->role_id); }],
    ['name'=>'is_active', 'header'=>Yii::t('main', 'Активен'), 'value' => function($data){ return User::getUserStateLabel($data->is_active); }],
    ['name'=>'created', 'header'=>Yii::t('main', 'Создан')],
    [
        'htmlOptions' => ['nowrap'=>'nowrap'],
        'class'=>'booster.widgets.TbButtonColumn',
        'viewButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/view', ['id'=>$data['id']]);
        },
        'updateButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/update', ['id'=>$data['id']]);
        },
        'deleteButtonUrl'=>function($data){
            return Yii::app()->createUrl('user/delete', ['id'=>$data['id']]);
        },
    ]
];
?>

<?php echo CHtml::link(Yii::t('main', 'Добавить Пользователя'), ['user/create'], ['class'=>'btn btn-info pull-right']) ?>

<?php $this->widget('booster.widgets.TbGridView', [
    'type' => 'striped',
	'dataProvider' => $dataProvider,
    'template' => "{items}",
    'columns' => $gridColumns,
]); ?>