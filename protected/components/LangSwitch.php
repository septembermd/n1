<?php
class LangSwitch extends  CWidget
{
    public $setting;

    public function run()
    {
         echo yiisetting($this->setting.'_'.Yii::app()->language);
    }
}