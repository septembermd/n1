<?php

class OrderActionsWidget extends CWidget
{
    public function run()
    {
        $currentUser = User::model()->findByPk(Yii::app()->user->id);
        $this->render('orderActionsWidget', array('currentUser' => $currentUser));
    }
}