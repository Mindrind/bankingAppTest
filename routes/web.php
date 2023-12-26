<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

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


Route::middleware('auth')->group(function () {
    // Home/Dashboard - You may adjust the existing dashboard route as needed
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Banking application routes
    Route::get('/home', [AccountController::class, 'index'])->name('home');
    Route::get('/deposit', [TransactionController::class, 'createDeposit'])->name('deposit.create');
    Route::post('/deposit', [TransactionController::class, 'storeDeposit'])->name('deposit.store');
    Route::get('/withdraw', [TransactionController::class, 'createWithdrawal'])->name('withdraw.create');
    Route::post('/withdraw', [TransactionController::class, 'storeWithdrawal'])->name('withdraw.store');
    Route::get('/transfer', [TransactionController::class, 'createTransfer'])->name('transfer.create');
    Route::post('/transfer', [TransactionController::class, 'storeTransfer'])->name('transfer.store');
    Route::get('/statement', [AccountController::class, 'statement'])->name('account.statement')->middleware('auth');


    // Existing profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/transactions', function () {
        return redirect('/dashboard');
    })->name('transactions.index')->middleware('auth');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
