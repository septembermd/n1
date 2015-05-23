<?php
$this->breadcrumbs = array(
    Yii::t('main', 'Email Templates') => array('admin'),
    $model->subject => array('view', 'id' => $model->id),
    Yii::t('main', 'Update'),
);

$this->menu = array(
    array('label' => Yii::t('main', 'Manage Email Templates'), 'url' => array('admin')),
    array('label' => Yii::t('main', 'View Email Template'), 'url' => array('view', 'id' => $model->id)),
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php printf('%s `%s`', Yii::t('main', 'Update Email Template'), $model->slug); ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>