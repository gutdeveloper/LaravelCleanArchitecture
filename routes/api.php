<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\AuthController;

Route::group(['prefix' => 'v1'], function () {
    Route::middleware(['throttle:60,1'])->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/login', [AuthController::class, 'login']);
            Route::group(['middleware' => ['api']], function () {
                Route::get('/profile', [AuthController::class, 'profile']);
            });
        });
    });
});
