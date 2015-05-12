<?php

function yiisetting($name, $default = null)
{
    if ($setting = Settings::model()->findByAttributes(["name" => $name]))
        if (isset($setting))
            return $setting->value;
    return $default;

}