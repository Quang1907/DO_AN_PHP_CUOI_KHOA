<?php

namespace App\Requests\Admin\Menu;

class CreateMenuRequest
{
    public function rules()
    {
        return ["menu_name" => "required|max:50|unique:menus"];
    }

    public function messages()
    {
        return ["menu_name.required" => "Vui lòng không để trống tên menu",
        "menu_name.max" => "Tên menu vui lòng không quá 50 ký tự",
        "menu_name.unique" => "Tên menu đã tồn tại"];
    }
}
