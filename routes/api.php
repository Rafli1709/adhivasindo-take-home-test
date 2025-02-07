<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CareersController;

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UsersController::class);
    Route::get('/career', [CareersController::class, 'index']);
});

Route::post('/login', [AuthController::class, 'login']);
