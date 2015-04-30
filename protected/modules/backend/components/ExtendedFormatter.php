<?php
/**
 * Created by Idol IT.
 * Date: 10/3/12
 * Time: 11:51 AM
 */

class ExtendedFormatter extends CFormatter
{
    public function formatImage($value)
    {
        return CHtml::image(Yii::app()->iwi->load($value)->adaptive(80, 80)->cache());
    }

    public function formatLogo($value)
    {
        return CHtml::image(Yii::app()->iwi->load($value)->resize(150, 0)->cache());
    }

    public function formatUser($value)
    {
        if ($user = User::model()->findByPk($value))
            return CHtml::link($user->name, Yii::app()->createUrl("backend/user/view", array("id" => $user->id)));
        else
            return '<span class="null">Not set</span>';
    }

    public function formatBoolean($value)
    {

        if ($value > 0)
            return '<i class="splashy-check"></i>';
        else
            return '<i class="splashy-remove_minus_sign"></i>';
    }

    public function formatSex($value){
        if ($value > 0)
            return 'Female';
        else
            return 'Male';

    }
}