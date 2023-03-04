<?php
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class) . '.php';
    if (file_exists(
        $library = dirname(__DIR__,1) . "/$class"
    )) {
        require_once $library;
    }
});
