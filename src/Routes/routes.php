<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:51 PM
 */


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('web')->group(function () {
    Route::get('/login',
        "Anacreation\MultiAuth\Controllers\Auth\AdminLoginController@getLogin")
         ->name('admin.login');
    Route::post('/login',
        "Anacreation\MultiAuth\Controllers\Auth\AdminLoginController@postLogin")
         ->name('admin.login.submit');
    Route::get('/', "Anacreation\MultiAuth\Controllers\AdminsController@index")
         ->name('admin.home');

    Route::view('/clients', 'MultiAuth::clients')->middleware('auth:admin');
    Route::get('/profile',
        "Anacreation\MultiAuth\Controllers\AdminsController@getProfile")
         ->name('admin.profile')->middleware('auth:admin');
    Route::put('/profile',
        "Anacreation\MultiAuth\Controllers\AdminsController@putProfile")
         ->middleware('auth:admin');
});