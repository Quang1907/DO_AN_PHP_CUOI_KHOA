<?php

session_start();


require_once "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable( str_replace( "bootstrap", "", __DIR__ ) );


$dotenv->load();

require_once "include.php";


use App\App;

new App();
