<?php

include __DIR__ . '/test_case.php';
include __DIR__ . '/../app/services.php';

assert('service("foo") === null', 'Test not registered service return null');

service('foo', 'bar');
assert('service("foo") === "bar"', 'Test simple data retrieving');

service('foo', 'bar');
service('foo', 'baz');
assert('service("foo") === "baz"', 'Test replacing service');

service('foo', function() {
    return 'baz';
});
assert('service("foo") === "baz"', 'Test dynamic service creating');

service('foo', function() {
    return 'bar';
}, true);
service('foo', function() {
    return 'baz';
}, true);
assert('service("foo") === "baz"', 'Test dynamic singleton service replacing');

$counter = 0;
service('foo', function() use (&$counter) {
    $counter++;
    return 'bar';
}, true);
service('foo');
service('foo');
assert('$counter === 1', 'Test singleton service - once resolving');
