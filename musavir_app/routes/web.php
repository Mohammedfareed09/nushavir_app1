<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermisionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PremisionController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UsersController;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use Twilio\Rest\Chat\V1\Service\RoleContext;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified', 'twofactor'])
    ->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::get('/login2' ,function(){
    return view ('layouts.user.sign-in');
})->name('login2');


Route::get('register', [UsersController::class, 'showRegistrationForm'])->name('myregister.form');
Route::post('register', [UsersController::class, 'myregister'])->name('myregister');


Route::get('/phone', [UsersController::class, 'showPhoneForm'])->name('phone.form');
Route::post('/phone', [UsersController::class, 'verifyPhone'])->name('phone.verify');


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
    Route::get('/lay' ,function(){
        return view ('layouts.user.dashboard');
    })->name('adminlay');

});

// routes/web.php
Route::post('logout', [UsersController::class, 'logout'])->name('logout')->middleware('auth');



Route::middleware(['auth', 'role:Admin'])->name('Admin.')->prefix('Admin')->group(function(){
    Route::get('/admin', function (){
        return view('Admin.Index'); })->name('Adminindex');
    Route::get('/', [IndexController::class, 'Index'])->name('index');
    Route::get('/roles', [RoleController::class, 'index'])->name('rolesindex');
    Route::get('/permissions', [PermisionController::class, 'index'])->name('perindex');
});

