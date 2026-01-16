<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <!-- Header & Toolbar -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Activity Timeline</h1>
                <p class="text-sm text-gray-500 mt-1">Track system events, user actions, and request updates.</p>
            </div>

            <div class="w-full xl:w-auto">
                <form method="GET" class="flex flex-wrap items-center gap-2">
                    <!-- Search -->
                    <div class="relative flex-grow md:flex-grow-0">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search logs..." 
                               class="w-full md:w-48 pl-9 pr-4 py-2 text-sm border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue placeholder-gray-400 shadow-sm">
                    </div>

                    <!-- Role Filter -->
                    <select name="role" class="py-2 pl-3 pr-8 text-sm border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue shadow-sm">
                        <option value="">All Roles</option>
                        <option value="student" {{ ($role ?? '') === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="admin" {{ ($role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="registrar" {{ ($role ?? '') === 'registrar' ? 'selected' : '' }}>Registrar</option>
                    </select>

                    <!-- Date Range -->
                    <div class="flex items-center gap-2 bg-white rounded-lg border border-gray-300 shadow-sm p-0.5">
                        <input type="date" name="start_date" value="{{ $startDate ?? '' }}" 
                               class="border-0 py-1.5 px-2 text-sm focus:ring-0 rounded-md text-gray-600 bg-transparent w-32" placeholder="Start">
                        <span class="text-gray-400 text-xs">to</span>
                        <input type="date" name="end_date" value="{{ $endDate ?? '' }}" 
                               class="border-0 py-1.5 px-2 text-sm focus:ring-0 rounded-md text-gray-600 bg-transparent w-32" placeholder="End">
                    </div>

                    <!-- Sort -->
                    <select name="sort" class="py-2 pl-3 pr-8 text-sm border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue shadow-sm">
                        <option value="desc" {{ ($sort ?? 'desc') === 'desc' ? 'selected' : '' }}>Newest First</option>
                        <option value="asc" {{ ($sort ?? 'desc') === 'asc' ? 'selected' : '' }}>Oldest First</option>
                    </select>

                    <!-- Actions -->
                    <button type="submit" class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                        Filter
                    </button>
                    
                    @if($startDate || $endDate || $search || $role || ($sort ?? 'desc') !== 'desc')
                        <a href="{{ route('admin.logs.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 shadow-sm transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Compact Timeline -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 sm:p-8">
                @php
                    $currentDate = null;
                @endphp

                <div class="relative">
                    <!-- Vertical Line -->
                    <div class="absolute top-0 bottom-0 left-[2.25rem] w-px bg-gray-200 md:left-[8.5rem]"></div>

                    <div class="space-y-6">
                        @forelse($logs as $log)
                            @php
                                $logDate = $log->created_at->isToday() ? 'Today' : ($log->created_at->isYesterday() ? 'Yesterday' : $log->created_at->format('M d, Y'));
                                
                                // Determine Actor Details (Same logic as before but refined)
                                if (!$log->user) {
                                    $actorName = $log->request->full_name ?? 'Student';
                                    $actorRole = 'Student';
                                    $actorBadgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                    $iconBg = 'bg-white border-2 border-blue-500 text-blue-500';
                                    $iconPath = 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z';
                                } else {
                                    $actorName = $log->user->name;
                                    $actorRole = ucfirst($log->user->role);
                                    $isSuperAdmin = $log->user->role === 'admin';
                                    $actorBadgeClass = $isSuperAdmin ? 'bg-purple-50 text-purple-700 border-purple-200' : 'bg-orange-50 text-orange-700 border-orange-200';
                                    $iconBg = $isSuperAdmin ? 'bg-white border-2 border-purple-500 text-purple-500' : 'bg-white border-2 border-orange-500 text-orange-500';
                                    $iconPath = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
                                }

                                // Icons & Text Logic
                                $requestRef = $log->request ? "#" . $log->request->tracking_id : '';
                                $documentName = $log->request?->documentType->name ?? 'Document';
                                
                                if (str_contains($log->action, 'Request submitted')) {
                                    $primaryText = "Request for <span class='font-semibold text-gray-900'>$documentName</span> was submitted by <span class='font-semibold text-gray-900'>$actorName</span>";
                                    $iconPath = 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z';
                                } elseif (str_contains($log->action, 'Status changed')) {
                                     preg_match("/to '([^']*)'/", $log->action, $matches);
                                     $newStatus = $matches[1] ?? 'updated';
                                     $statusLabel = match($newStatus) {
                                         'approved' => 'approved',
                                         'verified' => 'marked as Verified',
                                         'processing' => 'marked as Processing',
                                         'ready' => 'marked as Ready for Pickup',
                                         'completed' => 'marked as Released',
                                         'rejected' => 'marked as Rejected',
                                         'cancelled' => 'cancelled',
                                         default => "updated to $newStatus"
                                     };
                                     $primaryText = "Request <a href='".($log->request ? route('admin.requests.show', $log->request->id) : '#')."' class='font-mono font-medium text-bnhs-blue hover:underline'>$requestRef</a> was $statusLabel by <span class='font-semibold text-gray-900'>$actorName</span>";
                                     if(in_array($newStatus, ['completed', 'ready'])) {
                                         $iconPath = 'M5 13l4 4L19 7';
                                         $iconBg = 'bg-green-500 border-green-500 text-white';
                                     } elseif (in_array($newStatus, ['rejected', 'cancelled'])) {
                                         $iconPath = 'M6 18L18 6M6 6l12 12';
                                         $iconBg = 'bg-red-500 border-red-500 text-white';
                                     } else {
                                         $iconPath = 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15';
                                     }
                                } elseif (str_contains($log->action, 'Admin remarks updated')) {
                                    $primaryText = "Admin remarks for <span class='font-mono text-gray-700'>$requestRef</span> were updated by <span class='font-semibold text-gray-900'>$actorName</span>";
                                    $iconPath = 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z';
                                    $iconBg = 'bg-yellow-100 border-2 border-yellow-500 text-yellow-600';
                                } elseif (str_contains($log->action, 'Deleted request')) {
                                    $primaryText = "Request was deleted by <span class='font-semibold text-gray-900'>$actorName</span>";
                                    $iconPath = 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16';
                                    $iconBg = 'bg-red-100 border-2 border-red-500 text-red-600';
                                } else {
                                    $primaryText = $log->action;
                                    $iconPath = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                                }
                            @endphp

                            <!-- Date Header -->
                            @if($currentDate !== $logDate)
                                <div class="relative z-10 flex items-center mb-6">
                                    <div class="w-[2.25rem] md:w-[8.5rem] flex-shrink-0 text-right pr-4 md:pr-8">
                                        <!-- Only show date on MD screens upwards in the margin, otherwise inline -->
                                        <span class="hidden md:block text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $logDate }}</span>
                                    </div>
                                    <div class="flex-grow pl-4 md:pl-0 flex items-center">
                                        <div class="h-2 w-2 rounded-full bg-gray-300 md:-ml-1"></div>
                                        <span class="md:hidden text-xs font-bold text-gray-500 uppercase tracking-wider ml-3">{{ $logDate }}</span>
                                    </div>
                                </div>
                                @php $currentDate = $logDate; @endphp
                            @endif

                            <!-- Log Item -->
                            <div class="group relative flex items-start">
                                <!-- Time (Left Column) -->
                                <div class="hidden md:block w-[8.5rem] flex-shrink-0 text-right pr-8 pt-2">
                                    <span class="text-sm font-medium text-gray-500">{{ $log->created_at->format('h:i A') }}</span>
                                </div>

                                <!-- Timeline Icon -->
                                <div class="absolute left-0 md:static flex-shrink-0 flex justify-center items-center w-[4.5rem] md:w-auto">
                                    <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shadow-sm {{ $iconBg }} md:-ml-4">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Content Card -->
                                <div class="flex-grow ml-12 md:ml-4 pb-1">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between p-3 sm:p-4 rounded-lg bg-gray-50 hover:bg-gray-100 border border-transparent hover:border-gray-200 transition-all duration-200">
                                        <div class="flex-grow">
                                            <!-- Action Sentence -->
                                            <p class="text-sm text-gray-800 leading-relaxed">
                                                {!! $primaryText !!}
                                            </p>
                                            
                                            <!-- Mobile Time & Details -->
                                            <div class="mt-2 flex items-center gap-2 flex-wrap">
                                                <span class="md:hidden text-xs text-gray-500 font-medium">
                                                    {{ $log->created_at->format('h:i A') }}
                                                </span>
                                                <span class="md:hidden text-gray-300">•</span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide border {{ $actorBadgeClass }}">
                                                    {{ $actorRole }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- View Link -->
                                        @if($log->request)
                                            <div class="mt-2 sm:mt-0 sm:ml-4 flex-shrink-0">
                                                <a href="{{ route('admin.requests.show', $log->request->id) }}" class="text-xs font-semibold text-gray-500 hover:text-bnhs-blue flex items-center gap-1 transition-colors">
                                                    View
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900">No activity found</h3>
                                <p class="text-xs text-gray-500 mt-1 max-w-xs mx-auto">Try adjusting your search or filters to find what you're looking for.</p>
                                <a href="{{ route('admin.logs.index') }}" class="mt-4 text-sm text-bnhs-blue font-semibold hover:underline">Clear all filters</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Footer Pagination -->
            @if($logs->hasPages())
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>