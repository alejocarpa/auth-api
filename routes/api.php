<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('v1/auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::middleware(['auth:api', 'check.activity'])->group(function () {
    Route::get('v1/auth/me', [AuthController::class, 'me']);
    Route::post('v1/auth/logout', [AuthController::class, 'logout']);
});
