<div class="orderItem">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']type', array('class'=>'control-label')); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']type', array('class'=>'span5 form-control', 'maxlength' => 150)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']type'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']amount', array('class'=>'control-label')); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']amount', array('class'=>'span5 form-control', 'maxlength' => 150)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']amount'); ?>
    </div>
</div>