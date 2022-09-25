<?php

namespace App\Requests\User;

class UpdateUserRequest
{
    public function rules()
    {
        return [
            "fullName" => "required|max:20|min:3",
            "email" => "required|max:50|min:6|email|unique:users:id=" . $_POST['id'],
            "birthday" => "required",
            "phoneNumber" => "required|max:12|min:12|phone",
            // "password" => "required|max:10|min:6",
            // "confirm_password" => "required|match:password",
            // "_name_address" => "required|max:100|min:3",
        ];
    }

    public function messages()
    {
        return [
            "fullName.required" => "Tên không được để trống.",
            "fullName.max" => "Độ dài Tên không quá 20 ký tự.",
            "fullName.min" => "Độ dài Tên không nhỏ hơn 3 ký tự",
            "birthday.required" => "Ngày sinh không được để trống",
            "email.required" => "Email không được để trống.",
            "email.email" => "Email không đúng định dạng.",
            "email.max" => "Độ dài email không quá 10 ký tự.",
            "email.min" => "Độ dài email không nhỏ hơn 6 ký tự.",
            "email.unique" => "Email đã tồn tại",
            "phoneNumber.required" => "Điện thoại không được để trống.",
            "phoneNumber.max" => "Điện thoại không được lớn hơn 10",
            "phoneNumber.min" => "Điện thoại không được bé hơn 10",
            "phoneNumber.phone" => "Số điện thoại không đúng định dạng",
            // "password.required" => "Mật khẩu không được để trống.",
            // "password.max" => "Độ dài mật khẩu không quá 10 ký tự.",
            // "password.min" => "Độ dài mật khẩu không nhỏ hơn 6 ký tự",
            // "confirm_password.required" => "Nhập lại mật khẩu không được để trống",
            // "confirm_password.match" => "Xác minh mật khẩu không chính xác.",
            // "_name_address.required" => "Địa chỉ không được để trống.",
            // "_name_address.max" => "Độ dài Địa chỉ không quá 100 ký tự.",
            // "_name_address.min" => "Độ dài Địa chỉ không nhỏ hơn 3 ký tự.",
        ];
    }
}
