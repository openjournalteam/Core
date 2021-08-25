<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'panel', 'as' => 'panel.'], function (): void {
    Route::get('/register_customer_user', 'PanelController@registerCustomerUser')->name('register_customer_user');
});
