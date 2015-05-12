<?php

class MainMenuWidget extends CWidget
{
    /** @var AccessControlList */
    public $acl;

    public function run()
    {
        $this->render('mainMenuWidget', ['currentUser' => Yii::app()->user, 'acl' => $this->acl]);
    }
}