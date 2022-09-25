<?php

namespace App\Controllers\Api;

use App\Models\Category;

class CategoryApi
{
    public function index()
    {
        $categories = Category::all();
        return response($categories);
    }
}
