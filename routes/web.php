<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendMoneyController;
use App\Http\Controllers\RecurringTransfersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/recurring-transfers', [RecurringTransfersController::class, '__invoke'])->name('recurring-transfers');
    Route::post('/send-money', [SendMoneyController::class, '__invoke'])->name('send-money');
});

require __DIR__.'/auth.php';
