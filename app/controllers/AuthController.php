<?php

namespace App\Controllers;

use App\Controllers\Api\AddressApi;
use App\Models\User;
use App\Requests\UpdatePasswordRequest;
use Core\Cookie;
use Core\Database;
use Core\Request;
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

    public function address( ) {
        $request = new Request();
        $request->validation(UpdatePasswordRequest::class);
        $data = $request->getFields();
        $update['_name_address'] = AddressApi::render($data['street'], $data['province'], $data['district'], $data['ward']);
        $update['manager'] = $data['manager'];
        $email = Session::data("email");
        User::where(" email", $email )->update($update);
        Session::data( "message", "Address updated successfully" );
        redirect( route("profile") );
    }

    public function password( ) {
        $request = new Request();
        $request->rules([
            'old_password' =>"required",
            'password' =>"required",
            'confirm_password' =>"required",
        ]);
        $request->messages([
            'old_password.required' =>"Mat khau cu khong duoc de trong",
            'password.required' =>"Mat khau moi khong duoc de trong",
            'confirm_password.required' =>"nhap lai mat khau khong duoc de trong",
        ]);

        $data =  $request->getFields();
        $user = Session::data('user');
        if (sha1( $data['old_password'] ) == $user['password'] ) {
            if ( $data['password'] == $data['confirm_password'] ) {
                $password = sha1($data['password']);
                User::where(" email", $user['email'] )->update(['password' => $password ]);
                Session::data("message","Thay doi mat khau thanh cong");
            }else{
                 Session::data("message","Nhap lai mat khau khong chinh xac");
            }
        }else{
             Session::data("message","Mat khau cu khong chinh xac");
        }
        return redirect("change-password");
    }

}
