<?php

function yiisetting($name, $default = null)
{
    if ($setting = Settings::model()->findByAttributes(array("name" => $name)))
        if (isset($setting))
            return $setting->value;
    return $default;

}