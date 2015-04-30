<?php
/**
 * @var $model Subscriber
 * @var $attribute string
 * @var $htmlOptions array
 */
?>
<div class="control-group ">

    <?php echo CHtml::activeLabelEx($model, $attribute, array('class' => 'control-label')); ?>

    <div class="controls">

        <div class="input-append date" id="<?php echo CHtml::activeId($model, $attribute) . "_datepicker"; ?>"
             data-date="<?php echo $model->birthday; ?>" data-date-format="yyyy-mm-dd"<?php if(isset($htmlOptions['viewMode'])): ?> data-date-viewmode="<?php echo $htmlOptions['viewMode']; ?>"<?php endif; ?>>
            <?php echo CHtml::activeTextField($model, $attribute, $htmlOptions); ?>
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
        <p class="help-block"><?php echo isset($htmlOptions['hint'])?$htmlOptions['hint']:''; ?></p></div>
</div>


<script>$().ready(function () {
    $("#<?php echo CHtml::activeId($model, $attribute) . "_datepicker"; ?>").datepicker();
});
</script>