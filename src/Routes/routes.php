<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:51 PM
 */


use Illuminate\Support\Facades\Route;

Route::prefix(config('admin.route_prefix'))->middleware('web')->group(function (
) {
    Route::get('/login',
        "Anacreation\MultiAuth\Controllers\Auth\AdminLoginController@getLogin")
         ->name('admin.login');
    Route::post('/login',
        "Anacreation\MultiAuth\Controllers\Auth\AdminLoginController@postLogin")
         ->name('admin.login.submit');
    Route::get('/', "Anacreation\MultiAuth\Controllers\AdminsController@index")
         ->name('admin.home');
});