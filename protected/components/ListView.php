<?php
Yii::import("zii.widgets.CListView");
class ListView extends CListView
{
    public $template="{sorter}\n{items}\n{pager}";
}