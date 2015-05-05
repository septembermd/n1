<div class="orderItem">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($model, '[' . $index . ']type', array('class'=>'control-label')); ?>
                <?php echo CHtml::activeTextField($model, '[' . $index . ']type', array('class'=>'span5 form-control', 'maxlength' => 150)); ?>
                <?php echo CHtml::error($model, '[' . $index . ']type'); ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($model, '[' . $index . ']amount', array('class'=>'control-label')); ?>
                <?php echo CHtml::activeTextField($model, '[' . $index . ']amount', array('class'=>'span5 form-control', 'maxlength' => 150)); ?>
                <?php echo CHtml::error($model, '[' . $index . ']amount'); ?>
            </div>
        </div>
        <?php if($index > 0 || $index === '__proto_name__') : ?>
            <div class="col-md-2">
                <?php echo CHtml::link(Yii::t('main', ''), '#', array('class'=>'glyphicon glyphicon-minus btn btn-sm btn-default remove-order-item','style'=>'margin-top:30px')); ?>
            </div>
        <?php endif; ?>
    </div>
</div>