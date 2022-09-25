<?php

namespace App\Controllers;

use App\Models\User;
use Core\Cookie;
use Core\Response;
use Core\Session;

class AuthController{
    public function logout() {
        Cookie::delete("email");
        Session::delete("user");
        Session::delete("email");
        return Response::redirect("");
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::where("email", $email)->where("status", true)->first();
        $sessionKey = Session::isInvalid();
        Session::flash($sessionKey . "_old", ["email" => $email]);
        if (!empty($user)) {
            if (sha1($password) == $user['password']) {
                Session::data("email", $email);
                $this->remember($email, $_POST['remember']);
                return Response::redirect("");
            }
            Session::data($sessionKey . "_error", ["password" => "Mật khẩu không chính xác"]);
        } else {
            Session::data($sessionKey . "_error", ["email" => "Email không chính xác"]);
        }
        $callback = Session::flash("callback");
        return Response::redirect($callback);
    }
    
    public function remember( $email, $remember )
    {
        if ($remember == "on") {
            return Cookie::data("email", $email);
        }
        return false;
    }

}
