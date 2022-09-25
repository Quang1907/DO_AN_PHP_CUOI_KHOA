<?php

use Core\Middlewares;
use Core\Response;
use Core\Session;

class AdminMiddleware extends Middlewares
{
    public function handle()
    {
        $user = Session::data("user");
        if (empty($user) || $user['admin'] == false) {
            return Response::redirect("");
        }
    }
}
