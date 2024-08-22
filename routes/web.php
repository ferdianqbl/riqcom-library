<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanTransactionController;
use App\Http\Controllers\ReturnTransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:admin'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/', 'authenticate');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store');
    });
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', function () {
        return view('index', ['title' => 'Dashboard', 'active' => 'dashboard']);
    })->name('dashboard');

    Route::controller(BookController::class)->group(function () {
        Route::get('/books', 'index')->name('books.index');
        Route::get('/books/add', 'create');
        Route::post('/books/add', 'store');
        Route::delete('/books/{id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/add', 'create');
        Route::post('/users/add', 'store');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::controller(LoanTransactionController::class)->group(function () {
        Route::get('/loans', 'index')->name('loans.index');
        Route::get('/loans/add', 'create');
        Route::post('/loans/add', 'store');
        Route::delete('/loans/{id}', 'destroy');
    });

    Route::controller(ReturnTransactionController::class)->group(function () {
        Route::get('/returns', 'index')->name('returns.index');
        Route::get('/returns/add', 'create');
        Route::get('/returns/add/price', 'price');
        Route::post('/returns/add', 'store');
        Route::delete('/returns/{id}', 'destroy');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
});