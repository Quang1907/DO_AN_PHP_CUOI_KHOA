<?php

namespace Core;

abstract class ServiceProvider
{
    public $db;
    abstract function boot();
}
