<?php
require_once "dir.php";

// load config 
$pathConf = _DIR_ROOT . "configs";
$conf = scandir($pathConf);
foreach ($conf as $value) {
    if ($value != "." && $value != "..") {
        require_once "$pathConf/$value";
    }
}

require_once _DIR_ROOT . "vendor/core/Helpers.php";

// autoload app service 
if (!empty($config['app']['service'])) {
    foreach ($config['app']['service'] as $key => $value) {
        $path = _DIR_ROOT . "app/core/$value.php";
        if (file_exists($path)) {
            require_once $path;
        }
    }
}
