<?php

use App\Models\User;

require_once __DIR__ . "/../../Configs/autoload.php";
require_once __DIR__ . "/../../Configs/env.php";
require_once __DIR__ . "/../../Configs/helpers.php";

$user = new User();



for ($i = 0; $i < 10; $i++) {
    echo "$i ";
    $user->create([
        "username" => "jcmOrjuela$i",
        "email" => "usuario$i@email.com",
        "name" => "Juan$i",
        "lastname" => "Moyano$i",
        "phone" => "+5731{$i}1112{$i}55",
        "password" => hash('sha256', 'Contrasen4123')
    ]);
}

$user->delete(5);
$user->search('jcmOrjuela8', 'username');
print_r($user->read(2));
print_r($user->all());
