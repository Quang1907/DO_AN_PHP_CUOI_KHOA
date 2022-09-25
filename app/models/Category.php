<?php

namespace App\Models;

use Core\Model;

class Category extends Model
{
    public $table = "Categories";
    public $primary = "id";
    public $field = "*";
}
