<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use App\Models\Request;
use App\Observers\RequestObserver;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Log::info('AppServiceProvider booted.');
        // Observer is registered via the model attribute `#[ObservedBy]` on App\Models\Request
        // to avoid double-registration do not call Request::observe() here.

        // Force HTTPS in production (for Heroku and other platforms)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Register Livewire components from subdirectories
        Livewire::component('document-table', \App\Livewire\Tables\DocumentTable::class);
    }
}
