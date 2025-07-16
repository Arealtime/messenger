<?php

use Arealtime\Messenger\App\Http\Controllers\ConversationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->prefix('api/arealtime/conversations')
    ->name('arealtime.conversations.')
    ->group(function () {
        Route::controller(ConversationController::class)->group(function () {
            Route::get('', 'index');
            Route::get('{conversation}', 'get');
            Route::post('', 'store');
        });
    });
