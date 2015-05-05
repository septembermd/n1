<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListGroup($model,'loading_id',array('widgetOptions'=>array('data'=>Supplier::getList(),'htmlOptions'=>array('class'=>'span5','maxlength'=>9)))); ?>

	<?php echo $form->dropDownListGroup($model,'delivery_id',array('widgetOptions'=>array('data'=>DeliveryAddress::getList(),'htmlOptions'=>array('class'=>'span5','maxlength'=>9)))); ?>

    <?php echo $form->dropDownListGroup($model,'currency_id',array('widgetOptions'=>array('data'=>Currency::getList(), 'htmlOptions'=>array('class'=>'span5')))); ?>

    <?php echo $form->dropDownListGroup($model,'temperature_id',array('widgetOptions'=>array('data'=>Temperature::getList(),'htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->dateTimePickerGroup($model,'valid_date',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd hh:ii:00'),'htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->dateTimePickerGroup($model,'load_date',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd hh:ii:00'),'htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->dateTimePickerGroup($model,'deliver_date',array('widgetOptions'=>array('options'=>array('format'=>'yyyy-mm-dd hh:ii:00'),'htmlOptions'=>array('class'=>'span5')))); ?>

    <?php foreach ($model->orderItems as $index => $orderItem) {
        $this->renderPartial('/orderItems/_prototype_form', array(
            'model' => $orderItem,
            'index' => $index,
            'display' => 'block'
        ));
    } ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
