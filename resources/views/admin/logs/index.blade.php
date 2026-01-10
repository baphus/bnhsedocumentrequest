<x-app-layout>

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl shadow-lg mb-6">
        <div class="p-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="min-w-[200px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" value="{{ $date ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <button type="submit" class="px-6 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                    Apply
                </button>
                @if($date)
                <a href="{{ route('admin.logs.index') }}" class="px-6 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Clear
                </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="space-y-6">
                @forelse($logs as $log)
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full {{ $loop->first ? 'bg-bnhs-blue' : 'bg-gray-300' }}"></div>
                        @unless($loop->last)
                        <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                        @endunless
                    </div>
                    <div class="flex-1 pb-6">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-semibold text-gray-900">{{ $log->action }}</p>
                            <p class="text-xs text-gray-500">{{ $log->created_at->format('M d, Y • h:i A') }}</p>
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            @if($log->user)
                            <p><span class="font-semibold text-gray-800">{{ $log->user->name }}</span> performed this action</p>
                            @else
                            <p>System action</p>
                            @endif
                            @if($log->request)
                            <p class="text-xs text-gray-500">Request: {{ $log->request->tracking_id }} • {{ $log->request->documentType->name ?? 'Document' }}</p>
                            <a href="{{ route('admin.requests.show', $log->request->id) }}" class="inline-flex items-center gap-1 text-xs text-bnhs-blue hover:underline font-semibold">
                                View Request →
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-8">No activity found for the selected filter.</p>
                @endforelse
            </div>
        </div>
        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</x-app-layout>