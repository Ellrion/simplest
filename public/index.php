<?php

include __DIR__ . '/../app/config.php';
include __DIR__ . '/../app/router.php';
include __DIR__ . '/../app/templates.php';

route('GET', '/', function () {
    return view('welcome', ['name' => config('app.name')]);
});

route_error(404, function () {
    http_response_code(404);
    return view('errors/404');
});

$action = route_resolve();

echo $action();
