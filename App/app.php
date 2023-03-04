<?php

use App\Request;

require_once __DIR__ . "/../Configs/autoload.php";
require_once __DIR__ . "/../Configs/env.php";
require_once __DIR__ . "/../Configs/helpers.php";
require_once __DIR__ . "/../Routes/web.php";

$request = new Request();
$request->send();