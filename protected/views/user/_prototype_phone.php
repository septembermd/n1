<?php
/** @var CModel $model */
?>
<div class="user-phone" style="padding-left: 10px;">
    <div class="row">
        <div class="col-md-9">

            <div class="form-group <?php echo $model->hasErrors('phone') ? 'has-error' : ''; ?>">
                <?php echo CHtml::activeLabelEx($model, 'phone', ['class'=>'control-label']); ?>
                <?php echo CHtml::activeTextField($model, 'phone_numbers[' . $index . ']', ['value'=> $value, 'class'=>'span5 form-control', 'maxlength' => 20]); ?>
                <?php echo CHtml::error($model, 'phone_numbers[' . $index . ']', ['class'=>'help-block error']); ?>
            </div>
        </div>
        <?php if($index > 0 || $index === '__proto_name__') : ?>
            <div class="col-md-2">
                <?php echo CHtml::link(Yii::t('main', ''), '#', ['class'=>'glyphicon glyphicon-minus btn btn-sm btn-default remove-user-phone','style'=>'margin-top:30px']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
