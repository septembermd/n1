<div class="gallery">
    <?php $this->renderPartial("_images",array('model'=>$model)); ?>
</div>

<div class="control-group "><label class="control-label">&nbsp;</label>

    <div class="controls">
        <div class="fupload">
            <input id="file_upload" type="file" name="Filedata" style="display: none; " width="120" height="30">

            <p></p>

            <div id="file_uploadQueue" class="uploadifyQueue">
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">

    // load uploadify

    $('#file_upload').uploadify({
        'uploader':'<?php echo $this->module->assetsUrl; ?>/js/uploadify/uploadify.swf',
        'script':'<?php echo Yii::app()->createUrl("backend/" . strtolower(get_class($model)) . "/upload"); ?>',
        'cancelImg':'<?php echo $this->module->assetsUrl; ?>/js/uploadify/cancel.png',
        'folder':'<?php echo $this->module->assetsUrl; ?>/images/site/tmp',
        'auto':true,
        'multi':true,
        'onAllComplete':function () {

            // after successfully save refresh gallery

            $.ajax({
                type:"POST",
                data:{id:'<?php echo $model->id; ?>'},
                url:"/backend/<?php echo strtolower(get_class($model));?>/gallery",
                success:function (output) {
                    $(".gallery").html(output);
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

</script>
