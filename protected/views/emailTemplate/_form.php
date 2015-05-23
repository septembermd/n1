<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'email-template-form',
    'enableAjaxValidation' => false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model, 'subject', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 3000, 'rows' => '15')))); ?>

<?php echo $form->textAreaGroup($model, 'body', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 3000, 'rows' => '15')))); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<br/>
<h5>Available tags:</h5>
    <ul>
        <li>
            {{username}} - full name of recipient user. (Ex. John Smith)
        </li>
        <li>
            {{order}} - link to order
        </li>
        <li>
            {{creator}} - link to creator profile
        </li>
        <li>
            {{carrier}} - link to carrier profile
        </li>
        <li>
            {{site}} - link to website
        </li>
    </ul>
