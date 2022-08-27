<?php

namespace Core;

class View
{
    static public $dataShare = [];
    static public function render($name = "", $data = [])
    {
        if (!empty(self::$dataShare)) {
            $data = array_merge($data, self::$dataShare);
        }
        extract($data);
        $pathView = _DIR_ROOT . "resources/views/$name.php";
        $contentView = "";
        if (file_exists($pathView)) {
            $contentView = file_get_contents($pathView);
            new Template($contentView, $data);
        } else {
            Error::render(["error" => "Error: Khong tim thay view => $pathView"]);
            die();
        }
    }

    static public function share($share = [])
    {
        if (!empty($share)) {
            self::$dataShare = $share;
        }
    }
}
