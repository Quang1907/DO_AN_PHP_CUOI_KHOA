<?php

namespace App\Requests\Admin\Category;

class CategoryRequestCreate
{
    public function rules()
    {
        return ["category_name" => "required|max:50|unique:categories"];
    }

    public function messages()
    {
        return ["category_name.required" => "Vui lòng không để trống tên danh mục",
        "category_name.max" => "Tên danh mục vui lòng không quá 50 ký tự",
        "category_name.unique" => "Tên danh mục đã tồn tại"];
    }
}
