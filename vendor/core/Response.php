<?php

namespace Core;

class Response
{
    static public function redirect($uri = "")
    {
        if (!empty($uri)) {
            $pattern = "~(http|https)~is";
            if (preg_match($pattern, $uri)) {
                header("Location: $uri");
                die();
            }
            $path = _WEB_ROOT . "$uri";
            header("Location: $path");
            die();
        }
        header("Location: " . _WEB_ROOT);
        die();
    }
}
