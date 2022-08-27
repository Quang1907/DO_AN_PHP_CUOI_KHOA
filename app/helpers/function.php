<?php

use Core\Session;

function csrf()
{
    $path = trim($_SERVER['PATH_INFO'], "/");
    $url = _WEB_ROOT . $path;
    return Session::data("callback", $url);
}

function route($url = "")
{
    $url = str_replace(".", "/", $url);
    $route = _WEB_ROOT . "$url";
    return $route;
}
