<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admindashboard')->group(function() {
    Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');
    Route::get('/system-setting', 'SystemSettingController@index')->name('system.setting');
    Route::post('/system-setting-update', 'SystemSettingController@store')->name('system.setting.update');
});
