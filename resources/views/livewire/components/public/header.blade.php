<div>
    <header class="fixed top-0 z-50 w-full bg-white shadow-md">
        <nav class="w-full px-6 sm:px-8 lg:px-12">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo & School Name -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 transition">
                        @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-10 w-auto" />
                        @else
                        <div class="w-10 h-10 bg-bnhs-blue rounded-lg flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        @endif
                        <div>
                            <p class="text-sm font-bold text-gray-900 leading-tight">eDocument Request</p>
                            <p class="text-[10px] sm:text-xs text-bnhs-blue font-semibold uppercase tracking-wider">Bato National High School</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center gap-4">
                    @if(request()->routeIs('home'))
                    @auth
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="rounded-lg bg-bnhs-blue px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-bnhs-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bnhs-blue">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 transition px-4 py-1.5 rounded-lg border border-gray-300 hover:border-bnhs-blue hover:text-bnhs-blue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bnhs-blue">
                        Login
                    </a>
                    @endauth
                    @else
                    <a
                        href="{{ route('home') }}"
                        wire:navigate
                        class="text-sm font-medium text-gray-600 transition px-4 py-1.5 hover:text-bnhs-blue flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span class="hidden sm:inline">Back to Home</span>
                        <span class="sm:hidden">Home</span>
                    </a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
</div>