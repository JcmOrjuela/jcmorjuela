<?php

use App\Controllers\AuthController;
use App\Request;

require_once __DIR__ . "/../Configs/autoload.php";
require_once __DIR__ . "/../Configs/env.php";
require_once __DIR__ . "/../Configs/helpers.php";

function login()
{
    $username = 'jcmOrjuela7';
    $password = hash('sha256', 'Contrasen4123');

    $auth = new AuthController();
    var_dump($auth->auth($username, $password));

    $username = 'jcmOrjuela71';
    $password = hash('sha256', 'Contrasen4123');

    var_dump($auth->auth($username, $password));

    $username = 'jcmOrjuela71';
    $password = hash('sha256', 'Contrasen41c23');

    var_dump($auth->auth($username, $password));

    $username = 'jcmOrjuela7';
    $password = hash('sha256', 'Contrasen4123');

    var_dump($auth->auth($username, $password));
}

function register()
{
    $_POST = array(
        'username' => 'JuanC123',
        'password' => 'Juan*2',
        'phone' => '+764014755',
        'name' => 'Juan',
        'email' => 'camilo@mail.com',
        'lastname' => 'Orjuela'
    );

    $auth = new AuthController();

    $result = $auth->register(new Request());

    print_r($result);
}

register();