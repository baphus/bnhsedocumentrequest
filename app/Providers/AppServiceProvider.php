<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;

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
        // Force HTTPS in production (for Heroku and other platforms)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Register Livewire components from subdirectories
        Livewire::component('document-table', \App\Livewire\Tables\DocumentTable::class);
    }
}
