<?php
/** @var Order $data */
?>
<div class="view order-item <?php echo $data->isViewedByUser($this->acl->getUser()) ? "" : "viewed" ; ?> text-center">
    <div class="row">
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></h6>
            <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?></h6>
            <?php if ($data->isDeleted()): ?>
                <?php echo Yii::t('main', 'Deleted'); ?>
            <?php else: ?>
                <?php echo CHtml::encode(Order::getStatusLabel($data->status_id)); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <?php if ($this->acl->canViewOrderCreator($data)) : ?>
                <h6><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?></h6>
                <?php if ($this->acl->getUser()->isCarrier()): // Display Creator Info Popup ?>
                    <?php echo CHtml::link($data->creator->fullname, '#', ['class' => 'mb-control', 'data-box' => '#responsibleInfo'.$data->id,]); ?>
                <?php else: ?>
                    <?php echo CHtml::link($data->creator->fullname, ['user/view', 'id' => $data->creator_id]); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('supplier_id')); ?></h6>
            <?php echo CHtml::encode($data->supplier->title); ?>
        </div>
        <div class="col-md-2">
            <?php if ($data->isInTransit() || $data->isDelivered() || ($data->isDeleted() && $data->carrier)) : ?>
                <h6><?php echo CHtml::encode($data->getAttributeLabel('carrier_id')); ?></h6>
                <?php echo CHtml::encode($data->carrier->company->title); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('loading_id')); ?></h6>
            <?php echo CHtml::encode($data->loading->country->title); ?>
            , <?php echo CHtml::encode($data->loading->address); ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?></h6>
            <?php echo CHtml::encode($data->currency->title); ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('created')); ?></h6>
            <?php echo CHtml::encode($data->created); ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo CHtml::encode($data->getAttributeLabel('deliver_date')); ?></h6>
            <?php echo CHtml::encode($data->deliver_date); ?>
        </div>
        <div class="col-md-2">
            <h6><?php echo Yii::t('main', 'Number of Bids'); ?></h6>
            <?php echo $data->getBidsCount(); ?>
        </div>
        <div class="col-md-2">
            <?php echo CHtml::link(Yii::t('main', 'Order Details'), ['order/view', 'id' => $data->id], ['class' => 'btn btn-sm btn-info']); ?>
        </div>
    </div>

<?php
/** Creator Info Popup to display when carrier clicked creator name */
if ($this->acl->getUser()->isCarrier() && $this->acl->canViewOrderCreator($data)) {
    $this->renderPartial('_responsible_info', [
        'id' => 'responsibleInfo'.$data->id,
        'header' => Yii::t('main', 'Responsible Person Contact Info'),
        'user' => $data->creator
    ]);
} ?>

</div>