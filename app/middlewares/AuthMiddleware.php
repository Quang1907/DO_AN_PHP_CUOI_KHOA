<?php

use Core\Middlewares;
use Core\Response;
use Core\Session;

class AuthMiddleware extends Middlewares
{
    public function handle()
    {
        $user = Session::data("user");
        if (!empty($user)) {
            return Response::redirect("");
        }
    }
}
