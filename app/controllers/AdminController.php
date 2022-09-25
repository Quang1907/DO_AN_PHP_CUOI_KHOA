<?php

namespace App\Controllers;

use App\Models\User;
use Core\Import;

class AdminController
{
    // construct
    public function __construct()
    {
    }

    // index
    public function index()
    {
        if (!empty($_GET['id'])) {
            $users = User::where('manager', "=", $_GET['id'])->get();
        }

        if (!empty($users)) return response($users);

        return response(["error" => "Không tìm thấy danh sách đoàn viên"], 412);
    }

    // create
    public function create()
    {
    }

    // store
    public function store()
    {
    }

    // show
    public function show($id = "")
    {
        $find = User::where("id", "=", $id)->first();
        return response($find);
    }

    public function search($fullName = "")
    {
        $user = User::where("fullName", "LIKE", "%$fullName%")->get();
        if (!empty($user)) return response($user);
        $data['error'] = "Không tìm thấy tài khoản";
        return response($data, 412);
    }

    // edit
    public function edit($id = "")
    {
    }

    // update
    public function update($id = "")
    {
        User::where("id", "=", $id)->update(['status' => true]);
        return response("Successfully");
    }

    // destroy
    public function delete($id = "")
    {
        $check = User::where("id", "=", $id)->delete();
        if (!empty($check)) return response(["messages" => "Xoá tài khoản thành công."], 200);
        $data['error'] = "Không tìm thấy tài khoản";
        return response($data, 412);
    }

    public function export()
    {
        Import::table("users")->render("uploadFile");
    }
}
