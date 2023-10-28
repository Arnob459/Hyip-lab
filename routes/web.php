<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CheckUsernameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
Route::get('checkusername', [CheckUsernameController::class, 'Checkusername'])->name('checkusername');
Route::get('checkemail', [CheckUsernameController::class, 'checkemail'])->name('checkemail');
Route::get('checkphone', [CheckUsernameController::class, 'checkphone'])->name('checkphone');
Route::get('/pass', [CheckUsernameController::class, 'pass'])->name('pass');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
