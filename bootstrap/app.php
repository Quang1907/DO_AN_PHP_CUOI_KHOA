<?php
session_start();
require_once "../vendor/autoload.php";
require_once "include.php";

$dotenv = Dotenv\Dotenv::createImmutable(_DIR_ROOT);
$dotenv->load();

use App\App;

new App();
