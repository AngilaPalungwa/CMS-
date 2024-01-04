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

Route::prefix('login')->group(function() {
    Route::get('/', 'LoginController@index')->name('login');
    Route::post('/submit', 'LoginController@submit')->name('frontend.login');
    Route::get('/logout','LoginController@logout')->name('logout');

    Route::get('/register', 'RegisterController@create')->name('frontend.register');
    Route::post('/register-submit', 'RegisterController@store')->name('register.submit');
    Route::get('/forget-password', 'ResetPasswordController@index')->name('login.forget');
    Route::post('/reset-password', 'ResetPasswordController@resetPassword')->name('login.forget.reset');
    Route::get('/show-reset/{token}', 'ResetPasswordController@showResetForm')->name('login.forget.form');
    Route::post('/handle-reset/{token}', 'ResetPasswordController@handleReset')->name('login.forget.handle');

});
