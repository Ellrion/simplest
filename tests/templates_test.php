<?php

include __DIR__ . '/test_case.php';
include __DIR__ . '/../app/templates.php';

file_put_contents(TEMPLATES_PATH . '/_test.php', '<p><?= $var ?></p>');
assert('view("_test", ["var" => "foo"]) === "<p>foo</p>"', 'Test render template from file');
unlink(TEMPLATES_PATH . '/_test.php');

$var = '<script>alert(1)</script>';
$protected = '&lt;script&gt;alert(1)&lt;/script&gt;';
assert('e($var) === $protected', 'Test xss protection');

$template = '<p>{var}</p>';
assert('render($template, ["var" => "foo"]) === "<p>foo</p>"', 'Test render string template');
