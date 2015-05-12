<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs= [
	'Users'=> ['index'],
	sprintf("%s (%s)", $model->fullname, User::getRoleLabel($model->role_id)),
];

$this->menu= [
	['label'=>'List User', 'url'=> ['index']],
	['label'=>'Create User', 'url'=> ['create']],
	['label'=>'Update User', 'url'=> ['update', 'id'=>$model->id]],
	['label'=>'Delete User', 'url'=>'#', 'linkOptions'=> ['submit'=> ['delete','id'=>$model->id],'confirm'=>'Are you sure you want to delete this item?']],
	['label'=>'Manage User', 'url'=> ['admin']],
];
?>

<?php echo CHtml::link(Yii::t('main', 'Назад'), ['user/index'], ['class'=>'btn btn-info pull-right']) ?>

<?php $this->widget('zii.widgets.CDetailView', [
	'data'=>$model,
	'attributes'=> [
        [
            'label' => Yii::t('main', 'Компания'),
            'value' => $model->company->title
        ],
        [
            'label' => Yii::t('main', 'Имя пользователя'),
            'value' => $model->fullname
        ],
        [
            'label' => Yii::t('main', 'Роль пользователя'),
            'value' => User::getRoleLabel($model->role_id)
        ],
        [
            'label' => Yii::t('main', 'Email'),
            'value' => $model->email
        ],
        [
            'label' => Yii::t('main', 'Телефон'),
            'value' => $model->phone
        ],
    ],
]); ?>
