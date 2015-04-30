<?php $id = CHtml::activeId($model, $attribute); ?>
<div id="<?php echo $id; ?>">
    <?php $this->render("uploadifyRow/_images", array('model' => $model,'relation'=>$relation)); ?>
</div>

<div class="control-group "><label class="control-label">&nbsp;</label>

    <div class="controls">
        <div class="fupload">
            <input id="file_upload-<?php echo $id; ?>" type="file" name="Filedata" style="display: none; " width="120"
                   height="30">

            <p></p>

            <div id="file_uploadQueue" class="uploadifyQueue">
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">

    // load uploadify
    $().ready(function () {

        var uploadify_id = "#file_upload-<?php echo $id; ?>";
        var gallery_id = "#<?php echo $id; ?>";

        $(uploadify_id).uploadify({
            'uploader':'<?php echo $this->controller->module->assetsUrl; ?>/js/uploadify/uploadify.swf',
            'script':'<?php echo Yii::app()->createUrl("backend/" . strtolower(get_class($model)) . "/upload"); ?>',
            'cancelImg':'<?php echo $this->controller->module->assetsUrl; ?>/js/uploadify/cancel.png',
            'folder':'<?php echo $this->controller->module->assetsUrl; ?>/images/site/tmp',
            'auto':true,
            'multi':true,
            'onAllComplete':function () {

                // after successfully save refresh gallery

                $.ajax({
                    type:"POST",
                    data:{id:'<?php echo $model->id; ?>'},
                    url:"<?php echo Yii::app()->createUrl("backend/" . strtolower(get_class($model)) . "/gallery"); ?>",
                    success:function (output) {
                        $(gallery_id).html(output);
                    }
                });

            },
            // if error get it in console

            'onError':function (event, ID, fileObj, errorObj) {
                console.log(errorObj.type + ' Error: ' + errorObj.info);
            },
            'scriptData':{'id':'<?php echo $model->id; ?>'}
        });

        // common delete ajax method of images

        $(".delete").live("click", function () {
            var $this = $(this);
            $.ajax({
                type:"POST",
                data:{id:$this.attr("id")},
                url:"<?php echo Yii::app()->createUrl("backend/" . strtolower(get_class($model)) . "/imagedel"); ?>",
                success:function (msg) {
                    $this.closest("li").fadeOut();
                }
            });
        });
    });

</script>
