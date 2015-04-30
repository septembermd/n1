<?php
/**
 * Created by Idol IT.
 * Date: 10/2/12
 * Time: 3:09 PM
 */

Yii::import('bootstrap.widgets.TbActiveForm');


class ActiveForm extends TbActiveForm
{

    const INPUT_HORIZONTAL = 'backend.components.InputHorizontal';

    /**
     * Tinymce field render and connect the script
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function tinyMceRow($model, $attribute, $htmlOptions = array(), $button_position = 'top',$details=null)
    {

        $active_id = CHtml::activeId($model, $attribute);
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/tiny_mce/tiny_mce.js",
            CClientScript::POS_END);

        if ($details) {
            Yii::app()->clientScript->registerScript('tinymce_initialize_details', 'tinyMCE.init({
                mode : "specific_textareas",
                editor_selector : "mceEditor",
                theme:"advanced",
                theme_advanced_buttons1:"bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink,image,|,fullscreen, media,code,pagebreak,template",
                theme_advanced_buttons2:"",
                theme_advanced_buttons3:"",
                theme_advanced_toolbar_location:"top",
                theme_advanced_toolbar_align:"left",
                theme_advanced_statusbar_location:"bottom",
                plugins:"imagemanager,inlinepopups,fullscreen,media,pagebreak,template",
                width:"100%",
                height:"500px",
                language : "en",
                pagebreak_separator : "<!-- columnbreak -->",
                template_templates:[
                    {
                        title:"Product Details",
                        src: "'.$this->controller->module->assetsUrl.'/js/tiny_mce/plugins/template/product_details.htm",
                        description:"Product Details"
                    }
                ],
                content_css : "/static/css/reset.css, /static/css/site.css, /static/css/tmce.css",
                forced_root_block : "",
                extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",
            });');
        } else {
            Yii::app()->clientScript->registerScript('tinymce_initialize','tinyMCE.init({
                mode : "specific_textareas",
                editor_selector : "mceEditor",
                theme:"advanced",
                theme_advanced_buttons1:"bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink,image,|,fullscreen, media,code",
                theme_advanced_buttons2:"",
                theme_advanced_buttons3:"",
                theme_advanced_toolbar_location:"top",
                theme_advanced_toolbar_align:"left",
                theme_advanced_statusbar_location:"bottom",
                plugins:"imagemanager,inlinepopups,fullscreen,media",
                width:"100%",
                height:"500px",
                language : "en",
                extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",
            });');
        }

        return $this->render("tmc", array('model' => $model, 'attribute' => $attribute, 'htmlOptions' => $htmlOptions, 'active_id' => $active_id, 'button_position' => $button_position), true);
    }

    /**
     * File field with attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function fileField($model, $attribute, $htmlOptions = array())
    {
        $size = null;
        if(isset($htmlOptions['previewSize']))
            $size = $htmlOptions['previewSize'];
        unset($htmlOptions['previewSize']);

        return $this->render("file_field",array("model"=>$model,"attribute"=>$attribute,'size'=>$size));
    }


    /**
     * Mask Field patterns a,9,*
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @param string $mask
     * @return string
     */
    public function maskField($model, $attribute, $htmlOptions = array(), $mask = "AA-999-A999")
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/forms/jquery.inputmask.min.js",
            CClientScript::POS_END);

        $append = '<script>
        $().ready(function(){
            $("#' . CHtml::activeId($model, $attribute) . '").inputmask("' . $mask . '");
        });
        </script>';
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $htmlOptions) . $append;
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function uploadifyRow($model,$attribute,$relation, $htmlOptions = array()){


        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/uploadify/swfobject.js",
            CClientScript::POS_END
        );
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/uploadify/jquery.uploadify.v2.1.4.min.js",
            CClientScript::POS_END
        );

        return $this->render("uploadifyRow/_uploadify", array('model' => $model, 'attribute' => $attribute,
            'htmlOptions' => $htmlOptions,'relation' => $relation));
    }

    /**
     * Dropdown with jquery plugin chosen
     * @param $model
     * @param $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */

    public function dropDownListChosenRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/chosen/chosen.jquery.min.js",
            CClientScript::POS_END);

        $name = CHtml::activeId($model, $attribute);
        $output = "<script>$().ready(function(){
            $(\"#" . $name . "\").chosen();
        });
        </script>";
        return $this->inputRow(TbInput::TYPE_DROPDOWN, $model, $attribute, $data, $htmlOptions) . $output;
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function dateFieldRow($model, $attribute, $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/datepicker/bootstrap-datepicker.js",
            CClientScript::POS_END);

        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . '/lib/datepicker/datepicker.css'
        );

        $htmlOptions = array_merge(array('readonly'=>true,'hint'=>'Click to select date'), $htmlOptions);

        return $this->render('date_field',array('model'=>$model,'attribute'=>$attribute,'htmlOptions'=>$htmlOptions));
    }

    /**
     * Overriding method textFieldRow for label attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */

    public function textFieldRow($model, $attribute, $htmlOptions = array())
    {
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $htmlOptions);
    }

    /**
     * @param string $type
     * @param CModel $model
     * @param string $attribute
     * @param null $data
     * @param array $htmlOptions
     * @return string
     */
    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array())
    {
        ob_start();
        Yii::app()->controller->widget($this->getInputClassName(), array(
            'type' => $type,
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'htmlOptions' => $htmlOptions,
        ));
        return ob_get_clean();
    }

    /**
     * Returns the input widget class name suitable for the form.
     * @return string the class name
     */
    protected function getInputClassName()
    {
        if (isset($this->input))
            return $this->input;
        else {
            switch ($this->type) {
                case self::TYPE_HORIZONTAL:
                    return self::INPUT_HORIZONTAL;
                    break;

                case self::TYPE_INLINE:
                    return self::INPUT_INLINE;
                    break;

                case self::TYPE_SEARCH:
                    return self::INPUT_SEARCH;
                    break;

                case self::TYPE_VERTICAL:
                default:
                    return self::INPUT_VERTICAL;
                    break;
            }
        }
    }


}



