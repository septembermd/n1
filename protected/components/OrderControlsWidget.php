<?php

class OrderControlsWidget extends CWidget
{
    /** @var AccessControlList */
    public $acl;

    /** @var Order */
    public $model;

    public function run()
    {
        $this->render('orderControlsWidget', [
            'acl' => $this->acl,
            'model' => $this->model
        ]);
    }
}