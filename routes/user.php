<?php



use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'DashboardController@index')->name('index');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['prefix' => 'attachment', 'as' => 'attachment.'], function (): void {
  Route::post('/', 'AttachmentController@upload')->name('upload');
  Route::post('delete/{media:uuid}', 'AttachmentController@delete')->name('delete');
  Route::post('delete_temporary_file/{encryptedFilePath}', 'AttachmentController@delete_temporary')->name('delete_temporary_file');
});
