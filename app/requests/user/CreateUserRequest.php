<?php

namespace App\Requests\User;

class CreateUserRequest
{
    public function rules()
    {
        return [
            "fullName" => "required|max:20|min:3",
            "email" => "required|max:50|min:6|email|unique:users",
            "birthday" => "required",
            "password" => "required|max:10|min:6",
            "confirm_password" => "required|match:password",
            "phoneNumber" => "required|max:12|min:12|phone",
            // "address" => "required|max:50|min:3",
        ];
    }

    public function messages()
    {
        return [
            "birthday.required" => "Ngày sinh không được để trống",
            "email.required" => "Email không được để trống.",
            "email.email" => "Email không đúng định dạng.",
            "email.max" => "Độ dài email không quá 10 ký tự.",
            "email.min" => "Độ dài email không nhỏ hơn 6 ký tự.",
            "email.unique" => "Email đã tồn tại",
            "password.required" => "Mật khẩu không được để trống.",
            "password.max" => "Độ dài mật khẩu không quá 10 ký tự.",
            "password.min" => "Độ dài mật khẩu không nhỏ hơn 6 ký tự",
            "confirm_password.required" => "Nhập lại mật khẩu không được để trống",
            "confirm_password.match" => "Xác minh mật khẩu không chính xác.",
            "fullName.required" => "Tên không được để trống.",
            "fullName.max" => "Độ dài tên không quá 20 ký tự.",
            "fullName.min" => "Độ dài tên không nhỏ hơn 3 ký tự",
            // "address.required" => "Địa chỉ không được để trống.",
            // "address.max" => "Độ dài Địa chỉ không quá 8 ký tự.",
            // "address.min" => "Độ dài Địa chỉ không nhỏ hơn 3 ký tự.",
            "phoneNumber.required" => "Điện thoại không được để trống.",
            "phoneNumber.max" => "Điện thoại không được lớn hơn 10",
            "phoneNumber.min" => "Điện thoại không được bé hơn 10",
            "phoneNumber.phone" => "Số điện thoại không đúng định dạng",
        ];
    }
}
