<?php

/**
 * @var $model CActiveRecord
 * @var $this  ActiveForm
 * @var $attribute string
 * @var $htmlOptions array
 * @var $active_id string
 * @var $button_position string
 */

/**
 * Widget for TinyMce and Bootstrap
 * Initializing model name and attribute concatenation
 */
$unique_name = $active_id . "_modal";
$unique_name_textarea = $active_id . "_textarea";
$basic_name_id = "#" . $active_id;
$unique_name_id = "#" . $unique_name;

/**
 * Widget click button
 */

if ($button_position == 'top') {
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'WYSIWYG Editor',
        'type' => 'btn',
        'icon' => 'icon-edit',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'data-target' => $unique_name_id,
            'class' => 'wys'
        ),
    ));
}

/**
 * Row with button
 */
echo $this->inputRow(TbInput::TYPE_TEXTAREA, $model, $attribute, null, $htmlOptions);

if ($button_position == 'bottom') {
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'WYSIWYG Editor',
        'type' => 'btn',
        'icon' => 'icon-edit',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'data-target' => $unique_name_id,
            'class' => 'wys'
        ),
    ));
}

/**
 * Hidden modal window
 */
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => $unique_name)); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>WYSIWYG Editor &raquo; <?php echo $model->getAttributeLabel('description'); ?></h4>
    </div>

    <div class="modal-body">
        <label><textarea class="mceEditor" id="<?php echo $unique_name_textarea; ?>"></textarea></label>
    </div>

    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Submit',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    )); ?>
    </div>

<?php $this->endWidget(); ?>

<script>
    /**
     * Triggers for buttons
     */

    $().ready(function () {

        // Initialize vars
        var unique_name = '<?php echo $unique_name_id; ?>';
        var unique_name_textarea = '<?php echo $unique_name_textarea; ?>';
        var basic_name_id = '<?php echo $basic_name_id; ?>';

        // When Modal is Hidden
        $(".btn-primary", unique_name).on('click', function () {
            console.log("test");
            $(unique_name).modal('hide');
            var content = tinyMCE.get(unique_name_textarea).getContent();
            $(basic_name_id).val(content);

        });

        // When Modal is Shown
        $(unique_name).on('shown', function () {
            tinyMCE.get(unique_name_textarea).setContent($(basic_name_id).val());

        });
    });

</script>