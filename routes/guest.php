<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('home');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@register')->name('register.post');
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login')->name('login.post');
