<div class="orderItem">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group <?php echo $model->hasErrors('type') ? 'has-error' : ''; ?>">
                <?php echo CHtml::activeLabelEx($model, '[' . $index . ']type', ['class'=>'control-label']); ?>
                <?php echo CHtml::activeTextField($model, '[' . $index . ']type', ['placeholder' => 'Enter type of cargo', 'class'=>'span5 form-control', 'maxlength' => 150]); ?>
                <?php echo CHtml::error($model, '[' . $index . ']type', ['class'=>'help-block error']); ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group <?php echo $model->hasErrors('amount') ? 'has-error' : ''; ?>">
                <?php echo CHtml::activeLabelEx($model, '[' . $index . ']amount', ['class'=>'control-label']); ?>
                <?php echo CHtml::activeTextField($model, '[' . $index . ']amount', ['placeholder' => 'Cargo amount', 'class'=>'span5 form-control', 'maxlength' => 150]); ?>
                <?php echo CHtml::error($model, '[' . $index . ']amount', ['class'=>'help-block error']); ?>
            </div>
        </div>
        <?php if($index > 0 || $index === '__proto_name__') : ?>
            <div class="col-md-2">
                <?php echo CHtml::link(Yii::t('main', ''), '#', ['class'=>'glyphicon glyphicon-minus btn btn-sm btn-default remove-order-item','style'=>'margin-top:30px']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>