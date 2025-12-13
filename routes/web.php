<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/admin-dashboard', function () {
    return view('admindashboard/admin-dashboard');
})->middleware(['auth'])->name('admin.dashboard');

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Shipment Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('/shipments/{id}', [ShipmentController::class, 'show'])->name('shipments.show');
    Route::put('/shipments/{id}', [ShipmentController::class, 'update'])->name('shipments.update');
    Route::delete('/shipments/{id}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
});

// Customer Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [\App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'show'])->name('customers.show');
    Route::put('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');
});