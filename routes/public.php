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
    Route::get('/request', \App\Livewire\Pages\Public\Otp\RequestOtp::class)->name('request');
    Route::get('/verify', \App\Livewire\Pages\Public\Otp\VerifyOtp::class)->name('verify');
});

// --- Document Request Routes ---
Route::prefix('request')->name('request.')->group(function () {
    // Selection page (no OTP required)
    Route::get('/select', \App\Livewire\Pages\Public\Request\SelectDocument::class)->name('select');
    
    // Create and submit request (requires OTP verification)
    Route::middleware([VerifyOtp::class . ':submission'])->group(function () {
        Route::get('/create', \App\Livewire\Pages\Public\Request\CreateRequest::class)->name('create');
    });
    
    // Success page (no authentication required)
    Route::get('/success/{tracking_id}', [RequestController::class, 'success'])->name('success');
});

// --- Tracking Routes ---
Route::prefix('tracking')->name('tracking.')->group(function () {
    Route::get('/form', \App\Livewire\Pages\Public\Tracking\TrackRequest::class)->name('form');
});
