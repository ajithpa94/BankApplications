<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//deposit
Route::get('/deposit', [App\Http\Controllers\HomeController::class, 'deposit'])->name('deposit');
Route::post('/storedeposit', [App\Http\Controllers\HomeController::class, 'storedeposit'])->name('storedeposit');
//Withdrawal
Route::get('/withdraw', [App\Http\Controllers\HomeController::class, 'withdraw'])->name('withdraw');
Route::post('/storewithdraw', [App\Http\Controllers\HomeController::class, 'storewithdraw'])->name('storewithdraw');

//transfer fund
Route::get('/transfer_money', [App\Http\Controllers\HomeController::class, 'transfer_money'])->name('transfer_money');
Route::post('/strore_transfer_money', [App\Http\Controllers\HomeController::class, 'strore_transfer_money'])->name('strore_transfer_money');

//statement
Route::get('/statement', [App\Http\Controllers\HomeController::class, 'statement'])->name('statement');


