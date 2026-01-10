<div>
    <!-- Greeting + Mini Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
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
</div>

@if(Auth::user()->role === 'admin')
<!-- KPI Cards (Admins only) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Requests -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-bnhs-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Requests</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-bnhs-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Pending Documents -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-bnhs-gold">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Pending Documents</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['pending'] }}</p>
            </div>
            <div class="w-12 h-12 bg-bnhs-gold-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Fulfillment Rate -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Fulfillment Rate</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->fulfillmentRate }}%</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Processing Documents -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Processing</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['processing'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </div>
    </div>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
    <!-- Recent Requests -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Recent Requests</h3>
            <a href="{{ route('admin.requests.index') }}" wire:navigate class="text-sm text-bnhs-blue hover:underline">View All</a>
        </div>
        <div class="p-6">
            <div class="space-y-4 max-h-[32rem] overflow-y-auto pr-2">
                @forelse($this->recentRequests as $request)
                <div class="flex items-center justify-between pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $request->full_name }}</p>
                        <p class="text-xs text-gray-500">{{ $request->documentType->name }} • {{ $request->created_at->diffForHumans() }}</p>
                    </div>
                    <x-status-badge :status="$request->status" />
                </div>
                @empty
                <x-empty-state title="No recent requests" />
                @endforelse
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Activity Feed</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4 max-h-[32rem] overflow-y-auto pr-2">
                @forelse($this->recentActivities as $activity)
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-bnhs-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $activity->action }}</p>
                        <p class="text-xs text-gray-500">{{ $activity->user->name ?? 'System' }} • {{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <x-empty-state title="No recent activities" />
                @endforelse
            </div>
        </div>
    </div>
</div>