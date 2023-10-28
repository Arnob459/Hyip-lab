<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;



use Illuminate\Support\Facades\Route;



    Route::name('user.')->group(function() {
        Route::middleware(['auth'])->group(function () {
            //Your routes here
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        });


    });
Auth::routes();
