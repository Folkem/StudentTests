<?php

use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');

    Route::get('register', [LoginController::class, 'registerShow'])->name('register.index');
    Route::post('register', [LoginController::class, 'registerStore'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', RouteServiceProvider::HOME);
    Route::view(RouteServiceProvider::HOME, 'home')->name('home');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->group(function () {
        Route::resource('teachers', TeacherController::class)->except('show');
        Route::resource('groups', GroupController::class)->except('show');
    });
    Route::resource('disciplines', DisciplineController::class)->except('show');
    Route::resource('tests', TestController::class)->except(['edit', 'update']);
});
