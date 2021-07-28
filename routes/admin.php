<?php



use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'plugins', 'as' => 'plugins.'], function (): void {
    Route::get('/', 'PluginSettingsController@index')->name('index');
    Route::post('/toggle', 'PluginSettingsController@toggle')->name('toggle');
    Route::post('/migrate', 'PluginSettingsController@migrate')->name('migrate');
    Route::post('/delete', 'PluginSettingsController@delete')->name('delete');
});

Route::group(['prefix' => 'access', 'as' => 'access.'], function (): void {
    Route::get('/', 'AccessSettingsController@index')->name('index');
    Route::get('/user_list', 'AccessSettingsController@user_list')->name('user_list');
    Route::get('/role_list', 'AccessSettingsController@role_list')->name('role_list');
    Route::get('/permission_list', 'AccessSettingsController@permission_list')->name('permission_list');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function (): void {
    Route::post('save', 'AccessSettingsController@user_save')->name('save');
    Route::get('edit/{user}', 'AccessSettingsController@user_edit')->name('edit');
    Route::delete('delete/{user}', 'AccessSettingsController@user_delete')->name('delete');
    Route::post('check_email', 'AccessSettingsController@user_check_email')->name('check_email');
});

Route::group(['prefix' => 'role', 'as' => 'role.'], function (): void {
    Route::post('save', 'AccessSettingsController@role_save')->name('save');
    Route::post('assign_permission', 'AccessSettingsController@role_assign_permission')->name('assign_permission');
    Route::delete('delete/{role}', 'AccessSettingsController@role_delete')->name('delete');
    Route::get('edit/{role}', 'AccessSettingsController@role_edit')->name('edit');
    Route::post('check_name', 'AccessSettingsController@role_check_name')->name('check_name');
    Route::get('options', 'AccessSettingsController@role_options')->name('options');
});

Route::group(['prefix' => 'permission', 'as' => 'permission.'], function (): void {
    Route::post('save', 'AccessSettingsController@permission_save')->name('save');
    Route::delete('delete/{permission}', 'AccessSettingsController@permission_delete')->name('delete');
    Route::get('edit/{permission}', 'AccessSettingsController@permission_edit')->name('edit');
    Route::post('check_name', 'AccessSettingsController@permission_check_name')->name('check_name');
    Route::get('options', 'AccessSettingsController@permission_options')->name('options');
});

Route::group(['prefix' => 'administrator', 'as' => 'administrator.'], function (): void {
    Route::get('/', 'AdministrationController@index')->name('index');
    Route::get('/clear_cache', 'AdministrationController@clear_cache')->name('clear_cache');
});

Route::group(['prefix' => 'menu', 'as' => 'menu.'], function (): void {
    Route::get('/', 'MenuController@index')->name('index');
    Route::post('/save', 'MenuController@save')->name('save');
    Route::delete('/delete/{menu:token}', 'MenuController@delete')->name('delete');
    Route::get('/edit/{menu:token}', 'MenuController@edit')->name('edit');
    Route::post('/sort', 'MenuController@sort')->name('sort');
    Route::get('/options', 'MenuController@options')->name('options');
});
