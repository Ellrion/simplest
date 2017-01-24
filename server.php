<?php

define('PUBLIC_DIR', __DIR__.'/public');

chdir(PUBLIC_DIR);

if (php_sapi_name() === 'cli') {
    passthru('php -S localhost:8080 ' . __FILE__);
}

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' and file_exists(PUBLIC_DIR . $uri)) {
    return false;
}

require_once PUBLIC_DIR . '/index.php';
