<?php

use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestingController;
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

    Route::middleware('role:teacher,admin')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::resource('teachers', TeacherController::class)->except('show');
            Route::resource('students', StudentController::class)->except('show');
            Route::resource('groups', GroupController::class)->except('show');
        });

        Route::resource('disciplines', DisciplineController::class)->except('show');
        Route::resource('tests', TestController::class)->except(['edit', 'update']);
        Route::get('testings/{test}/start', [TestingController::class, 'teacherStart'])->name('testings.teacher.start');

        Route::get('results/teacher', [ResultController::class, 'teacherIndex'])->name('results.teacher.index');
        Route::get('results/teacher/{testing}', [ResultController::class, 'teacherShow'])->name('results.teacher.show');
        Route::get('results/{testing}/export', [ResultController::class, 'teacherExport'])->name('results.teacher.export');
    });

    Route::middleware('role:student')->group(function () {
        Route::get('testings', [TestingController::class, 'studentIndex'])->name('testings.student.index');
        Route::get('testings/{testing}', [TestingController::class, 'studentPass'])->name('testings.student.pass');
        Route::post('testings/{testing}', [TestingController::class, 'studentEnd'])->name('testings.student.end');

        Route::get('results/student', [ResultController::class, 'studentIndex'])->name('results.student.index');
    });
});
