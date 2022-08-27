<?php

use App\Controllers\HomeController;
use Core\Route;

Route::get("/", function () {
    echo "oke";
    // Session::delete();
});
Route::get("home", [HomeController::class, "index"]);
Route::get("home/create", [HomeController::class, "create"]);
Route::post("home/store", [HomeController::class, "store"]);
Route::get("home/detail/{id}-{slug}", [HomeController::class, "detail"])->where(["id" => "\d+", "slug" => ".+"]);
Route::get("home/delete/{id}/{slug}", [HomeController::class, "delete"]);
