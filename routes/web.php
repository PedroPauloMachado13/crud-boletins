<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::prefix('professor')->name('professor.')->namespace('Admin')->group(function () {

    Route::get('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/auth', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('auth');
    Route::get('/register', [\App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/create', [\App\Http\Controllers\Admin\Auth\RegisterController::class, 'create'])->name('create');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
        Route::post('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

        Route::prefix('report-cards')->name('report-cards.')->group(function () {
            Route::get('/', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'store'])->name('store');
            Route::get('/edit', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'edit'])->name('edit');
            Route::post('/update', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'update'])->name('update');
            Route::get('/delete', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'delete'])->name('delete');
        });

    });
});

Route::prefix('student')->name('student.')->namespace('Client')->group(function () {

    Route::get('/login', [\App\Http\Controllers\Client\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/auth', [\App\Http\Controllers\Client\Auth\LoginController::class, 'login'])->name('auth');
    Route::get('/register', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/create', [\App\Http\Controllers\Client\Auth\RegisterController::class, 'create'])->name('create');

    Route::middleware('auth:client')->group(function () {

        Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('dashboard');
        Route::post('/logout', [\App\Http\Controllers\Client\Auth\LoginController::class, 'logout'])->name('logout');

        Route::prefix('report-cards')->name('report-cards.')->group(function () {
            Route::get('/', [\App\Http\Controllers\ReportCards\ReportCardController::class, 'index'])->name('index');
        });

    });
});
