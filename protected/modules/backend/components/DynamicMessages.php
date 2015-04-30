<?php
/**
 * .
 * Date: 10/3/12
 * Time: 6:25 PM
 */

class DynamicMessages
{
    public static function callMessage($status, $message)
    {
        return '<script>$().ready(function(){$.sticky("' . $message . '", {autoclose : 5000, position: "top-right", type: "st-' . $status . '" });});</script>';
    }
}