<?php

namespace Core;

use Core\Database;

class Controller
{
    public $_db;
    public function __construct()
    {
        $this->_db = new Database();
    }
}
