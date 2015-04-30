<?php
/**
 * .
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class Sidebar extends CWidget
{

    public function init()
    {
        $c = null;
        if (isset(Yii::app()->session["sidebar_tab"]))
            $c = Yii::app()->session["sidebar_tab"];
        $this->render('sidebar', array("c" => $c));
    }
}