<?php
return 
'<?php

namespace App\Models;

use Core\Model;

class ' . $model . ' extends Model
{
    public $table = "' . $model . '";
    public $primary = "id";
    public $field = "*";
}
';
