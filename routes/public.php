<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Student-facing)
|--------------------------------------------------------------------------
|
| Routes for students and public users to request documents
| and track requests.
|
*/

// --- Document Request Routes ---
Route::prefix('request')->name('request.')->group(function () {
    // Selection page
    Route::get('/select', \App\Livewire\Pages\Public\Request\SelectDocument::class)->name('select');
    
    // Create and submit request
    Route::get('/create', \App\Livewire\Pages\Public\Request\CreateRequest::class)->name('create');
    
    // Success page (no authentication required)
    Route::get('/success/{tracking_id}', [RequestController::class, 'success'])->name('success');
});

// --- Tracking Routes ---
Route::prefix('tracking')->name('tracking.')->group(function () {
    Route::get('/form', \App\Livewire\Pages\Public\Tracking\TrackRequest::class)->name('form');
});
