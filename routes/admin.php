<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RequestManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All routes related to admin and registrar functionality.
| These routes require authentication and appropriate role permissions.
|
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Shared: Both Admin and Registrar can access these
    Route::middleware(['role:admin,registrar'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Request Management
        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [DashboardController::class, 'requests'])->name('index');
            Route::get('/{id}', [DashboardController::class, 'show'])->name('show');
            Route::post('/{id}/update-status', [RequestManagementController::class, 'updateStatus'])->name('update-status');
            Route::post('/bulk-update', [RequestManagementController::class, 'bulkUpdate'])->name('bulk-update');
            Route::delete('/{id}', [RequestManagementController::class, 'destroy'])->name('destroy');
        });
    });

    // Admin Only: Registrar is blocked here
    Route::middleware(['role:admin'])->group(function () {
        // User Management
        Route::get('/users', fn () => view('admin.users.index'))->name('users.index');
        
        // Document Types Management
        Route::get('/document-types', fn () => view('admin.document-types.index'))->name('document-types.index');
        
        // Tracks Management
        Route::get('/tracks', fn () => view('admin.tracks.index'))->name('tracks.index');
        
        // Settings
        Route::get('/settings', fn () => view('admin.settings'))->name('settings');
        
        // Activity Logs
        Route::get('/logs', function (\Illuminate\Http\Request $request) {
            $date = $request->query('date');
            $logsQuery = \App\Models\RequestLog::with(['user', 'request.documentType'])->latest();
            if ($date) $logsQuery->whereDate('created_at', $date);
            $logs = $logsQuery->paginate(20)->withQueryString();
            return view('admin.logs.index', compact('logs', 'date'));
        })->name('logs.index');
    });
});
