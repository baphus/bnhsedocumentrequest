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
    @stack('styles')
    <script>
        document.addEventListener('livewire:init', () => {
            console.log('Livewire 3 is officially booted and ready!');
        });
    </script>
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

        <!-- Sidebar Component -->
        <x-sidebar />

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
            style="display: none;"></div>

        <!-- Main Content -->
        <div
            :class="sidebarCollapsed ? 'lg:ml-20' : 'lg:ml-64'"
            class="transition-all duration-300 min-h-screen flex flex-col">

            <!-- Top Bar -->
            <header class="sticky top-0 z-30 h-16 bg-white/80 backdrop-blur-md border-b border-gray-100">
                <div class="flex items-center justify-between h-full px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-4">
                        <!-- Mobile Menu Button -->
                        <button
                            @click="sidebarOpen = true"
                            class="lg:hidden p-2 rounded-xl hover:bg-gray-100 transition shadow-sm border border-gray-100">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Mobile Logo -->
                        <div class="lg:hidden flex items-center gap-2">
                            <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="w-8 h-8 object-contain" />
                        </div>

                        <!-- Page Title -->
                        @isset($header)
                        <h1 class="text-lg font-bold text-gray-900 tracking-tight ml-2 lg:ml-0">
                            {{ $header }}
                        </h1>
                        @endisset
                    </div>

                    <!-- Right side of header (Empty for now as requested) -->
                    <div class="flex items-center gap-3">
                        <!-- We can add notifications here later if needed -->
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @if(isset($slot))
                    {{ $slot }}
                    @else
                    @yield('content')
                    @endif
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

    <!-- Toast Notification Handler -->
    <div
        x-data="{
                notifications: [],
                add(type, message) {
                    const id = Date.now();
                    this.notifications.push({ id, type, message });
                    setTimeout(() => {
                        this.notifications = this.notifications.filter(n => n.id !== id);
                    }, 5000);
                }
            }"
        @notify.window="add($event.detail.type, $event.detail.message)"
        class="fixed bottom-5 right-5 z-[100] space-y-3">
        <template x-for="n in notifications" :key="n.id">
            <div
                x-show="true"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                :class="{
                        'bg-green-600': n.type === 'success',
                        'bg-red-600': n.type === 'error',
                        'bg-blue-600': n.type === 'info',
                        'bg-yellow-600': n.type === 'warning'
                    }"
                class="flex items-center gap-3 px-4 py-3 text-white rounded-lg shadow-2xl min-w-[300px]">
                <svg x-show="n.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg x-show="n.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p x-text="n.message" class="text-sm font-medium"></p>
                <button @click="notifications = notifications.filter(notif => notif.id !== n.id)" class="ml-auto">
                    <svg class="w-4 h-4 opacity-50 hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>
    </div>
</body>

</html>