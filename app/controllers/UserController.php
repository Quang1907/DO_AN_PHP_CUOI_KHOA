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

    // create
    public function create()
    {
        $provinces = Database::table("province as p")->get();
        return view("user/register", compact("provinces"));
    }

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
}
