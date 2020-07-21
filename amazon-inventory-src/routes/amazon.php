<?php

use \Illuminate\Support\Facades\Route;

Route::get('/marketplaces', 'MarketplaceController@index');
Route::get('/marketplaces/user', 'MarketplaceController@userMarketplaces');
Route::post('/marketplaces', 'MarketplaceController@create');

Route::get('/', 'DashboardController@index');
Route::get('/export', 'ReportController@export')->name('amazon.export');
Route::get('/export/inventory', 'ReportController@inventoryExport')->name('amazon.inventory.export');

