<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Schema::hasTable('settings')) {
            return $next($request);
        }

        $maintenanceMode = Setting::where('key', 'maintenance_mode')->first();

        // If maintenance mode is enabled in the database
        if ($maintenanceMode && $maintenanceMode->value === 'true') {
            // Allow access to login page for all users
            if ($request->routeIs('login')) {
                return $next($request);
            }

            // Allow authenticated admin users to bypass maintenance mode
            if ($request->user() && $request->user()->isAdmin()) {
                return $next($request);
            }

            // For all other requests, show the maintenance page
            return response()->view('errors.503', [], 503);
        }

        // If maintenance mode is disabled, proceed with the request normally
        return $next($request);
    }
}
