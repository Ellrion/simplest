<?php

include __DIR__ . '/test_case.php';
include __DIR__ . '/../app/router.php';

route('GET', '/', 'foo');
assert('routes() === ["" => ["GET" => "foo"]]', 'Test Registering routes');

routes([]);
assert('routes() === []', 'Test Clearing routes');

$action = function() {
    return 'bar';
};
route('GET', '/', $action);
assert('route_resolve("/", "GET") === $action', 'Test resolving route by giving name');

$_SERVER['REQUEST_URI'] = '/bar';
$_SERVER['REQUEST_METHOD'] = 'POST';
route('POST', '/bar', $action);
assert('route_resolve() === $action', 'Test resolving route by data from request');

$action = function () {
    return 'Not Found';
};
route_error(404, $action);
assert('route_resolve("some") === $action', 'Test not found route error');

$action = function () {
    return 'Method Not Allowed';
};
route_error(405, $action);
assert('route_resolve("bar", "GET") === $action', 'Test not found route error');
