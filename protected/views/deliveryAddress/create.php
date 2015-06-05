<?php
$this->breadcrumbs = array(
    'Delivery Addresses' => array('admin'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage DeliveryAddress', 'url' => array('admin')),
);
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Create Delivery Address'); ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>