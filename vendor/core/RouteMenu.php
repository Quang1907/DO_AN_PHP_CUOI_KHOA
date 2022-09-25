<?php

namespace Core;

use App\Models\Menu;

class RouteMenu {
    public static function view($folder = "") {
        $views = scandir("../resources/views/$folder");
        echo '<pre>';
        var_dump($views);
        echo '</pre>';
        $routes = Menu::all();
        foreach ($routes as $key => $value) {
            echo '<pre>';
            var_dump($value['view_route']);
            echo '</pre>';
        }
    }
}