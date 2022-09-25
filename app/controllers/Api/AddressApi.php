<?php

namespace App\Controllers\Api;

use App\Models\User;
use Core\Database;

class AddressApi
{
    // public function find($id = "")
    // {
    //     $address = Database::table("address as a")
    //         ->join("province as p", "p.id = a._province_id")
    //         ->join("district as d", "d.id = a._district_id")
    //         ->join("ward as w", "w.id = a._ward_id")
    //         ->where("a.id", "=", $id)->first();
    //     return response($address);
    // }

    public function district($province_id = "")
    {
        $district = Database::table("district")->where("_province_id", "=", $province_id)->get();
        return response($district);
    }

    public function ward($district_id = "")
    {
        $ward = Database::table("ward")->where("_district_id", "=", $district_id)->get();
        return response($ward);
    }

    public function showAdmin($ward_id = "")
    {
        $ward = Database::table("ward")->select("_name_ward")->where("id", "=", $ward_id)->first();
        $name_ward = $ward['_name_ward'];
        $admin = User::select("id, fullName")
            ->where("_name_address", "like", "%$name_ward%")
            ->where("admin", "=", 1)->get();
        return !empty($admin) ? response($admin) : response('not found admin', 412);
    }
}
