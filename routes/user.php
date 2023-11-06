<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RefController;


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

            //Deposit History
            Route::get('deposit/history', [UserController::class, 'depositHistory'])->name('deposit.history');
            Route::get('deposit/details/{trx}/{id}', [UserController::class, 'depositDetails'])->name('deposit.details');

            // Withdraw
            Route::get('withdraw', [UserController::class, 'withdraw'])->name('withdraw');
            Route::get('withdraw/{slug}/{id}', [UserController::class, 'withdrawSingle'])->name('withdraw.single');

            Route::post('/withdraw/{id}', [UserController::class, 'withdrawSubmit'])->name('withdraw.submit');

            Route::get('withdraw/history', [UserController::class, 'withdrawHistory'])->name('withdraw.history');
            Route::get('withdraw/details/{trx}/{id}', [UserController::class, 'withdrawDetails'])->name('withdraw.details');

            // Transaction
            Route::get('transactions', [UserController::class, 'transactions'])->name('transactions');
            Route::get('transactions/details/{trx}/{id}', [UserController::class, 'transactionsDetails'])->name('transactions.details');

            //Refferal
            Route::get('/referral-statistic', [RefController::class, 'ref'])->name('ref');
            Route::get('/referral-commission', [RefController::class, 'ref_com'])->name('ref_com');

            //user profile
            Route::get('/profile', [UserController::class, 'profile'])->name('profile');
            Route::get('/profile-edit', [UserController::class, 'profileEdit'])->name('profile.edit');

            Route::get('/change-password', [UserController::class, 'changePass'])->name('change.password');
            Route::put('/password', [UserController::class, 'passwordUpdate'])->name('password.update');
            Route::put('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');

            Route::get('/login/history', [UserController::class, 'loginHistory'])->name('login.history');


            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        });


    });
Auth::routes();
