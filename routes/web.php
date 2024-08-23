<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store');
Route::get('/register/pay', [RegisterController::class, 'pay'])->name('pay');
Route::post('/register/pay', [RegisterController::class, 'payment'])->name('payment');
Route::put('/register/pay/overpaidyes', [RegisterController::class, 'overpaidyes'])->name('overpaidyes');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/filter/{gender}', [HomeController::class, 'filter_gender'])->name('filter_gender');
Route::post('/home/search', [HomeController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::resource('/friend', FriendController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/visibility', [ProfileController::class, 'visibility'])->name('visibility');
    Route::get('/topup', [ProfileController::class, 'show_topup'])->name('show_topup');
    Route::put('/topup/save', [ProfileController::class, 'topup'])->name('topup');
    Route::resource('/transaction', TransactionController::class);
    Route::get('/myavatar', [TransactionController::class, 'myavatar'])->name('myavatar');
    Route::put('/myavatar/{avatar_id}', [TransactionController::class, 'useavatar'])->name('useavatar');
    Route::get('/sendavatar', [TransactionController::class, 'sendavatar'])->name('sendavatar');
    Route::post('/sendavatar/sendgift', [TransactionController::class, 'sendgift'])->name('sendgift');
});

Route::get('/locale/{loc}', function ($loc) {
    Session::put('locale', $loc);
    return redirect()->back();
})->name('locale');