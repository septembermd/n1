<?php
$this->breadcrumbs = [
    'Orders' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Create Order'); ?></h3>
        <?php echo CHtml::link(Yii::t('main', 'Save as Draft & Go Back'), ['order/index'], ['class' => 'btn btn-info pull-right']) ?>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>