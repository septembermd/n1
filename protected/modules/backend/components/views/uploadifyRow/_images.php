<div class="heading clearfix">
    <h3 class="pull-left">Images</h3>
</div>
<div class="control-group "><label class="control-label">&nbsp;</label>

    <div class="controls">
        <div class="wmk_grid">
            <?php if (count($model->$relation) > 0) { ?>
                <ul>
                    <?php foreach ($model->$relation as $image) {?>

                                <li class="thumbnail">
                                    <a href="<?php echo Yii::app()->iwi->load($image->filename)->cache(); ?>"
                                       rel="gallery" class="cboxElement">
                                        <img src="<?php echo Yii::app()->iwi->load($image->filename)->adaptive(200, 150)->cache(); ?>"
                                             alt="">
                                    </a>
                                   <p style="float:left;"> <input type="radio" name="<?php echo get_class($model);?>[preview]"value="<?php echo $image->id;
                                    ?>"<?php if($image->preview) echo " checked='checked'"?>> cover</p>
                                   <p>
                                        <a href="javascript:void(0)" title="Remove" class="delete"
                                           id="<?php echo $image->id; ?>"><i class="icon-trash"></i></a>
                                    </p>
                                </li>
                    <?php } ?>
                </ul>
            <?php }else{ ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                There is no images. Click <strong>Select files</strong> to upload images.
            </div>
            <?php } ?>

            <div class="clearfix"></div>

        </div>
    </div>
</div>