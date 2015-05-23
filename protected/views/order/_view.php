<?php
/** @var Order $data */
?>
<div class="view order-item <?php echo $data->isViewedByUser($this->acl->getUser()) ? "" : "viewed" ; ?>">
    <div class="row">
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
            <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
            <?php echo CHtml::encode(Order::getStatusLabel($data->status_id)); ?>
        </div>
        <div class="col-md-2">
            <?php if ($this->acl->canViewOrderCreator($data)) : ?>
                <b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
                <?php echo CHtml::link($data->creator->fullname, ['user/view', 'id' => $data->creator_id]); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('supplier_id')); ?>:</b>
            <?php echo CHtml::encode($data->supplier->title); ?>
        </div>
        <div class="col-md-2">
            <?php if ($data->isInTransit() || $data->isDelivered() || ($data->isDeleted() && $data->carrier)) : ?>
                <b><?php echo CHtml::encode($data->getAttributeLabel('carrier_id')); ?>:</b>
                <?php echo CHtml::encode($data->carrier->company->title); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('loading_id')); ?>:</b>
            <?php echo CHtml::encode($data->loading->country->title); ?>
            , <?php echo CHtml::encode($data->loading->address); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
            <?php echo CHtml::encode($data->currency->title); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
            <?php echo CHtml::encode($data->created); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('deliver_date')); ?>:</b>
            <?php echo CHtml::encode($data->deliver_date); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo Yii::t('main', 'Number of Bids'); ?>:</b>
            <?php echo $data->getBidsCount(); ?>
        </div>
        <div class="col-md-2">
            <?php echo CHtml::link(Yii::t('main', 'Order Details'), ['order/view', 'id' => $data->id], ['class' => 'btn btn-sm btn-info']); ?>
        </div>
    </div>


    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('temperature_id')); ?>:</b>
	<?php echo CHtml::encode($data->temperature_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark_id')); ?>:</b>
	<?php echo CHtml::encode($data->remark_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valid_date')); ?>:</b>
	<?php echo CHtml::encode($data->valid_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('load_date')); ?>:</b>
	<?php echo CHtml::encode($data->load_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deliver_date')); ?>:</b>
	<?php echo CHtml::encode($data->deliver_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loaded_on_date')); ?>:</b>
	<?php echo CHtml::encode($data->loaded_on_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivered_on_date')); ?>:</b>
	<?php echo CHtml::encode($data->delivered_on_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted_on_date')); ?>:</b>
	<?php echo CHtml::encode($data->deleted_on_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
    <?php echo CHtml::encode($data->is_deleted); ?>
    <br />

	*/ ?>

</div>