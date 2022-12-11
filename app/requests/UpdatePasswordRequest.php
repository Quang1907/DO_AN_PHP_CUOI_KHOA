<?php

namespace App\Requests;

class UpdatePasswordRequest
{
    public function rules()
    {
        return [
            "province" => "required",
            "district" => "required",
            "ward" => "required",
            "street" => "required",
            "manager" => "required",
        ];
    }

    public function messages()
    {
        return [
            "province.required" => "Vui chon thanh pho",
            "district.required" => "Vui chon huyen/thi xa",
            "ward.required" => "Vui chon xa/phuong",
            "street.required" => "Vui chon thôn/tdp",
            "manager.required" => "Vui lòng chọn admin",
        ];
    }
}
