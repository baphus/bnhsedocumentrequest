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
        Route::get('/dashboard', \App\Livewire\Pages\Dashboard::class)->name('dashboard');

        // Request Management
        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', \App\Livewire\Pages\Requests\Index::class)->name('index');
            Route::get('/{id}', \App\Livewire\Pages\Requests\Show::class)->name('show');
            Route::post('/bulk-update', [RequestManagementController::class, 'bulkUpdate'])->name('bulk-update');
            Route::delete('/{id}', [RequestManagementController::class, 'destroy'])->name('destroy');
        });
    });

    // Admin Only: Registrar is blocked here
    Route::middleware(['role:admin'])->group(function () {
        // User Management
        Route::get('/users', \App\Livewire\Pages\Users\Index::class)->name('users.index');

        // Document Types Management
        Route::get('/document-types', \App\Livewire\Pages\DocumentTypes\Index::class)->name('document-types.index');

        // Settings
        Route::get('/settings', \App\Livewire\Pages\Settings\Index::class)->name('settings');

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
