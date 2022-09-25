<?php

use Core\Cookie;
use Core\Database;
use Core\ServiceProvider;
use Core\Session;
use Core\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $user = null;
        $email = Cookie::data("email");
        if (!empty(SESSION::data("email"))) {
            $email = SESSION::data("email");
        }

        if (!empty($email)) {
            $user = Database::table("users")->where("email", "=", $email)->first();
            Session::data("user", $user);
        }
        View::share(compact("user"));
    }
}
