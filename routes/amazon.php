<?php

use \Illuminate\Support\Facades\Route;

Route::get('/marketplaces', 'MarketplaceController@index');

Route::get('/home', 'HomeController@show');

