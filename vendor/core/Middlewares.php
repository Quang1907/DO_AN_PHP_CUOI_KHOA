<?php

namespace Core;

abstract class Middlewares
{
    public $db;
    abstract function handle();
}
