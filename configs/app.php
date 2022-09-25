<?php

$config["app"] = [
    'service' => [
        HtmlHelper::class
    ],
    'routeMiddleware' => [
        "user" => AuthMiddleware::class,
        "user/create" => AuthMiddleware::class,
    ],
    "globalMiddleware" => [
        ParamsMiddleware::class,
    ],
    "boot" => [
        AppServiceProvider::class,
    ]
];
