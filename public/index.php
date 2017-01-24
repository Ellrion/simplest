<?php

include __DIR__ . '/../app/config.php';
include __DIR__ . '/../app/router.php';
include __DIR__ . '/../app/templates.php';

route('GET', '/', function () {
    return render('welcome', ['name' => config('app.name')]);
});

route_error(404, function () {
    http_response_code(404);
    return render('errors/404');
});

$action = route_resolve();

echo $action();
