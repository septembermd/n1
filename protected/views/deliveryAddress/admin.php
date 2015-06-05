<?php
/** @var DeliveryAddress $model */

$this->breadcrumbs = array(
    'Delivery Addresses' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Manage Delivery Address', 'url' => array('admin')),
    array('label' => 'Create DeliveryAddress', 'url' => array('create')),
);

?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo Yii::t('main', 'Delivery Address'); ?>
        </h3>
        <?php echo CHtml::link(Yii::t('main', 'Add new'), ['deliveryAddress/create'], ['class' => 'btn btn-info pull-right']); ?>
    </div>
    <div class="panel-body">
        <?php $this->widget('booster.widgets.TbGridView', [
            'id' => 'delivery-address-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => [
                [
                    'name' =>'country_id',
                    'value' => function ($model) {
                        return $model->country->title;
                    },
                    'filter' => false
                ],
                [
                    'name' => 'address',
                    'value' => function ($model) {
                        return $model->address;
                    },
                    'filter' => false
                ],
                [
                    'class' => 'booster.widgets.TbButtonColumn',
                    'template' => "{update} {delete}",
                ],
            ],

        ]); ?>
    </div>
</div>