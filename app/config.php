<?php

const CONFIG_PATH = __DIR__ . '/../config';

function config($config)
{
    $path = explode('.', $config);

    $config = config_load(array_shift($path));

    foreach ($path as $key) {
        if (!is_array($config) || !isset($config[$key])) {
            return null;
        }
        $config = $config[$key];
    }

    return $config;
}

/**
 * @internal
 * @param $file
 * @return mixed|null
 */
function config_load($file)
{
    static $configs = [];

    if (isset($configs[$file])) {
        return $configs[$file];
    }

    if (!file_exists(CONFIG_PATH . "/$file.php")) {
        return $configs[$file] = null;
    }

    return $configs[$file] = include(CONFIG_PATH . "/$file.php");
}