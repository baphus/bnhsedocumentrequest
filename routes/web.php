<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// --- Public Pages ---
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    if (Schema::hasTable('settings')) {
        $maintenanceMode = Setting::where('key', 'maintenance_mode')->first();
        if ($maintenanceMode && $maintenanceMode->value === 'true') {
            return response()->view('errors.503', [], 503);
        }
    }
    return view('home');
})->name('home');
Route::get('/how-to-request', fn () => view('how-to-request'))->name('how-to-request');

// --- Dashboard Redirect ---
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- User Profile Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Load Additional Route Files ---
require __DIR__.'/auth.php';
require __DIR__.'/public.php';
require __DIR__.'/admin.php';
