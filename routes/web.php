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

Route::get('/how-to-request', function () {
    return view('how-to-request');
})->name('how-to-request');

// OTP Routes
Route::prefix('otp')->group(function () {
    Route::get('/request', [OtpController::class, 'showRequestForm'])->name('otp.request');
    Route::post('/send', [OtpController::class, 'send'])->name('otp.send');
    Route::get('/verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::get('/resend', [OtpController::class, 'resend'])->name('otp.resend');
});

// Document Request Routes
Route::get('/request/select', [RequestController::class, 'select'])->name('request.select');
Route::post('/request/select', [RequestController::class, 'storeSelection'])->name('request.select.store');

// Document Request Routes (OTP Protected)
Route::middleware([VerifyOtp::class . ':submission'])->group(function () {
    Route::get('/request/create', [RequestController::class, 'create'])->name('request.create');
    Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
});

Route::get('/request/success/{tracking_id}', [RequestController::class, 'success'])->name('request.success');

// Tracking Routes (No OTP Required)
Route::get('/tracking/form', [TrackingController::class, 'form'])->name('tracking.form');
Route::post('/tracking/track', [TrackingController::class, 'track'])->name('tracking.track');

// Admin/Registrar Routes (Authentication Required)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/requests', [DashboardController::class, 'requests'])->name('admin.requests.index');
    Route::get('/requests/{id}', [DashboardController::class, 'show'])->name('admin.requests.show');
    
    Route::post('/requests/{id}/update-status', [RequestManagementController::class, 'updateStatus'])
        ->name('admin.requests.update-status');
    Route::post('/requests/bulk-update', [RequestManagementController::class, 'bulkUpdate'])
        ->name('admin.requests.bulk-update');
    Route::delete('/requests/{id}', [RequestManagementController::class, 'destroy'])
        ->name('admin.requests.destroy');

    // Admin Only Routes
    Route::get('/users', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.users.index');
    })->name('admin.users.index');

    Route::get('/document-types', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.document-types.index');
    })->name('admin.document-types.index');

    Route::get('/tracks', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.tracks.index');
    })->name('admin.tracks.index');

    Route::get('/audit-logs', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.audit-logs.index');
    })->name('admin.audit-logs.index');

    Route::get('/logs', function (\Illuminate\Http\Request $request) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $date = $request->query('date');
        $logsQuery = \App\Models\RequestLog::with(['user', 'request.documentType'])
            ->latest();

        if ($date) {
            $logsQuery->whereDate('created_at', $date);
        }

        $logs = $logsQuery->paginate(20)->withQueryString();

        return view('admin.logs.index', compact('logs', 'date'));
    })->name('admin.logs.index');

    Route::get('/settings', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('admin.settings');
    })->name('admin.settings');
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
