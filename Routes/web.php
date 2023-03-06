<?php

use Routes\Route;

Route::get('/', 'HomeController@index');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::get('/register', 'AuthController@RegisterIndex');
Route::post('/register', 'AuthController@register');

Route::get('/my-movies', 'MyMoviesController@index');
Route::post('/my-movies', 'MyMoviesController@store');
Route::delete('/my-movies/{id}', 'MyMoviesController@destroy');
