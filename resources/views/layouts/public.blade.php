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
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="fixed top-0 z-50 w-full border-b border-white/50 bg-[#0F2A44] shadow-lg">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 transition">
                            <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-12 w-auto" />
                            <div class="hidden sm:block">
                                <p class="text-xl font-semibold text-yellow-500">Bato National High School</p>
                                <p class="text-xs text-gray-300">Toledo City, Cebu</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @auth
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-blue-700"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="text-sm font-medium text-gray-300 hover:text-yellow-500 border border-gray-300 rounded-lg px-4 py-2 transition"
                            >
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-2 fixed bottom-0 z-50 w-full border-t border-white/90 bg-[#0F2A44]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-300">
                    © {{ date('Y') }} Bato National High School. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
