<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-bnhs-blue-50 to-white">
            <!-- Logo and School Name -->
            <div class="text-center mb-6">
                <a href="/" class="inline-block">
                    <x-application-logo class="w-20 h-20 mx-auto fill-current text-bnhs-blue" />
                </a>
                <h1 class="mt-4 text-2xl font-bold text-gray-900">Bato National High School</h1>
                <p class="text-sm text-bnhs-blue font-semibold">eDocument Request</p>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-lg border-t-4 border-bnhs-blue">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                </p>
                <a href="{{ route('login') }}" class="text-xs text-gray-400 hover:text-bnhs-blue transition mt-2 inline-block">
                    Admin
                </a>
            </div>
        </div>
    </body>
</html>
