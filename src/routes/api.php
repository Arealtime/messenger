<?php

use Arealtime\Post\App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->prefix('api/arealtime/posts')
    ->name('arealtime.conversations.')
    ->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('', 'index');
            Route::get('{ownedPost}', 'get');
            Route::post('', 'store');
            Route::put('{ownedPost}', 'update');
            Route::delete('{ownedPost}', 'destroy');
        });
    });
