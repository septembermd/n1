<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = [
    'Users' => ['index'],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create User'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Users'), 'url' => ['index']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Update User'); ?></h3>
        <?php echo CHtml::link(Yii::t('main', 'Back'), ['user/index'], ['class' => 'btn btn-info pull-right']) ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>