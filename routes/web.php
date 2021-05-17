<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeacherController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', RouteServiceProvider::HOME);
    Route::view(RouteServiceProvider::HOME, 'home');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
        Route::resource('teachers', TeacherController::class)->except('show');
    });
});
