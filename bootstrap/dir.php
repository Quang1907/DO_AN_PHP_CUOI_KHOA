<?php
$public = "public/";

// config dir root
$fileProject = str_replace("bootstrap", "", __DIR__);
define("_DIR_ROOT", str_replace("\\", "/", $fileProject));

//  config web root
if (!empty($_SERVER["HTTPS"]) && !empty($_SERVER['HTTPS'] == "on")) {
    $webRoot = "https://";
} else {
    $webRoot = "http://";
}
$host = $_SERVER["HTTP_HOST"];
$project = str_replace($_SERVER["DOCUMENT_ROOT"], "", _DIR_ROOT);
$webRoot .= $host . $project . $public;
define("_WEB_ROOT", $webRoot);
