<?php

use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UsersController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified', 'twofactor'])
    ->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::resource('verify', TwoFactorController::class);
//     Route::get('phone-verification', [TwoFactorController::class, 'phone'])->name('veify-phone');
//     Route::post('phone-verification', [TwoFactorController::class, 'phoneVerificationStore'])->name('verify-phone.store');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Route::get('/login', [UsersController::class,'login'])->name('login');
// Route::post('/login', [UsersController::class,'auth']);

// Route::get('/register', [UsersController::class,'register'])->name('register');
// Route::post('/register', [UsersController::class,'auth']);

// routes/web.php
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::get('register', [UsersController::class, 'showRegistrationForm'])->name('myregister.form');
Route::post('register', [UsersController::class, 'myregister'])->name('myregister');


Route::get('/phone', [UsersController::class, 'showPhoneForm'])->name('phone.form');
Route::post('/phone', [UsersController::class, 'verifyPhone'])->name('phone.verify');

// Route::middleware('phone.verified')->group(function () {
//     Route::get('/phone-verify', [UsersController::class, 'showOtpForm'])->name('otp.form');
//     Route::post('/phone-verify', [UsersController::class, 'verifyOtp'])->name('otp.verify');
// });
Route::middleware('auth')->group(function () {
    Route::get('/phone', [UsersController::class, 'showPhoneForm'])->name('phone.form');
    Route::post('/phone', [UsersController::class, 'verifyPhone'])->name('phone.verify');

    Route::middleware('phone.verified')->group(function () {
        Route::get('/phone-verify', [UsersController::class, 'showOtpForm'])->name('otp.form');
        Route::post('/phone-verify', [UsersController::class, 'verifyOtp'])->name('otp.verify');
    });
});

Route::middleware(['auth', 'phone.verified', 'otp.verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::post('logout', [UsersController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/lay' ,function(){
    return view ('layouts.auth');
});
