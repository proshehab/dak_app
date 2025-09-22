<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Unit\Auth\UnitLoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showAdminLoginForm'])->name('Adminlogin');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

// Unit Authentication Routes
Route::prefix('unit')->name('unit.')->group(function () {
    Route::get('login', [UnitLoginController::class, 'showUnitLoginForm'])->name('Unitlogin');
    Route::get('register', [UnitLoginController::class, 'showRegisterForm'])->name('Unitregister');
    Route::post('register', [UnitLoginController::class, 'register']);
    Route::get('logout', [UnitLoginController::class, 'logout'])->name('Unitlogout');
});


// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Admin Dashboard Controller
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });