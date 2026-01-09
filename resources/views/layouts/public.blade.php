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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-bnhs-blue-50 via-white to-bnhs-gold-50">
        <!-- Fixed Navigation -->
        <nav class="fixed top-0 z-50 w-full bg-white/90 backdrop-blur-md shadow-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo & School Name -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:opacity-80">
                            @if(file_exists(public_path('images/logo.png')))
                                <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-10 w-auto" />
                            @else
                                <x-application-logo class="h-10 w-10 fill-current text-bnhs-blue" />
                            @endif
                            <div>
                                <p class="text-sm font-bold text-gray-900">eDocument Request</p>
                                <p class="text-xs text-bnhs-blue font-semibold">Bato National High School</p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="flex items-center gap-4">
                        @auth
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="rounded-lg bg-bnhs-blue px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-bnhs-blue-600"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="text-sm font-medium text-gray-600 hover:text-bnhs-blue transition"
                            >
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="pt-16">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="border-t border-gray-200 bg-white py-6 mt-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <!-- Logo & Info -->
                    <div class="flex items-center gap-3">
                        @if(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-12 w-auto" />
                        @else
                            <x-application-logo class="h-12 w-12 fill-current text-bnhs-blue" />
                        @endif
                        <div>
                            <p class="text-sm font-bold text-gray-900">Bato National High School</p>
                            <p class="text-xs text-gray-600">Toledo City, Cebu</p>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="text-center md:text-right">
                        <p class="text-sm text-gray-600">
                            &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Need help? <a href="#" class="text-bnhs-blue hover:underline" onclick="event.preventDefault(); document.getElementById('reportModal').classList.remove('hidden');">Report a Problem</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Report Problem Modal -->
        <div id="reportModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Report a Problem</h3>
                    <button onclick="document.getElementById('reportModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Problem Description</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue"></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="flex-1 bg-bnhs-blue text-white px-4 py-2 rounded-lg hover:bg-bnhs-blue-600 font-semibold transition">
                            Submit
                        </button>
                        <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="flex-1 bg-gray-200 text-gray-900 px-4 py-2 rounded-lg hover:bg-gray-300 font-semibold transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
