<?php

use Routes\Route;

Route::get('/', 'HomeController@index');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
Route::get('/register', 'AuthController@RegisterIndex');
Route::post('/register', 'AuthController@register');
