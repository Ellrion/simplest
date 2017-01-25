<?php

function service($alias, $resolver = null, $singleton = false)
{
    static $services = [];

    if (null !== $resolver) {
        $services[$alias] = ['resolver' => $resolver, 'options' => ['singleton' => $singleton]];
        return;
    }

    if (!isset($services[$alias])) {
        return null;
    }
    $services_info = $services[$alias];

    if (isset($services_info['resolved']) && !empty($services_info['options']['singleton'])) {
        return $services_info['resolved'];
    }

    return $services[$alias]['resolved'] = $services_info['resolver'] instanceof Closure
        ? $services_info['resolver']()
        : $services_info['resolver'];
}
