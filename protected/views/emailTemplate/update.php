<?php
$this->breadcrumbs = [
    Yii::t('main', 'Email Templates') => ['admin'],
    $model->subject => ['view', 'id' => $model->id],
    Yii::t('main', 'Update'),
];

$this->menu = [
    ['label' => Yii::t('main', 'Manage Email Templates'), 'url' => ['admin']],
    ['label' => Yii::t('main', 'View Email Template'), 'url' => ['view', 'id' => $model->id]],
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php printf('%s `%s`', Yii::t('main', 'Update Email Template'), $model->slug); ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', ['model' => $model]); ?>
    </div>
</div>