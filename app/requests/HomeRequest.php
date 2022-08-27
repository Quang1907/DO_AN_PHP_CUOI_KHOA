<?php

namespace App\Requests;

class HomeRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:6',
            'email' => 'required|email|min:6|unique:user:id=' . 3,
            // 'email' => 'required|email|min:6|unique:user',
            'password' => 'required|min:3',
            'confirm_password' => 'required|min:3|match:password',
            'age' => 'required|callback_check_age|number',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ho ten khong duoc de trong',
            'name.min' => 'ho ten khong nho hon 5 ky tu',
            'name.max' => 'ho ten phai nho hon 6 ky tu',
            'email.required' => 'email khong duoc de trong',
            'email.email' => 'dinh dang email khong dung',
            'email.min' => 'email khong nho hon 6 ky tu',
            'email.unique' => 'email da ton tai',
            'password.required' => 'mat khau khong duoc de trongx',
            'password.min' => 'mat khau khong nho hon 3 ky tu',
            'confirm_password.required' => 'nhap lai mat khau khong duoc de trong',
            'confirm_password.min' => 'confirm khong nho hon 3 ky tu',
            'confirm_password.match' => 'confirm sai',
            'age.required' => 'tuoi ko duoc de trong',
            'age.callback_check_age' => "tuoi khong duoc nho hon 20",
            'age.number' => "Tuoi phai la chu so"
        ];
    }
}
