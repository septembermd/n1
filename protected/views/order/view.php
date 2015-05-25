<?php
/** @var OrderController $this */
/** @var Order $model */

$this->breadcrumbs = [
    'Orders' => ['index'],
    $model->id,
];

$this->menu = [
    ['label' => Yii::t('main', 'Create Order'), 'url' => ['create']],
    ['label' => Yii::t('main', 'Manage Order'), 'url' => ['admin']],
];
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Order #<?php echo $model->id; ?></h3>
    </div>
    <div class="panel-body">

        <div class="row text-center">
            <div class="col-md-2">
                <?php if ($this->acl->canViewOrderCreator($model)) : ?>
                    <h6>
                        <?php echo CHtml::encode($model->getAttributeLabel('creator_id')); ?>
                    </h6>
                    <?php echo CHtml::link($model->creator->fullname, ['user/view', 'id' => $model->creator_id]); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('id')); ?>
                </h6>
                <?php echo Order::getStatusLabel($model->status_id); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('status_id')); ?>
                </h6>
                <?php echo CHtml::link($model->creator->fullname, ['user/view', 'id' => $model->creator_id]); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('carrier_id')); ?>
                </h6>
                <?php echo $model->carrier
                    ? CHtml::link($model->carrier->fullname, ['user/view', 'id' => $model->carrier_id])
                    : Yii::t('main', 'No Hauler');
                ?>
            </div>
            <div class="col-md-2">
                <?php if ($this->acl->canViewOrderBidsCount()) : ?>
                    <h6>
                        <?php echo Yii::t('main', 'Number of Bids'); ?>
                    </h6>
                    <?php echo CHtml::encode($model->getBidsCount()); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="row text-center" style="margin-top: 15px;">
            <div class="col-md-6">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('supplier_id')); ?>
                </h6>
                <?php echo CHtml::encode($model->supplier->title); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('created')); ?>
                </h6>
                <?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->created); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('valid_date')); ?>
                </h6>
                <?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->valid_date); ?>
            </div>
        </div>

        <div class="row text-center" style="margin-top: 15px;">
            <div class="col-md-3">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('loading.country_id')); ?>
                </h6>
                <?php echo CHtml::encode($model->loading->country->title); ?>
            </div>
            <div class="col-md-3">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('delivery.country_id')); ?>
                </h6>
                <?php echo CHtml::encode($model->delivery->country->title); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('load_date')); ?>
                </h6>
                <?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->load_date); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('deliver_date')); ?>
                </h6>
                <?php echo Yii::app()->dateFormatter->format("dd MMMM yyyy", $model->deliver_date); ?>
            </div>
        </div>

        <div class="row text-center" style="margin-top: 15px;">
            <div class="col-md-3">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('loading.address')); ?>
                </h6>
                <?php echo CHtml::encode($model->loading->address); ?>
            </div>
            <div class="col-md-3">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('delivery.address')); ?>
                </h6>
                <?php echo CHtml::encode($model->delivery->address); ?>
            </div>
            <div class="col-md-2">
                <?php if ($model->isCarrierChosen()):?>
                    <h6>
                        <?php echo Yii::t('main', 'Delivery Cost'); ?>
                    </h6>
                    <?php echo CHtml::encode($model->getBidWon()->cost); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <?php if ($model->isCarrierChosen()):?>
                    <h6>
                        <?php echo $model->getAttributeLabel('currency_id') ?>
                    </h6>
                    <?php echo CHtml::encode($model->currency->title); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="row text-center" style="margin-top: 20px;">
            <div class="col-md-3">
                <h6>
                    <?php echo Yii::t('main', 'Cargo'); ?>
                </h6>
                <?php ;?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo Yii::t('main', 'Amount'); ?>
                </h6>
            </div>

            <div class="col-md-2">
                <h6>
                    <?php echo Yii::t('main', 'Temperature control'); ?>
                </h6>
                <?php echo CHtml::encode($model->temperature->title);?>
            </div>
            <div class="col-md-3">
                <?php if ($this->acl->canViewOrderRemark($model)) : ?>
                    <h6>
                        <?php echo Yii::t('main', 'Remark'); ?>
                    </h6>
                    <?php echo CHtml::encode($model->remark->title); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php foreach ($model->orderItems as $item) : ?>
        <div class="row text-center">
                <div class="col-md-3">
                    <?php echo CHtml::encode($item->type); ?>
                </div>

                <div class="col-md-2">
                    <?php echo CHtml::encode($item->amount); ?>
                </div>

        </div>
        <?php endforeach; ?>

        <?php /*$this->widget('booster.widgets.TbDetailView', [
            'data' => $model,
            'attributes' => [
                'id',
                [
                    'name' => 'creator.fullname',
                    'label' => $model->getAttributeLabel('creator_id'),
                    'type' => 'raw',
                    'value' => function($order) {
                        return CHtml::link($order->creator->fullname, ['user/view', 'id' => $order->creator_id]);
                    },
                    'visible' => $this->acl->canViewOrderCreator($model)
                ],
                [
                    'name' => 'status_id',
                    'label' => $model->getAttributeLabel('status_id'),
                    'value' => Order::getStatusLabel($model->status_id)
                ],
                [
                    'name' => 'bidsCount',
                    'label' => Yii::t('main', 'Number of Bids'),
                    'visible' => $this->acl->canViewOrderBidsCount()
                ],
                [
                    'name' => 'currency.title',
                    'label' => Yii::t('main', 'Pay In')
                ],
                [
                    'name' => 'supplier.title',
                    'label' => $model->getAttributeLabel('supplier_id'),
                ],
                [
                    'name' => 'loading.country.title',
                    'label' => $model->getAttributeLabel('loading.country_id')
                ],
                [
                    'name' => 'loading.address',
                    'label' => $model->getAttributeLabel('loading.address')
                ],

                [
                    'name' => 'delivery.country.title',
                    'label' => Yii::t('main', 'Delivery Country')
                ],
                [
                    'name' => 'delivery.address',
                    'label' => Yii::t('main', 'Delivery Address')
                ],
                [
                    'name' => 'temperature.title',
                    'label' => Yii::t('main', 'Temperature Control')
                ],
                [
                    'name' => 'carrier.company.title',
                    'label' => Yii::t('main', 'Hauler'),
                    'type' => 'raw',
                    'value' => function($order) {
                        if ($order->carrier) {
                            return CHtml::link($order->carrier->fullname, ['user/view', 'id' => $order->carrier_id]);
                        }
                    }
                ],
//		'remark_id',
                'valid_date',
                'load_date',
                'deliver_date',
                'loaded_on_date',
                'delivered_on_date',
//		'deleted_on_date',
//		'is_deleted',
                'created',
            ],
        ]); */?>

<!--        <h3>--><?php //echo Yii::t('main', 'Order Items'); ?><!--:</h3>-->
        <?php /*$this->widget(
            'booster.widgets.TbGridView',
            [
                'dataProvider' => new CArrayDataProvider($model->orderItems),
                'template' => "{items}",
                'columns' => [
                    ['name' => 'type', 'header' => 'Type'],
                    ['name' => 'amount', 'header' => 'Amount'],
                ],
            ]
        )*/?>
    </div>
    <div class="panel-footer">
        <?php $this->widget('OrderControlsWidget', ['acl' => $this->acl, 'model' => $model]); ?>
    </div>
</div>



