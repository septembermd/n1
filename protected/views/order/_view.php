<div class="view" style="margin-bottom:35px;">
    <div class="row">
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
            <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
        </div>
        <div class="col-md-2">
            <?php if ($this->acl->canViewCreator()) : ?>
                <b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
                <?php echo CHtml::encode($data->creator->fullname); ?>
            <?php endif;?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
            <?php echo CHtml::encode(Order::getStatusLabel($data->status_id)); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('loading_id')); ?>:</b>
            <?php echo CHtml::encode($data->loading->country->title); ?>, <?php echo CHtml::encode($data->loading->address); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('delivery_id')); ?>:</b>
            <?php echo CHtml::encode($data->delivery->country->title); ?>, <?php echo CHtml::encode($data->delivery->address); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo Yii::t('main', 'Number of Bids'); ?>:</b>
            <?php echo $data->getBidsCount(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('supplier_id')); ?>:</b>
            <?php echo CHtml::encode($data->supplier_id); ?>
        </div>
        <div class="col-md-2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
            <?php echo CHtml::encode($data->currency->title); ?>
        </div>
        <div class="col-md-2">

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
            <?php echo CHtml::link(Yii::t('main', 'Order Details'), array('order/view', 'id'=>$data->id), array('class'=>'btn btn-sm btn-info'));?>
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