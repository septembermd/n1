<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = [
    'Users' => $this->acl->canPerformUsersAdminActions() ? ['index'] : false,
    sprintf("%s (%s)", $model->fullname, User::getRoleLabel($model->role_id)),
];

$this->menu = [
    ['label' => Yii::t('main', 'Create User'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Users'), 'url' => ['index']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Profile'); ?></h3>
        <?php echo CHtml::link(Yii::t('main', 'Back'), "javascript: window.history.back();", ['class' => 'btn btn-info pull-right']) ?>
    </div>
    <div class="panel-body">
        <?php $this->widget('booster.widgets.TbDetailView', [
            'data' => $model,
            'attributes' => [
                [
                    'label' => Yii::t('main', 'User Name'),
                    'value' => $model->fullname
                ],
                [
                    'label' => Yii::t('main', 'Company'),
                    'value' => $model->company->title
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
    </div>
</div>
