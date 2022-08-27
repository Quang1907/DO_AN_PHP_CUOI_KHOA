@extends('layouts/client_layout')
@session("title", "Create user")
@session("content")
<?php
HtmlHelper::formOpend();
?>
<div class="row m-auto col-sm-4">
    <form action="{{ route('home.store') }}" method="post">
        @csrf
        <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="input name">
            {{ error("name") }}
        </div>
        <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="input email">
            {{ error("email") }}
        </div>
        <div class="mb-1">
            <label for="age" class="form-label">Age</label>
            <input type="text" class="form-control" name="age" value="{{ old('age') }}" id="age" placeholder="input age">
            {{ error("age") }}
        </div>
        <div class="mb-1">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="input password">
            {{ error("password") }}
        </div>
        <div class="mb-1">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="input confirm_password">
            {{ error("confirm_password") }}
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn bg-blue-500">Button</button>
        </div>
    </form>
</div>
@endsession