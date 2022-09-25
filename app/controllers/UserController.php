<?php

namespace App\Controllers;

use App\Models\User;
use App\Requests\User\CreateUserRequest;
use App\Requests\User\UpdateUserRequest;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Session;

class UserController extends Controller
{
    private $request = null;

    public function __construct()
    {
        $this->request = new Request();
    }
    // index
    public function index()
    {
        return view("user/login");
    }

    // public function checklogin()
    // {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $user = User::where("email", $email)->where("status", true)->first();
    //     $sessionKey = Session::isInvalid();
    //     Session::flash($sessionKey . "_old", ["email" => $email]);
    //     if (!empty($user)) {
    //         if (sha1($password) == $user['password']) {
    //             Session::data("email", $email);
    //             $this->remember($email, $_POST['remember']);
    //             return Response::redirect("");
    //         }
    //         Session::data($sessionKey . "_error", ["password" => "Mật khẩu không chính xác"]);
    //     } else {
    //         Session::data($sessionKey . "_error", ["email" => "Email không chính xác"]);
    //     }
    //     $callback = Session::flash("callback");
    //     return Response::redirect($callback);
    // }

    // public function remember($email, $remember)
    // {
    //     if ($remember == "on") {
    //         return Cookie::data("email", $email);
    //     }
    //     return false;
    // }

    // public function logout()
    // {
    //     Cookie::delete("email");
    //     Session::delete("user");
    //     Session::delete("email");
    //     return Response::redirect("");
    // }

    // create
    public function create()
    {
        $provinces = Database::table("province as p")->get();
        return view("user/register", compact("provinces"));
    }

    // public function district($province_id = "")
    // {
    //     $district = Database::table("district")->where("_province_id", "=", $province_id)->get();
    //     return response($district);
    // }

    // store
    public function store()
    {
        $check = $this->request->validation(CreateUserRequest::class);
        if (!$check) {
            $data["error"] = $this->request->errors();
            $data["old"] = $this->request->getFields();
            return response($data, 412);
        }
        $data = $this->request->getFields();
        $data["password"] = sha1($data["password"]);
        User::insert($data);
        Session::data("email", $this->request->getFields()['email']);
        $callback = _WEB_ROOT;
        return response($callback, 200);
    }

    // // all user
    // public function allUser()
    // {
    //     $users = (new User)->get();
    //     if (!empty($users)) return response($users);
    //     return response(["error" => "khong ton tai user"], 412);
    // }

    public function update($id)
    {
        $check = $this->request->validation(UpdateUserRequest::class);
        
        if ( !$check ) {
            $error = $this->request->errors();
            return response($error, 412);
        }

        User::where("id", $id)->update($_POST);
        return response("User updated successfully");
    }

    // public function update($id = "")
    // {
    //     $request = new Request();
    //     $check =  $request->validation(UpdateUserRequest::class);

    //     if (!$check) {
    //         $data["messages"] = $request->errors();
    //         return response($data, 412);
    //     }

    //     $password = $_POST['password'];
    //     $confirm_password = $_POST['confirm_password'];
    //     if (empty($password)) {
    //         $data["fullName"] = $_POST['fullName'];
    //         $data["email"] = $_POST['email'];
    //         $data["phoneNumber"] = $_POST['phoneNumber'];
    //         $data["_name_address"] = $_POST['_name_address'];
    //         User::where("id", "=", $id)->update($data);
    //     } elseif ($password == $confirm_password) {
    //         $data['password'] = sha1($password);
    //         User::where("id", "=", $id)->update($data);
    //     } else {
    //         $data["messages"] = ["Nhập lại mật khẩu không khớp"];
    //         return response($data, 412);
    //     }
    //     return response(["messages" => "Cập nhật thông tin thành công"]);
    // }

    public function edit($id = "")
    {
        // $request = new Request();
        // $check =  $request->validation(UpdateUserRequest::class);
        // echo '<pre>';
        // var_dump($check);
        // echo '</pre>';
    }

    // public function edit($id = "")
    // {
    //     // $id = $_POST['id'];
    //     if ($_POST["change"] == "changeInfo") {
    //         $request = new Request();
    //         $check = $request->validation(UpdateUserRequest::class);

    //         if (!$check) {
    //             $data["messages"] = $request->errors();
    //             $data["old"] = $request->getFields();
    //             $data["changeInfo"] = true;
    //             return response($data, 412);
    //         }

    //         $fullName = $_POST['fullName'];
    //         $email = $_POST['email'];
    //         $birthday = $_POST['birthday'];
    //         $phoneNumber = $_POST['phoneNumber'];
    //         if (!empty($fullName) && !empty($email) && !empty($birthday) && !empty($phoneNumber)) {
    //             (new User)->query("update users SET fullName = '$fullName', email = '$email', birthday= '$birthday', phoneNumber = '$phoneNumber'  where id = '$id'");
    //             Session::data("user", $request->getFields());
    //             return response(["messages" => "Thay doi thông tin thanh cong", "changeInfo" => true], 200);
    //         }
    //     }
    //     if ($_POST["change"] == "changePassword") {
    //         if (!empty($_POST['password'])) {
    //             $password = $_POST['password'];
    //             $confirm_password = $_POST['confirm_password'];
    //             if (strlen($password) > 10) {
    //                 return response(["messages" => "Mat khau khong duoc lon hon 10 ky tu", "changePassword" => true], 412);
    //             }
    //             if (strlen($password) < 3) {
    //                 return response(["messages" => "Mat khau khong duoc nho hon 3 ky tu", "changePassword" => true], 412);
    //             }
    //             if ($password != $confirm_password) {
    //                 return response(["messages" => "Nhap lai mat khau khong chinh xac", "changePassword" => true], 412);
    //             }
    //             $password = sha1($password);
    //             (new User)->query("update users SET password = '$password' where id = $id");
    //         }
    //         if (empty($_POST['password'])) {
    //             return response(["messages" => "Mat khau khong duoc de trong", "changePassword" => true], 412);
    //         }
    //         return response(["messages" => "Thay doi mat khau thanh cong", "changePassword" => true], 200);
    //     }
    // }

    // show
    // public function show($id = "")
    // {
    //     $find = User::where("id", "=", $id)->first();
    //     return response($find);
    // }

    // show
    // public function search($fullName = "")
    // {
    //     $user = User::where("fullName", "LIKE", "%$fullName%")->get();
    //     if (!empty($user)) return response($user);
    //     $data['error'] = "Không tìm thấy tài khoản";
    //     return response($data, 412);
    // }

    // destroy
    // public function destroy($id = "")
    // {
    //     $check = User::where("id", "=", $id)->delete();
    //     if (!empty($check)) return response(["messages" => "Xoá tài khoản thành công."], 200);
    //     $data['error'] = "Không tìm thấy tài khoản";
    //     return response($data, 412);
    // }

}
