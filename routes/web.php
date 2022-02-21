<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// LOGOUT ROUTE
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


// USER MANAGEMENT ROUTES: NOTE: This is a way of grouping all related routes
Route::prefix('users')->group(function(){

    // View Users Route
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');

    // Add User Route
    Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');

    // Store/Create User Route
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

    // Edit User Route
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');

    // Update User Route
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

    // Delete User Route
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});


// USER PROFILE AND CHANGE PASSWORD ROUTES
Route::prefix('profile')->group(function(){

    // View Profile Route
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

    // Edit Profile Route
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

    // Store/Update Profile Route
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

    // Passsword View Route
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

    // Passsword Update Route
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});