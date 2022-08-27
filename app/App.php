<?php

namespace App;

use Core\Route;

class App
{
    public function __construct()
    {
        $route = new Route;
        $route->loadRoute();
        $route->execute();
    }
}
