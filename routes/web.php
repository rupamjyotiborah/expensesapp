<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/register',[PersonController::class, 'registrationForm'])->name('register');
Route::get('/expense',[ExpenseController::class, 'showForm'])->name('expense');
Route::get('/report',[ReportController::class, 'showForm'])->name('report');
Route::post('/addMember', [PersonController::class, 'register'])->name('addmember');
Route::post('/addExpense', [ExpenseController::class, 'addExpense'])->name('addexpense');
Route::post('/Expenses', [ReportController::class, 'getexpenses'])->name('getexpenses');