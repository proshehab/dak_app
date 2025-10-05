<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Unit\Auth\UnitLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DakCreateController;
use App\Http\Controllers\Admin\UnitCreateController;
use App\Http\Controllers\Admin\UnitRegistrationController;
use App\Http\Controllers\Unit\UnitDashboardController;
use App\Http\Controllers\Admin\DakReceivedQRcodeController;
use App\Http\Controllers\Unit\UnitDakReceivedConfirmationController;
use App\Http\Controllers\Unit\UnitDakReceivedStatusController;
use App\Http\Controllers\Admin\DakReceivedTrackingController;

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


    //UnitController
    Route::get('unit',[UnitCreateController::class,'index'])->name('unit.index');
    Route::get('unit/create',[UnitCreateController::class,'create'])->name('unit.create');
    Route::post('unit',[UnitCreateController::class,'store'])->name('unit.store');
    Route::get('unit/{id}/edit',[UnitCreateController::class,'edit'])->name('unit.edit');
    Route::put('unit/{id}',[UnitCreateController::class,'update'])->name('unit.update');
    Route::delete('unit/{id}',[UnitCreateController::class,'destroy'])->name('unit.destroy');

    // Unit Registration Routes
    Route::get('unitRegistration', [UnitRegistrationController::class, 'index'])->name('unitRegistration.index');
    Route::get('unitRegistration/create', [UnitRegistrationController::class, 'create'])->name('unitRegistration.create');
    Route::post('unitRegistration', [UnitRegistrationController::class, 'store'])->name('unitRegistration.store');
    Route::get('unitRegistration/{id}/edit', [UnitRegistrationController::class, 'edit'])->name('unitRegistration.edit');
    Route::put('unitRegistration/{id}', [UnitRegistrationController::class, 'update'])->name('unitRegistration.update');
    Route::delete('unitRegistration/{id}', [UnitRegistrationController::class, 'destroy'])->name('unitRegistration.destroy');

    // Dak Create Routes
    Route::get('dakCreate',[DakCreateController::class,'index'])->name('dakCreate.index');
    Route::get('dakCreate/create',[DakCreateController::class,'create'])->name('dakCreate.create');
    Route::post('dakCreate',[DakCreateController::class,'store'])->name('dakCreate.store');
    Route::get('dakCreate/{id}/edit',[DakCreateController::class,'edit'])->name('dakCreate.edit');
    Route::put('dakCreate/{id}',[DakCreateController::class,'update'])->name('dakCreate.update');
    Route::delete('dakCreate/{id}',[DakCreateController::class,'destroy'])->name('dakCreate.destroy');

    // Dak QR Code Controller
    Route::get('dak-addresses-qrcode/{id}', [DakReceivedQRcodeController::class, 'generate'])->name('qrcode.generate');
    Route::get('dak-addresses-qrcode/{id}/edit', [DakReceivedQRcodeController::class, 'edit'])->name('qrcode.edit');
    Route::post('dak-addresses-qrcode/{id}', [DakReceivedQRcodeController::class, 'update'])->name('qrcode.update');
    Route::post('dak-addresses-qrcode/bulk-delete', [DakReceivedQRcodeController::class, 'bulkDelete'])->name('qrcode.bulkDelete');
    Route::post('qrcodes/bulk-print', [DakReceivedQRcodeController::class, 'bulkPrint'])->name('qrcode.bulkPrint');

      // Admin Tracking Routes
    Route::get('dakTracking', [DakReceivedTrackingController::class, 'index'])->name('tracking.index');
    Route::post('dakTracking/scan', [DakReceivedTrackingController::class, 'scan'])->name('tracking.scan');

    });


    Route::prefix('unit')->name('unit.')->middleware('auth:unit')->group(function () {

    // Unit Dashboard Controller
    Route::get('dashboard', [UnitDashboardController::class, 'index'])->name('dashboard');

    Route::get('dak-received-confirmation', [UnitDakReceivedStatusController::class, 'receivedConfirmation'])->name('dak.received-confirmation');
    
  
});
