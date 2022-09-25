<?php

namespace App\Requests\Admin\Product;

class ProductRequest
{
    public function rules()
    {
        return [
            "product_name" => "required",
            "price" => "required",
            "descript" => "required",
            "category_id" => "required",
        ];
    }

    public function messages()
    {
        return [
            "product_name.required" => "Tên sản phẩm không được để trống",
            "price.required" => "Giá sản phẩm không được để trống",
            "descript.required" => "Mô tả không được để trống",
            "category_id.required" => "Danh mục không được để trống",
        ];
    }
}
