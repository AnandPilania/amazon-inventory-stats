<?php

use \Illuminate\Support\Facades\Route;

Route::get('/marketplaces', 'MarketplaceController@index');
Route::post('/marketplaces', 'MarketplaceController@create');

Route::get('/home', 'HomeController@show');

