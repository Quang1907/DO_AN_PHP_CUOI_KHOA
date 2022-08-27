@extends('layouts/client_layout')
@session("title", "quangcntt")
@session('content')
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="">
    <label class="form-check-label" for="">
        Default checkbox
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="" checked>
    <label class="form-check-label" for="">
        Checked checkbox
    </label>
</div>
@php($c , 10)
{{ $c }}
@php("name","quangcntt")
{{ $name }}

@php
$a = 2;
$b = 2;
$name = "quangnctt";
@endphp

@if($a > $b)
{{ "a > b" }}
@elseif( $a < $b )
{{"a < b"}}
@else
{{"a = b"}}
@endif

@while($a < 10)
{{$a}}
@php
$a++;
@endphp
@endwhile

@for($c; $c > 0; $c--)
{{$c}}
@endfor

@php
$users = [
    [   
        "fullname" => "it",
        "age"=>24
    ],
    [   
        "fullname" => "quangcntt",
        "age"=>24
    ]
];
@endphp

@foreach ($users as $user)
{{"fullname:" . $user['fullname'] . "<br>"}}
@endforeach

{! '<script>
    alert("it")
</script>'!}

@endsession

@session('title')
quangcntt
@endsession