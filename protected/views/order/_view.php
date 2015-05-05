<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
	<?php echo CHtml::encode($data->currency_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier_id')); ?>:</b>
	<?php echo CHtml::encode($data->supplier_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loading_id')); ?>:</b>
	<?php echo CHtml::encode($data->loading_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_id')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_id); ?>
	<br />

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

	*/ ?>

</div>