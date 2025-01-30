<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\TaskController;
use App\Http\Middleware\AuthByApiTokenMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::group(['middleware' => AuthByApiTokenMiddleware::class], function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::apiResource('tasks', TaskController::class);
    });
});
