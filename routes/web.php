<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:admin'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/', 'authenticate');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store');
        Route::post('/logout', 'logout');
    });
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', function () {
        return view('index', ['title' => 'Dashboard', 'active' => 'dashboard']);
    })->name('dashboard');
});