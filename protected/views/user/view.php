<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs= [
	'Users' => $this->acl->canPerformUsersAdminActions() ? ['index'] : false,
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

<?php echo CHtml::link(Yii::t('main', 'Back'), ['user/index'], ['class'=>'btn btn-info pull-right']) ?>

<?php $this->widget('zii.widgets.CDetailView', [
	'data'=>$model,
	'attributes'=> [
        [
            'label' => Yii::t('main', 'Company'),
            'value' => $model->company->title
        ],
        [
            'label' => Yii::t('main', 'User Name'),
            'value' => $model->fullname
        ],
        [
            'label' => Yii::t('main', 'User Role'),
            'value' => User::getRoleLabel($model->role_id)
        ],
        [
            'label' => Yii::t('main', 'Email'),
            'value' => $model->email
        ],
        [
            'label' => Yii::t('main', 'Phone'),
            'value' => $model->phone
        ],
    ],
]); ?>
