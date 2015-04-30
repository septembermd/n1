<?php
/**
 * Created by Idol IT.
 * Date: 10/3/12
 * Time: 11:15 AM
 */

?>

<?php if (!empty($model->$attribute)) { ?>
    <?php if (is_file(Yii::app()->basePath . '/../' . $model->$attribute) && getimagesize(Yii::app()->basePath . '/../' . $model->$attribute)) { ?>
        <div class="ff-thumb fileupload-new thumbnail">
            <?php
            if ($size != null)
                echo CHtml::image(Yii::app()->iwi->load($model->$attribute)->resize(intval($size[0]), intval($size[1]))->cache());
            else
                echo CHtml::image(Yii::app()->iwi->load($model->$attribute)->cache());
            ?>
        </div>
    <?php } elseif(is_file(Yii::app()->basePath . '/../' . $model->$attribute)) { ?>
        <p><?php echo CHtml::link($model->$attribute, "/".$model->$attribute, array("target" => "_blank"))?></p>
    <?php } ?>
    <div class="clearfix"></div>
    <label class="checkbox ff-thumb-label" for="<?php echo CHtml::activeId($model, $attribute); ?>_remove">
        <input name="<?php echo CHtml::activeName($model, $attribute . "_remove"); ?>"
               id="<?php echo CHtml::activeId($model, $attribute); ?>_remove" value="1" type="checkbox">
        Remove?</label>

<?php } ?>
<div class="fileupload fileupload-new" data-provides="fileupload">
    <div class="input-append">
        <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span
                class="fileupload-preview"></span></div>
        <span class="btn btn-file"><span class="fileupload-new">Select file</span><span
                class="fileupload-exists">Change</span><input type="file"
                                                              name="<?php echo CHtml::activeName($model, $attribute) ?>"></span>
        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
    </div>

</div>

<script>
    $().ready(function () {
        $('.fileupload').fileupload({uploadtype: "file", name: "<?php echo CHtml::activeName($model, $attribute) ?>"})
    });
</script>