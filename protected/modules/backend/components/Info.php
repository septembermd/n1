<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 1/30/13
 * Time: 2:09 PM
 * To change this template use File | Settings | File Templates.
 */


class Info extends CWidget
{
    public function run()
    {
        $order = new Order();
        $this->render("info", array("order" => $order));
    }
}