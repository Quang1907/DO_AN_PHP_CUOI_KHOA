@extends("layouts/client_layout")
@session("title","Trang chủ")
@session("content")
<?php

use Core\Cookie;

echo '<pre>';
var_dump(Cookie::data());
echo '</pre>';
?>
@endsession