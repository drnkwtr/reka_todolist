<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use App\Http\Middleware\ForceAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('auth.login.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('auth.register.index');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/todolist', [TodoListController::class, 'index'])->name('todolist.index')->middleware(ForceAuthMiddleware::class);
