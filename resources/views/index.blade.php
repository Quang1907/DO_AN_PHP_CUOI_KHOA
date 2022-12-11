@extends("layouts/client_layout")
@section("title","Trang chủ")
@section("content")
<?php

use Core\Cookie;

echo '<pre>';
var_dump(Cookie::data());
echo '</pre>';
?>
@endsection