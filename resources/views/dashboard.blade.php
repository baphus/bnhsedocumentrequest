<x-app-layout>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Greeting Card -->
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-br from-bnhs-blue to-bnhs-blue-600 rounded-xl shadow-lg p-8 text-white">
                <h2 class="text-3xl font-bold mb-2">
                    @php
                    $hour = date('H');
                    if ($hour < 12) {
                        echo 'Good Morning' ;
                        } elseif ($hour < 18) {
                        echo 'Good Afternoon' ;
                        } else {
                        echo 'Good Evening' ;
                        }
                        @endphp
                        , {{ Auth::user()->name }}!
                        </h2>
                        <p class="text-bnhs-blue-100 mb-4">{{ now()->format('l, F j, Y') }}</p>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 rounded-full text-sm font-medium backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            School Year {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }}
                        </div>
            </div>
        </div>

        <!-- Mini Calendar -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900">{{ now()->format('F Y') }}</h3>
                <div class="flex gap-2">
                    <button class="p-1 hover:bg-gray-100 rounded transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="p-1 hover:bg-gray-100 rounded transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-xs">
                <div class="text-gray-500 font-semibold py-2">S</div>
                <div class="text-gray-500 font-semibold py-2">M</div>
                <div class="text-gray-500 font-semibold py-2">T</div>
                <div class="text-gray-500 font-semibold py-2">W</div>
                <div class="text-gray-500 font-semibold py-2">T</div>
                <div class="text-gray-500 font-semibold py-2">F</div>
                <div class="text-gray-500 font-semibold py-2">S</div>
                @php
                $today = now()->day;
                $daysInMonth = now()->daysInMonth;
                $firstDayOfWeek = now()->startOfMonth()->dayOfWeek;
                @endphp
                @for($i = 0; $i < $firstDayOfWeek; $i++)
                    <div class="py-2">
            </div>
            @endfor
            @for($day = 1; $day <= $daysInMonth; $day++)
                <div class="py-2 {{ $day == $today ? 'bg-bnhs-blue text-white rounded-full font-semibold' : 'text-gray-700' }}">
                {{ $day }}
        </div>
        @endfor
    </div>
    </div>

    <!-- Welcome Message -->
    <div class="lg:col-span-3">
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <div class="w-16 h-16 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">You're Logged In!</h3>
            <p class="text-gray-600 mb-6">Welcome to the BNHS eDocument Request System dashboard</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Go to Home Page
            </a>
        </div>
    </div>
    </div>
</x-app-layout>