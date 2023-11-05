<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPlanController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;



use Illuminate\Support\Facades\Route;



    Route::name('user.')->group(function() {
        Route::middleware(['auth'])->group(function () {
            //Your routes here
            //Dashboard
            Route::get('/home', [HomeController::class, 'index'])->name('home');

            //Plan
            Route::get('/investment-plans', [UserPlanController::class, 'index'])->name('plan.index');
            Route::get('/plan/log', [UserPlanController::class, 'log'])->name('plan.log');

            Route::post('/plan/invest/{id}', [UserPlanController::class, 'invest'])->name('plan.invest');
            Route::get('/invest-return', [UserPlanController::class, 'invest_history'])->name('invest.history');
            Route::get('/invest-return/history', [UserPlanController::class, 'investReturn'])->name('invest.return.history');
            Route::get('/invest/details/{slug}/{id}', [UserPlanController::class, 'investSingle'])->name('invest.details');

            //

            Route::get('/referral-statistic', [ReferralStatisticController::class, 'index'])->name('referral.statistic');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        });


    });
Auth::routes();
