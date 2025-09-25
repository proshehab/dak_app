<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Unit\Auth\UnitLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UnitCreateController;
use App\Http\Controllers\Admin\UnitRegistrationController;
use App\Http\Controllers\Unit\UnitDashboardController;

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
    Route::post('login', [UnitLoginController::class, 'unitlogin'])->name('Unitlogin');
    Route::get('register', [UnitLoginController::class, 'showRegisterForm'])->name('Unitregister');
    Route::post('register', [UnitLoginController::class, 'register']);
    Route::get('logout', [UnitLoginController::class, 'logout'])->name('Unitlogout');
});


// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Admin Dashboard Controller
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


    // Unit Registration Routes
    Route::get('unitRegistration', [UnitRegistrationController::class, 'index'])->name('unitRegistration.index');
    Route::get('unitRegistration/create', [UnitRegistrationController::class, 'create'])->name('unitRegistration.create');
    Route::post('unitRegistration', [UnitRegistrationController::class, 'store'])->name('unitRegistration.store');
    Route::get('unitRegistration/{id}/edit', [UnitRegistrationController::class, 'edit'])->name('unitRegistration.edit');
    Route::put('unitRegistration/{id}', [UnitRegistrationController::class, 'update'])->name('unitRegistration.update');
    Route::delete('unitRegistration/{id}', [UnitRegistrationController::class, 'destroy'])->name('unitRegistration.destroy');


    //UnitController
    Route::get('unit',[UnitCreateController::class,'index'])->name('unit.index');
    Route::get('unit/create',[UnitCreateController::class,'create'])->name('unit.create');
    Route::post('unit',[UnitCreateController::class,'store'])->name('unit.store');
    Route::get('unit/{id}/edit',[UnitCreateController::class,'edit'])->name('unit.edit');
    Route::put('unit/{id}',[UnitCreateController::class,'update'])->name('unit.update');
    Route::delete('unit/{id}',[UnitCreateController::class,'destroy'])->name('unit.destroy');
    });


    Route::prefix('unit')->name('unit.')->middleware('auth:unit')->group(function () {

    // Unit Dashboard Controller
    Route::get('dashboard', [UnitDashboardController::class, 'index'])->name('dashboard');

  
});
