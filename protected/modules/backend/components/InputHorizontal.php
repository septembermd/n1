<?php
/**
 * Created by Idol IT.
 * Date: 10/4/12
 * Time: 4:58 PM
 */

Yii::import('bootstrap.widgets.input.TbInputHorizontal');

class InputHorizontal extends TbInputHorizontal
{

    protected function getLabel()
    {
        if (isset($this->labelOptions['class']))
            $this->labelOptions['class'] .= ' control-label';
        else
            $this->labelOptions['class'] = 'control-label';

       if(isset($this->htmlOptions["required_element"]))
            $this->labelOptions['required'] = $this->htmlOptions["required_element"];
       if(isset($this->htmlOptions["labelOverride"]))
           return CHtml::label($this->htmlOptions["labelOverride"],CHtml::activeId($this->model,$this->attribute),$this->labelOptions);


        return parent::getLabel();
    }

    protected function textField()
    {

        echo $this->getLabel();
        echo '<div class="controls">';
        echo $this->getPrepend();
        echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getAppend();
        echo $this->getError().$this->getHint();
        echo '</div>';
    }
}