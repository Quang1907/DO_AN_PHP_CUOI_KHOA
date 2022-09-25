<?php

namespace Core;

class Cookie
{
    public static function data($field = "", $value = "")
    {
        if (!empty($field)) {
            if (!empty($value)) {
                return setcookie($field, $value, time() + 31536000);
            } elseif (!empty($_COOKIE[$field])) {
                return $_COOKIE[$field];
            }
        } else {
            return empty($_COOKIE) ? false : $_COOKIE;
        }
    }

    public static function delete($field = "")
    {
        if (!empty($field)) {
            if (!empty($_COOKIE[$field])) {
                return setcookie($field, null, time() - 31536001);
            }
        } else {
            foreach ($_COOKIE as $key => $value) {
                setcookie($key, null, time() - 31536001);
            }
            return true;
        }
    }
}
