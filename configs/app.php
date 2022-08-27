<?php

$config["app"] = [
    'service' => [
        HtmlHelper::class
    ],
    'routeMiddleware' => [
        "home/detail/{id}-{slug}" => AuthMiddleware::class
    ],
    "globalMiddleware" => [
        ParamsMiddleware::class,
    ],
    "boot" => [
        AppServiceProvider::class,
    ]
];
