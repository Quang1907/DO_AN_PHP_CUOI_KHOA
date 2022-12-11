<?php

use App\Controllers\AdminController;
use App\Controllers\Api\AddressApi;
use App\Controllers\Api\CategoryApi;
use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\MenuController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Models\Product;
use Core\Database;
use Core\Route;

Route::get("/", function () {
    return view("index");
});

Route::get("contact", function () {
    return view("contact");
});

Route::get("shop", function () {
    $products = Product::join("categories as c", "c.id = products.category_id")->get();
    return view("shop", compact( "products" ));
});

Route::get("activities", function () {
    return view("activities");
});

Route::get("profile", function () {
    return view("user/profile");
});

Route::get("change-password", function () {
    return view("user/password");
});

Route::get("logout", [AuthController::class, "logout"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("password", [AuthController::class, "password"]);
Route::post("address", [AuthController::class, "address"]);

Route::get("change-address", function () {
    $provinces = Database::table("province")->get();
    return view("user/address", compact("provinces"));
});

Route::resource("user", UserController::class);



// Route::post("user/change/{id}", [UserController::class, "edit"]);


// Route::get("login", [UserController::class, "login"]);
// Route::get("logout", [UserController::class, "logout"]);
// Route::post("checklogin", [UserController::class, "checklogin"]);
// Route::get("register", [UserController::class, "register"]);
// Route::get("district/{id}", [UserController::class, "district"]);
// Route::post("user/register", [UserController::class, "store"]);
// Route::post("user/change/{id}", [UserController::class, "changeUser"]);



// Route::resource("admin", AdminController::class);


Route::get("district/{id}", [AddressApi::class, "district"]);
Route::get("ward/{id}", [AddressApi::class, "ward"]);
Route::get("showAdmin/{ward_id}", [AddressApi::class, "showAdmin"]);
// Route::post("address/create", [AddressApi::class, "create"]);
// Route::get("address/find/{id}", [AddressApi::class, "find"]);


// Route::get("admin/alluser", [AdminController::class, "index"]);
// Route::get("admin/deleteUser/{id}", [UserController::class, "destroy"]);
// Route::post("admin/detail/{id}", [UserController::class, "show"]);
// Route::get("admin/search/{name}", [UserController::class, "search"]);
// Route::get("admin/edit/{id}", [UserController::class, "edit"]);


// Route::get("admin/category", [CategoryController::class, "index"]);

// Route::get("admin/product/create", [ProductController::class, "create"]);
// Route::get("admin/product/edit/{id}", [ProductController::class, "edit"]);

// Route::group("admin", function () {
//     Route::resource("", AdminController::class);
//     Route::resource("category", CategoryController::class);
//     Route::resource("product", ProductController::class);
// });

Route::middleware(AdminMiddleware::class)->group("admin", function () {
    Route::resource("", AdminController::class);
    Route::post("export", [AdminController::class, "export"]);

    Route::resource("menu", MenuController::class);
    Route::get("profile", function () {
        return view("admin/index");
    });

    Route::get("search/{key}", [AdminController::class, "search"]);
    Route::resource("category", CategoryController::class);
    Route::resource("product", ProductController::class);
    Route::get("api/category", [CategoryApi::class, "index"]);
});
