<?php
$this->breadcrumbs = array(
    Yii::t('main', 'Email Templates') => array('admin'),
    $model->slug,
);

$this->menu = array(
    array('label' => Yii::t('main', 'Manage Email Templates'), 'url' => array('admin')),
    array('label' => Yii::t('main', 'Update Email Template'), 'url' => array('update', 'id' => $model->id)),
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo $model->subject; ?>
            <span class="label label-success"><?php echo $model->slug; ?></span>
        </h3>
        <?php echo CHtml::link(Yii::t('main', 'Back'), ['admin'], ['class' => 'btn btn-primary pull-right']); ?>
    </div>
    <div class="panel-body">
        <pre><?php echo CHtml::decode($model->body); ?></pre>
    </div>
    <div class="panel-footer">
        <?php echo CHtml::link(Yii::t('main', 'Update'), ['emailTemplate/update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    </div>
</div>