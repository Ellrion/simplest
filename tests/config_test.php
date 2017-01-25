<?php

include __DIR__ . '/test_case.php';
include __DIR__ . '/../app/config.php';

assert('config("app.name") === "Simplest"', 'Test getting config option');
assert('config("app.name") !== "Simfony"', 'Test getting config option');
assert('config("bar") === null', 'Test getting undefined config return null');
assert('config("app.foo") === null', 'Test getting undefined option return null');
