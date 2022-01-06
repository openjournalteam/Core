<?php



use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Controllers\AuthController;
use OpenJournalTeam\Core\Http\Livewire\DashboardPage;

Route::get('/', DashboardPage::class)->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
