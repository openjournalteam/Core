<?php



use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Controllers\AttachmentController;
use OpenJournalTeam\Core\Http\Controllers\AuthController;
use OpenJournalTeam\Core\Http\Controllers\PluginSettingsController;
use OpenJournalTeam\Core\Http\Controllers\WidgetController;
use OpenJournalTeam\Core\Http\Livewire\DashboardPage;

Route::get('/dashboard', DashboardPage::class)->name('index');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'attachment', 'as' => 'attachment.'], function (): void {
  Route::post('/', [AttachmentController::class,  'upload'])->name('upload');
  Route::post('delete/{media:uuid}', [AttachmentController::class, 'delete'])->name('delete');
  Route::post('delete_temporary_file/{encryptedFilePath}', [AttachmentController::class, 'delete_temporary'])->name('delete_temporary_file');
});

Route::group(['prefix' => '/list-plugins', 'as' => 'plugins.'], function (): void {
  /* PluginController */

  /* PluginSettingsController */
  Route::get('/install/{slug}', [PluginSettingsController::class, 'installPlugin'])->name('install');
  Route::get('/', [PluginSettingsController::class, 'index'])->name('index');
  Route::post('/toggle', [PluginSettingsController::class, 'toggle'])->name('toggle');
  Route::post('/migrate', [PluginSettingsController::class, 'migrate'])->name('migrate');
  Route::post('/delete', [PluginSettingsController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'widget', 'as' => 'widget.'], function (): void {
  Route::post('/update-setting', [WidgetController::class, 'updateSetting'])->name('update-setting');
});
