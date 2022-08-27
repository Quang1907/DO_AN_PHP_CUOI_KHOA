<?php

use Core\Session;

$sessionKey = Session::isInvalid();
$old = Session::flash($sessionKey . "_old");
$error = Session::flash($sessionKey . "_error");

if (!function_exists("error")) {
    function error($fieldName = "", $before = "", $after = "")
    {
        global $error;
        if (!empty($error[$fieldName])) {
            if (!empty($before) && !empty($after)) {
                return $before . $error[$fieldName] . $after;
            }
            return "<small id='name' class='form-text text-danger'>" . $error[$fieldName] . "</small>";
        }
    }
}

if (!function_exists("old")) {
    function old($fieldName = "", $default = "")
    {
        global $old;
        if (!empty($old[$fieldName])) {
            return $old[$fieldName];
        }
        return $default;
    }
}
