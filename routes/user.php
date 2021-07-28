<?php

use Illuminate\Support\Facades\Route;


Route::get('/dashboard', 'DashboardController@index')->name('index');
Route::get('/logout', 'AuthController@logout')->name('logout');
