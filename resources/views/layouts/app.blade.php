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
        @livewireStyles
        @livewireTableStyles
        </head>
    <body class="font-sans antialiased">
        <div x-data="{
            sidebarOpen: false,
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
            toggleSidebar() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
            }
        }" class="min-h-screen bg-gray-100">

            <!-- Sidebar -->
            <aside
                :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-64'"
                class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-all duration-300 ease-in-out lg:translate-x-0"
                :class="{ '-translate-x-full': !sidebarOpen }"
                @click.away="sidebarOpen = false"
            >
                <!-- Logo Section -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <x-application-logo class="w-10 h-10 fill-current text-bnhs-blue" />
                        <div x-show="!sidebarCollapsed" x-transition class="lg:block">
                            <p class="text-sm font-bold text-gray-900">BNHS</p>
                            <p class="text-xs text-gray-600">eDocument</p>
                        </div>
                    </a>
                    <button
                        @click="toggleSidebar()"
                        class="hidden lg:block p-1.5 rounded-lg hover:bg-gray-100 transition"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Dashboard' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Dashboard</span>
                    </a>

                    <!-- Requests (Admin/Registrar) -->
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'registrar')
                    <a
                        href="{{ route('admin.requests.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.requests.*') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Requests' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Requests</span>
                    </a>
                    @endif

                    <!-- Admin Only Sections -->
                    @if(Auth::user()->role === 'admin')
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Users' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Users</span>
                    </a>

                    <a
                        href="{{ route('admin.document-types.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.document-types.*') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Document Types' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Document Types</span>
                    </a>

                    <a
                        href="{{ route('admin.tracks.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.tracks.*') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Educational Tracks' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Educational Tracks</span>
                    </a>

                    <a
                        href="{{ route('admin.logs.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.logs.*') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Activity Timeline' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Activity Timeline</span>
                    </a>

                    <a
                        href="{{ route('admin.settings') }}"
                        class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.settings') ? 'bg-bnhs-blue-50 text-bnhs-blue border-l-4 border-bnhs-blue' : 'text-gray-700 hover:bg-gray-100' }}"
                        :title="sidebarCollapsed ? 'Settings' : ''"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Settings</span>
                    </a>
                    @endif
                </nav>

                <!-- User Profile Section -->
                <div class="border-t border-gray-200 p-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold text-sm flex-shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div x-show="!sidebarCollapsed" x-transition class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            @if(Auth::user()->role === 'admin')
                                <span class="inline-block mt-1 px-2 py-0.5 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Admin</span>
                            @elseif(Auth::user()->role === 'registrar')
                                <span class="inline-block mt-1 px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Registrar</span>
                            @endif
                        </div>
                    </div>
                    <div x-show="!sidebarCollapsed" x-transition class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Mobile Backdrop -->
            <div
                x-show="sidebarOpen"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false"
                class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
                style="display: none;"
            ></div>

            <!-- Main Content -->
            <div
                :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-64'"
                class="transition-all duration-300"
            >
                <!-- Top Bar -->
                <header class="sticky top-0 z-30 h-16 bg-white shadow-sm">
                    <div class="flex items-center justify-between h-full px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-4">
                            <!-- Mobile Menu Button -->
                            <button
                                @click="sidebarOpen = true"
                                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition"
                            >
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <!-- Page Title -->
                            @isset($header)
                                <h1 class="text-xl font-semibold text-gray-900">
                                    {{ $header }}
                                </h1>
                            @endisset
                        </div>

                        <!-- Desktop User Menu -->
                        <div class="hidden lg:flex items-center gap-4">
                            @if(Auth::user()->role === 'admin')
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">Admin</span>
                            @elseif(Auth::user()->role === 'registrar')
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Registrar</span>
                            @endif
                            <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-4 sm:p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Footer -->
                <footer class="border-t border-gray-200 py-4">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <p class="text-center text-sm text-gray-500">
                            &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                        </p>
                    </div>
                </footer>
            </div>
        </div>
        @livewireScripts
        @livewireTableScripts
    </body>
</html>
