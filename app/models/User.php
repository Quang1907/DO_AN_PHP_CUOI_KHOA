<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = "user";
    protected $primary = "name";
    protected $field = "*";
}
