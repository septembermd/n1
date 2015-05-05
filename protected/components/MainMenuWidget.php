<?php

class MainMenuWidget extends CWidget
{
    public function run()
    {
        $this->render('mainMenuWidget', array('currentUser' => Yii::app()->user));
    }
}