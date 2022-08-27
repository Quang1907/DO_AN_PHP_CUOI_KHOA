<?php

use Core\Session;
use Core\View;

if (!function_exists("csrf")) {
    function csrf()
    {
        $path = trim($_SERVER['PATH_INFO'], "/");
        $url = _WEB_ROOT . $path;
        return Session::data("callback", $url);
    }
}

if (!function_exists("route")) {
    function route($url = "", $params = "")
    {
        $url = str_replace(".", "/", $url);
        $route = _WEB_ROOT . "$url/$params";
        return $route;
    }
}

if (!function_exists("response")) {
    function response($data, $httpStatus = 200)
    {
        $allData = [];
        array_push($allData, ["status" => $httpStatus, "data" => $data]);
        echo json_encode($allData);
    }
}

if (!function_exists("assets")) {
    function assets($urlFile = "")
    {
        $path = _DIR_ROOT . "public/" . $urlFile;
        if (file_exists($path)) {
            return _WEB_ROOT . $urlFile;
        }
    }
}

if (!function_exists("view")) {
    function view($name = "", $data = [])
    {
        View::render($name, $data);
    }
}

if (!function_exists("route")) {
    function route($name = "", $data = [])
    {
        View::render($name, $data);
    }
}
