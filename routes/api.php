<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;

Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
