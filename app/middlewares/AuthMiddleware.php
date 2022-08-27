<?php

use Core\Middlewares;

class AuthMiddleware extends Middlewares
{
    public function handle()
    {
        echo '<pre>';
        var_dump($this->db->table("user")->select("*")->get());
        echo '</pre>';
    }
}
