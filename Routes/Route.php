<?php

namespace Routes;

class Route
{
    public static $map = [];

    public static function __callStatic($method, $args)
    {

        list($route, $controllerMethod) = $args;
        $controllerMethodParams = explode('@', $controllerMethod);
        $patern = '(\/[a-zA-Z-._]+\/)\{\w+\}';
        if (preg_match("/$patern/i", $route)) {
            $route = preg_replace("/$patern/i", '$1anything', $route);
        }

        self::$map[strtoupper($method)][$route] = [
            "controller" => "\App\Controllers\\{$controllerMethodParams[0]}",
            "method" => $controllerMethodParams[1],
        ];

        return self::class;
    }

    public static function middleware(string $middleware)
    {
        dd($middleware);
    }
}
