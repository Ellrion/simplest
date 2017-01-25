<?php

const TEMPLATES_PATH = __DIR__ . '/../views';

function render($template, $data = [])
{
    extract($data, EXTR_SKIP);
    ob_start();
    require(TEMPLATES_PATH . "/$template.php");

    return ob_get_clean();
}

function view($template, $data = [])
{
    echo render($template, $data);
}

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}
