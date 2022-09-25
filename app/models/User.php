<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public $table = "Users";
    public $primary = "id";
    public $field = "*";
}
