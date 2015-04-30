<?php
$this->breadcrumbs=array(
    'Добавить данные через Exel',
);
?>

<? if(Yii::app()->user->hasFlash('error')): ?>

<div class="nNote nFailure">
    <p><?php echo Yii::app()->user->getFlash('error'); ?></p>
</div>

<? elseif(Yii::app()->user->hasFlash('ok')): ?>
<div class="nNote nFailure">
    <p><?php echo Yii::app()->user->getFlash('ok'); ?></p>
</div>
<? else: ?>

<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
        'id' => 'excel-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
        'htmlOptions'=>array('enctype'=>'multipart/form-data')
    )); ?>

<?php echo $form->fileFieldRow($model, 'value', array('class' => 'span5', 'maxlength' => 255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'label' => $model->isNewRecord ? 'Create' : 'Save',
)); ?>
</div>
<?  $this->endWidget(); ?>
<?php endif; ?>