<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\permissionController;
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

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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
    Route::get('/permissions', [permissionController::class, 'index'])->name('perindex');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('permissions', permissionController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
});

Route::get('admin/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('admin.roles.permissions');

// Add this to support POST requests
Route::post('admin/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('admin.roles.permissions');

// If you're using a GET request for displaying permissions (which is likely what you have)
Route::get('admin/roles/{role}/permissions', [RoleController::class, 'showPermissions'])->name('admin.roles.showPermissions');

Route::post('admin/roles/{role}/permissions/{permission}/revoke', [RoleController::class, 'revokePermission'])->name('admin.roles.permissions.revoke');
Route::delete('admin/roles/{role}/permissions/{permission}/revoke', [RoleController::class, 'revokePermission'])->name('admin.roles.permissions.revoke');
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('users', UserController::class);

});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);

    // Add this route for removing roles
    Route::post('users/{user}/roles/{role}/remove', [UserController::class, 'removeRole'])->name('users.roles.remove');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);

    // Route to display user roles
    Route::get('users/{user}/roles', [UserController::class, 'show'])->name('users.roles');

    // Route to remove a specific role from a user
    Route::post('users/{user}/roles/{role}/remove', [UserController::class, 'removeRole'])->name('users.roles.remove');

    // Route to assign a role to a user
    Route::post('users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles.assign');
});

Route::get('admin/users/{user}/permissions', [UserController::class, 'showPermissions'])->name('admin.users.permissions');
Route::post('admin/users/{user}/roles/{role}/remove', [UserController::class, 'removeRole'])->name('admin.users.roles.remove');
Route::delete('admin/users/{user}/roles/{role}/remove', [UserController::class, 'removeRole'])->name('admin.users.roles.remove');
Route::delete('/user', [UsersController::class, 'deleteUser'])->name('delete');



Route::get('/profile', [UsersController::class, 'showProfile'])->name('profile.show');
Route::get('/profile/edit', [UsersController::class, 'edit'])->name('profile.edit');
Route::post('/profile/edit', [UsersController::class, 'update'])->name('profile.updatee');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
