<?php

use Illuminate\Support\Facades\Route;
use OpenJournalTeam\Core\Http\Controllers\AuthCustomerController;
use OpenJournalTeam\Core\Http\Controllers\DashboardCustomerController;
use OpenJournalTeam\Core\Http\Livewire\TicketDetail;

Route::get('/', [DashboardCustomerController::class, 'index'])->name('home');

Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
    Route::get('/status', [DashboardCustomerController::class, 'getStatusTicket'])->name('status');
    Route::post('/save', [DashboardCustomerController::class, 'ticketCreate'])->name('save');
    Route::get('/detail/{customer:token}/{customerTicket}', TicketDetail::class)->name('detail');
    Route::get('/closed/{customerTicket}', [DashboardCustomerController::class, 'ticketClosed'])->name('closed');
    Route::get('/datatable/{customer}/{status}', [DashboardCustomerController::class, 'ticketDatatable'])->name('datatable');
});

Route::get('/login', [AuthCustomerController::class, 'index'])->name('login');
Route::post('/login', [AuthCustomerController::class, 'login'])->name('login.post');
Route::post('/oauth2', [AuthCustomerController::class, 'loginWithOAuth2'])->name('oauth2');
