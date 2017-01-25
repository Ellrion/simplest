<?php

const TEMPLATES_PATH = __DIR__ . '/../views';

/**
 * @param string $template
 * @param array $data
 * @return string
 */
function view($template, $data = [])
{
    extract($data, EXTR_SKIP);
    ob_start();
    require(TEMPLATES_PATH . "/$template.php");

    return ob_get_clean();
}

/**
 * @param string $string
 * @param array $data
 * @param string $prefix
 * @param string $suffix
 * @return string
 */
function render($string, $data, $prefix = '{', $suffix = '}')
{
    $params = [];
    array_walk($data, function ($val, $key) use (&$params, $prefix, $suffix) {
        $params["{$prefix}{$key}{$suffix}"] = $val;
    });

    return strtr($string, $params);
}


/**
 * @param mixed $value
 * @return string
 */
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8', false);
}
