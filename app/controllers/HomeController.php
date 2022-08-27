<?php

namespace App\Controllers;

use App\Models\Home;
use App\Models\User;
use App\Requests\HomeRequest;
use Core\Request;
use Core\Response;
use Core\Session;
use Core\View;

class HomeController
{
    public function index()
    {
        Session::delete();
        $user = new User();
        $count = $user->select("*")->join("product as p", "p.user_id = user.id")->count();
        $data = [
            'name' => "quangcntt",
            'email' => "quangcntt@gmail.com",
            "age" => rand(10, 100),
            "password" => rand(100, 10000),
        ];
        $product = [
            'fullname' => "quangcntt",
            'email' => "quangcntt@gmail.com",
            "age" => rand(10, 100),
            "password" => rand(100, 10000),
            "user_id" => rand(1, 5),
        ];
        echo Home::insert($product);
        echo "<br>";
        echo Home::where("id", 11)->update($product);
        echo "<br>";

        echo User::insert($data);
        echo "<br>";

        echo User::where("id", 4)->update($data);
        echo "<br>";

        User::where("id", 2)->delete();
        Home::where("id", 11)->delete();

        echo '<pre>';
        var_dump(Home::find(12));
        echo '</pre>';


        // echo "<br>";
        // Home::table("home")->select("id, fullname")->get();

        // echo "<br>";
        // Home::table("users")->select("gmail")->get();

        // echo "<br>";
        // Home::table("user")->orderBy("id", "desc")->get();

        // echo "<br>";
        // $user->where("email", "like", "%quancgntt%")->orWhere("email", 10)->limit(1)->orderBy("id desc, email asc")->get();

        return View::render("product/index");
    }

    public function create()
    {
        $old = Session::flash("old");
        $error = Session::flash("error");
        return View::render("product/create", compact("old", "error"));
    }

    public function store()
    {
        $request = new Request();
        if ($request->isPost()) {
            $request->validation(HomeRequest::class);
            $data = $request->getFields();
            User::insert($data);
        }
        return Response::redirect();
    }

    public function delete($id, $slug)
    {
        echo $id  . $slug;
    }
    public function detail($id, $slug)
    {
        echo $id  . $slug;
    }

    public function check_age($age = "")
    {
        return $age >= 20 ? true : false;
    }
}
