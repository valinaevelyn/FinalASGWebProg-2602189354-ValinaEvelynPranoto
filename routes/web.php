<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store');
Route::get('/register/pay', [RegisterController::class, 'pay'])->name('pay');
Route::post('/register/pay', [RegisterController::class, 'payment'])->name('payment');
Route::put('/register/pay/overpaidyes', [RegisterController::class, 'overpaidyes'])->name('overpaidyes');