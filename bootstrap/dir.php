<?php

// config dir root
$fileProject = str_replace("bootstrap", "", __DIR__);
define("_DIR_ROOT", str_replace("\\", "/", $fileProject));

//  config web root
if (!empty($_SERVER["HTTPS"]) && !empty($_SERVER['HTTPS'] == "on")) {
    $webRoot = "https://";
} else {
    $webRoot = "http://";
}
$host = ( !empty( $_ENV['APP_URL'] ) ) ? $_ENV['APP_URL'] : $_SERVER["HTTP_HOST"];
$webRoot .= $host ."/";

define("_WEB_ROOT", $webRoot);
