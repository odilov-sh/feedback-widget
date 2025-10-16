<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WidgetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/widget', [WidgetController::class, 'widget'])->name('widget');
Route::get('/view-widget', [WidgetController::class, 'viewWidget'])->name('view-widget');

Route::get('login', [AuthController::class, 'viewLoginForm'])->name('view-login-form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => ['auth', 'role:manager'],
    'prefix'     => 'dashboard',
    'as'         => 'dashboard.',
], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.tickets.index');
    });

    Route::resource('tickets', TicketController::class)
        ->middleware(['auth', 'role:manager'])
        ->only(['index', 'show', 'destroy']);

    Route::put('tickets/{ticket}/change-status', [TicketController::class, 'changeStatus'])
        ->name('tickets.change-status');

    Route::get('tickets/{media}/download-media', [TicketController::class, 'downloadMedia'])
        ->name('tickets.download-media');
});
