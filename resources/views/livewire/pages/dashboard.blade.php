<div>
    <!-- Greeting + Mini Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Greeting Card -->
        <div class="lg:col-span-2">
            <div class="relative overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm p-8 h-full flex flex-col justify-center">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            @php
                            $hour = date('H');
                            $greeting = ($hour < 12) ? 'Good Morning' : (($hour < 18) ? 'Good Afternoon' : 'Good Evening');
                            @endphp
                            {{ $greeting }}, <span class="text-bnhs-blue">{{ Auth::user()->name }}</span>
                        </h2>
                        <p class="text-gray-500 text-lg mb-6">Welcome back to the Bato National High School E-Document Request System.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Today's Date</p>
                                    <p class="text-sm font-bold text-gray-900">{{ now()->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Active Session</p>
                                    <p class="text-sm font-bold text-gray-900">S.Y. {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden xl:block">
                        <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="w-32 h-32 opacity-10">
                    </div>
                </div>
            </div>
        </div>

        <!-- Mini Calendar -->
        <div class="bg-white rounded-xl shadow-lg p-6 h-full flex flex-col">
            @php
                $date = \Carbon\Carbon::parse($currentMonth);
                $daysInMonth = $date->daysInMonth;
                $firstDayOfWeek = $date->copy()->startOfMonth()->dayOfWeek;
                $isCurrentMonth = $date->isCurrentMonth();
                $today = now()->day;
            @endphp
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-900 text-lg">{{ $date->format('F Y') }}</h3>
                <div class="flex gap-2">
                    <button wire:click="prevMonth" class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600 hover:text-bnhs-blue">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button wire:click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600 hover:text-bnhs-blue">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-xs flex-1">
                <div class="text-gray-400 font-bold py-2">S</div>
                <div class="text-gray-400 font-bold py-2">M</div>
                <div class="text-gray-400 font-bold py-2">T</div>
                <div class="text-gray-400 font-bold py-2">W</div>
                <div class="text-gray-400 font-bold py-2">T</div>
                <div class="text-gray-400 font-bold py-2">F</div>
                <div class="text-gray-400 font-bold py-2">S</div>
                
                @for($i = 0; $i < $firstDayOfWeek; $i++)
                    <div class="py-2"></div>
                @endfor
                
                @for($day = 1; $day <= $daysInMonth; $day++)
                    <div class="py-2 flex items-center justify-center">
                        <span class="w-8 h-8 flex items-center justify-center rounded-full text-sm {{ ($isCurrentMonth && $day == $today) ? 'bg-bnhs-blue text-white font-bold shadow-md' : 'text-gray-700 hover:bg-gray-50' }}">
                            {{ $day }}
                        </span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
    <!-- KPI Cards (Admins only) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Requests -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">Total Requests</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['total'] }}</p>
            </div>
        </div>

        <!-- Requests This Month -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">This Month</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['thisMonth'] }}</p>
            </div>
        </div>

        <!-- Requests This Week -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">This Week</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['thisWeek'] }}</p>
            </div>
        </div>

        <!-- Requests Today -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-rose-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">Today</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['today'] }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->role === 'registrar')
    <!-- Registrar specific view -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
         <!-- New Requests Today -->
         <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">New Today</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['today'] }}</p>
            </div>
        </div>

        <!-- Pending Documents -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transform hover:shadow-md transition duration-200">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-bnhs-gold-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">Pending Total</p>
                <p class="text-3xl font-bold text-gray-900">{{ $this->stats['pending'] }}</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col justify-center items-center text-center transform hover:shadow-md transition duration-200">
            <h3 class="font-bold text-gray-900 text-lg mb-2">Manage Requests</h3>
            <p class="text-gray-500 text-sm mb-4">Review and process document requests.</p>
            <a href="{{ route('admin.requests.index') }}" wire:navigate class="px-6 py-2 bg-bnhs-blue hover:bg-bnhs-blue-700 text-white rounded-lg font-semibold transition w-full">
                View All Requests
            </a>
        </div>
    </div>
    @endif
 
    @if(Auth::user()->role === 'admin')
    <!-- Pending Requests Queue (Admins: Above grid) -->
    <div class="mb-8">
        @livewire('tables.pending-requests-table')
    </div>
    @endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start mb-8">
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
                    @php
                        $iconPath = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'; // Info default
                        $iconColor = 'text-blue-600';
                        $bgColor = 'bg-blue-100';

                        if (str_contains($activity->action, 'submitted')) {
                            $iconPath = 'M12 4v16m8-8H4';
                            $iconColor = 'text-green-600';
                            $bgColor = 'bg-green-100';
                        } elseif (str_contains($activity->action, 'Status changed')) {
                            $iconPath = 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15';
                            $iconColor = 'text-amber-600';
                            $bgColor = 'bg-amber-100';
                        } elseif (str_contains($activity->action, 'remarks')) {
                            $iconPath = 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z';
                            $iconColor = 'text-indigo-600';
                            $bgColor = 'bg-indigo-100';
                        } elseif (str_contains($activity->action, 'notes')) {
                            $iconPath = 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z';
                            $iconColor = 'text-slate-600';
                            $bgColor = 'bg-slate-100';
                        } elseif (str_contains($activity->action, 'completion date')) {
                            $iconPath = 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z';
                            $iconColor = 'text-purple-600';
                            $bgColor = 'bg-purple-100';
                        } elseif (str_contains($activity->action, 'Deleted')) {
                            $iconPath = 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16';
                            $iconColor = 'text-red-600';
                            $bgColor = 'bg-red-100';
                        }
                    @endphp
                    <div class="w-8 h-8 {{ $bgColor }} rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" />
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

    @if(Auth::user()->role === 'registrar')
    <!-- Pending Requests Queue (Registrar: Below grid) -->
    <div class="mb-8">
        @livewire('tables.pending-requests-table')
    </div>
    @endif
</div>