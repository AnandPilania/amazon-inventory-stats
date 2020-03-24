<?php

use \Illuminate\Support\Facades\Route;

Route::get('/testing', 'SettingsController@index');

Route::get('/home', 'HomeController@show');

