<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use App\Models\Request;
use App\Observers\RequestObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

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

        if (Schema::hasTable('settings')) {
            try {
                $settings = Setting::all()->keyBy('key')->map(function ($setting) {
                    return [
                        'value' => $setting->value,
                        'type' => $setting->type,
                    ];
                })->toArray();
                config(['settings' => $settings]);
            } catch (\Exception $e) {
                // Log the error and continue, so migration commands don't fail
                Log::error('Could not load settings from database: ' . $e->getMessage());
            }
        }
    }
}
