<?php

use App\Http\Controllers\OtpController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TrackingController;
use App\Http\Middleware\VerifyOtp;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Student-facing)
|--------------------------------------------------------------------------
|
| Routes for students and public users to request documents,
| track requests, and manage OTP verification.
|
*/

// --- OTP Routes ---
Route::prefix('otp')->name('otp.')->group(function () {
    Route::get('/request', [OtpController::class, 'showRequestForm'])->name('request');
    Route::post('/send', [OtpController::class, 'send'])->name('send');
    Route::get('/verify', [OtpController::class, 'showVerifyForm'])->name('verify');
    Route::post('/verify', [OtpController::class, 'verify'])->name('verify.submit');
    Route::get('/resend', [OtpController::class, 'resend'])->name('resend');
});

// --- Document Request Routes ---
Route::prefix('request')->name('request.')->group(function () {
    // Selection page (no OTP required)
    Route::get('/select', [RequestController::class, 'select'])->name('select');
    Route::post('/select', [RequestController::class, 'storeSelection'])->name('select.store');
    
    // Create and submit request (requires OTP verification)
    Route::middleware([VerifyOtp::class . ':submission'])->group(function () {
        Route::get('/create', [RequestController::class, 'create'])->name('create');
        Route::post('/store', [RequestController::class, 'store'])->name('store');
    });
    
    // Success page (no authentication required)
    Route::get('/success/{tracking_id}', [RequestController::class, 'success'])->name('success');
});

// --- Tracking Routes ---
Route::prefix('tracking')->name('tracking.')->group(function () {
    Route::get('/form', [TrackingController::class, 'form'])->name('form');
    Route::post('/track', [TrackingController::class, 'track'])->name('track');
});
