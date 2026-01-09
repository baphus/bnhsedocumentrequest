<x-app-layout>
    <x-slot name="header">
        Requests
    </x-slot>

    <!-- Filters and Requests Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Filter Bar -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <form method="GET" action="{{ route('admin.requests.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tracking ID, email, name..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                        <option value="all" {{ ($status ?? 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="pending" {{ ($status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ ($status ?? '') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="ready" {{ ($status ?? '') === 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="completed" {{ ($status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                        Search
                    </button>
                    @if(($search ?? '') || ($status ?? 'all') !== 'all')
                        <a href="{{ route('admin.requests.index') }}" class="px-6 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition font-semibold">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <form method="POST" action="{{ route('admin.requests.bulk-update') }}">
            @csrf
            <!-- Bulk Actions Bar -->
            <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap gap-4 items-end">
                <div class="min-w-[200px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Bulk Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="ready">Ready</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                        Apply to Selected
                    </button>
                </div>
                <div class="text-sm text-gray-500">
                    Select rows to apply status. (Registrars cannot delete requests.)
                </div>
            </div>

            <!-- Requests Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input id="select-all" type="checkbox" class="rounded border-gray-300 text-bnhs-blue focus:ring-bnhs-blue">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tracking ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Requester
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Document
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($requests as $request)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="request_ids[]" value="{{ $request->id }}" class="row-checkbox rounded border-gray-300 text-bnhs-blue focus:ring-bnhs-blue">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 font-mono">{{ $request->tracking_id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->full_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $request->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->documentType->name }}</div>
                                    <div class="text-sm text-gray-500">Qty: {{ $request->quantity }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($request->status === 'pending') bg-gray-100 text-gray-800
                                        @elseif($request->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($request->status === 'ready') bg-green-100 text-green-800
                                        @elseif($request->status === 'completed') bg-purple-100 text-purple-800
                                        @endif">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.requests.show', $request->id) }}" class="text-bnhs-blue hover:text-bnhs-blue-600 transition font-medium">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p>No requests found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($requests->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $requests->links() }}
                </div>
            @endif
        </form>
    </div>

    @push('scripts')
    <script>
        const selectAll = document.getElementById('select-all');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        if (selectAll) {
            selectAll.addEventListener('change', (e) => {
                rowCheckboxes.forEach(cb => cb.checked = e.target.checked);
            });
        }
    </script>
    @endpush
</x-app-layout>
