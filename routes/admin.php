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
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');
            $search = $request->query('search');
            $role = $request->query('role');
            $sort = $request->query('sort', 'desc'); // default to newest

            $logsQuery = \App\Models\RequestLog::with(['user', 'request.documentType']);

            // Sort
            $logsQuery->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

            // Date Filters
            if ($startDate) {
                $logsQuery->whereDate('created_at', '>=', $startDate);
            }
            if ($endDate) {
                $logsQuery->whereDate('created_at', '<=', $endDate);
            }

            if ($search) {
                $logsQuery->where(function($q) use ($search) {
                    $q->where('action', 'like', "%{$search}%")
                      ->orWhereHas('user', function($u) use ($search) {
                          $u->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('request', function($r) use ($search) {
                          $r->where('tracking_id', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                      });
                });
            }

            if ($role) {
                if ($role === 'student') {
                    $logsQuery->whereNull('user_id');
                } else {
                    $logsQuery->whereHas('user', function($q) use ($role) {
                        $q->where('role', $role);
                    });
                }
            }

            $logs = $logsQuery->paginate(20)->withQueryString();
            return view('admin.logs.index', compact('logs', 'startDate', 'endDate', 'search', 'role', 'sort'));
        })->name('logs.index');
    });
});
