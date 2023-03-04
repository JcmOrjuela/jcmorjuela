<?php

namespace Routes;

class Route
{
    public static $map = [];

    public static function __callStatic($method, $args)
    {

        list($route, $controllerMethod) = $args;
        $controllerMethodParams = explode('@', $controllerMethod);

        if (preg_match('/(\/\w+\/)\{\w+\}/i', $route)) {
            $route = preg_replace('/(\/\w+\/)\{\w+\}/i', '$1anything', $route);
        }

        self::$map[strtoupper($method)][$route] = [
            "route" => $route,
            "controller" => "\App\Controllers\\{$controllerMethodParams[0]}",
            "method" => $controllerMethodParams[1],
            "arguments" => []
        ];
    }
}
