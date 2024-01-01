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

Route::prefix('adminuser')->group(function() {
    Route::get('/', 'AdminUserController@index')->name('users.index');
    Route::get('/create', 'AdminUserController@create')->name('users.create');
    Route::post('/store', 'AdminUserController@store')->name('users.store');
    Route::post('/reset', 'AdminUserController@reset')->name('users.password.reset');
    Route::get('edit/{id}', 'AdminUserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'AdminUserController@update')->name('users.update');
    Route::get('/delete/{id}', 'AdminUserController@destroy')->name('users.delete');
});
