<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{
    public $table = "Products";
    public $primary = "id";
    public $field = "*";

}
