<?php



use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'DashboardController@index')->name('index');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['prefix' => 'filepond', 'as' => 'access.'], function (): void {
  Route::patch('/', 'FilepondController@chunk')->name('chunk');
  Route::post('/process', 'FilepondController@upload')->name('upload');
  Route::delete('/process', 'FilepondController@delete')->name('delete');
  Route::get('load/{media}', 'FilepondController@load')->name('load');
});
