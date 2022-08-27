<?php

use App\Controllers\HomeController;
use Core\Route;
use Core\View;

Route::get("/", function () {
    // $user = "asdads";
    // return view("product/index", compact("user"));
    View::render("index");
    // Session::delete();
});
Route::get("home", [HomeController::class, "index"]);
Route::get("home/showData", [HomeController::class, "showData"]);
Route::get("home/create", [HomeController::class, "create"]);
Route::post("home/store", [HomeController::class, "store"]);
Route::get("home/detail/{id}", [HomeController::class, "detail"])->where(["id" => "\d+", "slug" => ".+"]);
Route::get("home/delete/{id}/{slug}", [HomeController::class, "delete"]);
