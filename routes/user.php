<?php



use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'DashboardController@index')->name('index');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['prefix' => 'attachment', 'as' => 'attachment.'], function (): void {
  Route::post('/', 'AttachmentController@upload')->name('upload');
  Route::post('delete/{media:uuid}', 'AttachmentController@delete')->name('delete');
  Route::post('delete_temporary_file/{encryptedFilePath}', 'AttachmentController@delete_temporary')->name('delete_temporary_file');
});

Route::group(['prefix' => '/list-plugins', 'as' => 'plugins.'], function (): void {
  /* PluginController */

  /* PluginSettingsController */
  Route::get('/install/{slug}', 'PluginSettingsController@installPlugin')->name('install');
  Route::get('/', 'PluginSettingsController@index')->name('index');
  Route::post('/toggle', 'PluginSettingsController@toggle')->name('toggle');
  Route::post('/migrate', 'PluginSettingsController@migrate')->name('migrate');
  Route::post('/delete', 'PluginSettingsController@delete')->name('delete');
});

Route::group(['prefix' => 'widget', 'as' => 'widget.'], function (): void {
  Route::post('/update-setting', 'WidgetController@updateSetting')->name('update-setting');
});
