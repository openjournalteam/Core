<?php



use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Controllers\Admin\{
    AccessSettingsController,
    AdministrationController,
    EmailTemplateSettingsController,
    MenuController
};
use OpenJournalTeam\Core\Http\Livewire\Admin\MailTemplatePage;

Route::group(['prefix' => 'access', 'as' => 'access.'], function (): void {
    Route::get('/', [AccessSettingsController::class, 'index'])->name('index');
    Route::get('/user_list', [AccessSettingsController::class, 'user_list'])->name('user_list');
    Route::get('/role_list', [AccessSettingsController::class, 'role_list'])->name('role_list');
    Route::get('/permission_list', [AccessSettingsController::class, 'permission_list'])->name('permission_list');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function (): void {
    Route::post('save', [AccessSettingsController::class, 'user_save'])->name('save');
    Route::get('edit/{user}', [AccessSettingsController::class, 'user_edit'])->name('edit');
    Route::delete('delete/{user}', [AccessSettingsController::class, 'user_delete'])->name('delete');
    Route::post('check_email', [AccessSettingsController::class, 'user_check_email'])->name('check_email');
});

Route::group(['prefix' => 'role', 'as' => 'role.'], function (): void {
    Route::post('save', [AccessSettingsController::class, 'role_save'])->name('save');
    Route::post('assign_permission', [AccessSettingsController::class, 'role_assign_permission'])->name('assign_permission');
    Route::delete('delete/{role}', [AccessSettingsController::class, 'role_delete'])->name('delete');
    Route::get('edit/{role}', [AccessSettingsController::class, 'role_edit'])->name('edit');
    Route::post('check_name', [AccessSettingsController::class, 'role_check_name'])->name('check_name');
    Route::get('options', [AccessSettingsController::class, 'role_options'])->name('options');
});

Route::group(['prefix' => 'permission', 'as' => 'permission.'], function (): void {
    Route::post('save', [AccessSettingsController::class, 'permission_save'])->name('save');
    Route::delete('delete/{permission}', [AccessSettingsController::class, 'permission_delete'])->name('delete');
    Route::get('edit/{permission}', [AccessSettingsController::class, 'permission_edit'])->name('edit');
    Route::post('check_name', [AccessSettingsController::class, 'permission_check_name'])->name('check_name');
    Route::get('options', [AccessSettingsController::class, 'permission_options'])->name('options');
});

Route::group(['prefix' => 'administrator', 'as' => 'administrator.'], function (): void {
    Route::get('/', [AdministrationController::class, 'index'])->name('index');
    Route::get('/clear_cache', [AdministrationController::class, 'clear_cache'])->name('clear_cache');
});

Route::group(['prefix' => 'menu', 'as' => 'menu.'], function (): void {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::post('/save', [MenuController::class, 'save'])->name('save');
    Route::delete('/delete/{menu:token}', [MenuController::class, 'delete'])->name('delete');
    Route::get('/edit/{menu:token}', [MenuController::class, 'edit'])->name('edit');
    Route::post('/sort', [MenuController::class, 'sort'])->name('sort');
    Route::get('/options', [MenuController::class, 'options'])->name('options');
    Route::get('/permission_options', [MenuController::class, 'permission_options'])->name('permission_options');
});


Route::group(['prefix' => 'email', 'as' => 'email.'], function (): void {
    Route::get('/', [EmailTemplateSettingsController::class, 'index'])->name('index');
    Route::post('/save_setup', [EmailTemplateSettingsController::class, 'save_setup'])->name('save_setup');
});
