<?php
$this->breadcrumbs = [
    'Suppliers' => ['admin'],
    'Create',
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Supplier'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Suppliers'), 'url' => ['index']],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('main', 'Create Supplier'); ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>