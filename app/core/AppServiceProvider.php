<?php

use Core\ServiceProvider;
use Core\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $data["coppy"] = "quangcntt";
        View::share($data);
    }
}
