<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Unit\Auth\UnitLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UnitCreateController;

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



        //UnitController
    Route::get('unit',[UnitCreateController::class,'index'])->name('unit.index');
    Route::get('unit/create',[UnitCreateController::class,'create'])->name('unit.create');
    Route::post('unit',[UnitCreateController::class,'store'])->name('unit.store');
    Route::get('unit/{id}/edit',[UnitCreateController::class,'edit'])->name('unit.edit');
    Route::put('unit/{id}',[UnitCreateController::class,'update'])->name('unit.update');
    Route::delete('unit/{id}',[UnitCreateController::class,'destroy'])->name('unit.destroy');
    });