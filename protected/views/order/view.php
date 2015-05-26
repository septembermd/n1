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
                <?php echo CHtml::encode($model->id); ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('status_id')); ?>
                </h6>
                <?php if ($model->isDeleted()) : ?>
                    <?php echo Yii::t('main', 'Deleted'); ?>
                <?php else : ?>
                    <?php echo Order::getStatusLabel($model->status_id); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <h6>
                    <?php echo CHtml::encode($model->getAttributeLabel('carrier_id')); ?>
                </h6>
                <?php echo $model->isCarrierChosen()
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

    </div>
    <div class="panel-footer">
        <?php $this->widget('OrderControlsWidget', ['acl' => $this->acl, 'model' => $model]); ?>
    </div>
</div>



