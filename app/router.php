<?php

const ROUTES_ACTIONS_PATH = __DIR__ . '/routes';

/**
 * @param null|array $routes
 * @return array
 */
function routes($routes = null)
{
    static $routesList = [];

    if (null !== $routes) {
        $routesList = $routes;
    }

    return $routesList;
}

/**
 * @param string $method
 * @param string $uri
 * @param callable|string $action
 */
function route($method, $uri, $action)
{
    $routes = routes();
    $uri = trim($uri, '/');

    $routes[$uri] = isset($routes[$uri])
        ? array_merge($routes[$uri], [$method => $action])
        : [$method => $action];

    routes($routes);
}

/**
 * @param integer $code
 * @param callable|null $action
 * @return callable
 */
function route_error($code, $action = null)
{
    static $errors = [];

    if (null !== $action) {
        $errors[$code] = $action;
    }

    return isset($errors[$code])
        ? $errors[$code]
        : function () use ($code) {
            http_response_code($code);
            return '';
        };
}

/**
 * @param null|string $route
 * @param null|string $method
 * @return callable
 */
function route_resolve($route = null, $method = null)
{
    $route = trim($route ?: $_SERVER['REQUEST_URI'], '/');
    $method = $method ?: $_SERVER['REQUEST_METHOD'];
    $routes = routes();

    if (!isset($routes[$route])) {
        return route_error(404);
    }
    if (!isset($routes[$route][$method])) {
        return route_error(405);
    }

    $action = $routes[$route][$method];

    return is_string($action)
        ? include(ROUTES_ACTIONS_PATH . "/$action.php")
        : $action;
}
