<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RequestManagementController;
use App\Http\Middleware\VerifyOtp;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// OTP Routes
Route::prefix('otp')->group(function () {
    Route::get('/request', [OtpController::class, 'showRequestForm'])->name('otp.request');
    Route::post('/send', [OtpController::class, 'send'])->name('otp.send');
    Route::get('/verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::get('/resend', [OtpController::class, 'resend'])->name('otp.resend');
});

// Document Request Routes (OTP Protected)
Route::middleware([VerifyOtp::class . ':submission'])->group(function () {
    Route::get('/request/create', [RequestController::class, 'create'])->name('request.create');
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
});

Route::get('/request/success/{tracking_id}', [RequestController::class, 'success'])->name('request.success');

// Tracking Routes (OTP Protected)
Route::middleware([VerifyOtp::class . ':tracking'])->group(function () {
    Route::get('/tracking/form', [TrackingController::class, 'form'])->name('tracking.form');
    Route::post('/tracking/track', [TrackingController::class, 'track'])->name('tracking.track');
});

// Admin/Registrar Routes (Authentication Required)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/requests/{id}', [DashboardController::class, 'show'])->name('admin.requests.show');
    
    Route::post('/requests/{id}/update-status', [RequestManagementController::class, 'updateStatus'])
        ->name('admin.requests.update-status');
    Route::post('/requests/bulk-update', [RequestManagementController::class, 'bulkUpdate'])
        ->name('admin.requests.bulk-update');
    Route::delete('/requests/{id}', [RequestManagementController::class, 'destroy'])
        ->name('admin.requests.destroy');
});

// Breeze Default Dashboard (redirect to admin dashboard)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
