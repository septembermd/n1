<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', [
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
]); ?>

<?php echo $form->textFieldGroup($model, 'id', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 9]]]); ?>

<?php echo $form->textFieldGroup($model, 'title', ['widgetOptions' => ['htmlOptions' => ['class' => 'span5', 'maxlength' => 100]]]); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Search',
    ]); ?>
</div>

<?php $this->endWidget(); ?>
