<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    Yii::t('main', 'Users'),
];

$this->menu = [
    ['label' => Yii::t('main', 'Create User'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Users'), 'url' => ['index']],
];

$gridColumns = [
    ['name' => 'id', 'header' => '#', 'htmlOptions' => ['style' => 'width: 60px']],
    ['name' => 'fullname', 'header' => Yii::t('main', 'Name')],
    ['name' => 'email', 'header' => Yii::t('main', 'Email')],
    ['name' => 'company_id', 'header' => Yii::t('main', 'Company'), 'value' => function ($data) {
        return $data->company->title;
    }],
    ['name' => 'phone', 'header' => Yii::t('main', 'Phone')],
    ['name' => 'role_id', 'header' => Yii::t('main', 'Role'), 'value' => function ($data) {
        return User::getRoleLabel($data->role_id);
    }],
    ['name' => 'is_active', 'header' => Yii::t('main', 'Active'), 'value' => function ($data) {
        return User::getUserStateLabel($data->is_active);
    }],
    ['name' => 'created', 'header' => Yii::t('main', 'Created')],
    [
        'htmlOptions' => ['nowrap' => 'nowrap'],
        'class' => 'booster.widgets.TbButtonColumn',
        'viewButtonUrl' => function ($data) {
            return Yii::app()->createUrl('user/view', ['id' => $data['id']]);
        },
        'updateButtonUrl' => function ($data) {
            return Yii::app()->createUrl('user/update', ['id' => $data['id']]);
        },
        'deleteButtonUrl' => function ($data) {
            return Yii::app()->createUrl('user/delete', ['id' => $data['id']]);
        },
    ]
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Users'); ?></h3>
        <?php echo CHtml::link(Yii::t('main', 'Create User'), ['user/create'], ['class' => 'btn btn-info pull-right']) ?>
    </div>
    <div class="panel-body">
        <?php $this->widget('booster.widgets.TbGridView', [
            'type' => 'striped',
            'dataProvider' => $dataProvider,
            'template' => '{items}{pager}',
            'columns' => $gridColumns,
        ]); ?>
    </div>
</div>