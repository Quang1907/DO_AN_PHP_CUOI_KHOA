<?php

namespace Core;

class Error
{
    static public function render($data = [], $name = "404")
    {
        extract($data);
        $pathViewError = _DIR_ROOT . "app/errors/$name.php";
        if (file_exists($pathViewError)) {
            return require_once $pathViewError;
        }
        require_once _DIR_ROOT . "vendor/core/views/errors/404.php";
        die();
    }
}
