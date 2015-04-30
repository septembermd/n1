<?php
class BaseLang extends  CWidget
{
    public $setting;
    public $model;

    public function run()
    {
        $a = $this->setting.'_'.Yii::app()->language;
        echo $this->model->$a;
    }
}