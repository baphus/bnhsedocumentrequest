<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request Management Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <a href="{{ route('admin.dashboard', ['status' => 'all']) }}" 
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Requests</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</div>
                </a>
                <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" 
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition border-l-4 border-gray-500">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['pending'] }}</div>
                </a>
                <a href="{{ route('admin.dashboard', ['status' => 'processing']) }}" 
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition border-l-4 border-blue-500">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Processing</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['processing'] }}</div>
                </a>
                <a href="{{ route('admin.dashboard', ['status' => 'ready']) }}" 
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition border-l-4 border-green-500">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Ready</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['ready'] }}</div>
                </a>
                <a href="{{ route('admin.dashboard', ['status' => 'completed']) }}" 
                   class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition border-l-4 border-indigo-500">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Completed</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['completed'] }}</div>
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filters and Search -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex gap-4">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search by tracking ID, email, name..."
                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Search
                        </button>
                        @if($search || $status !== 'all')
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Bulk Actions Form -->
            <form method="POST" action="{{ route('admin.requests.bulk-update') }}" id="bulkForm">
                @csrf
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-4 flex gap-4 items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Bulk Actions:</span>
                        <select name="status" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="ready">Ready</option>
                            <option value="completed">Completed</option>
                        </select>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Apply to Selected
                        </button>
                    </div>
                </div>

                <!-- Requests Table -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left">
                                        <input type="checkbox" id="selectAll" class="rounded">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Tracking ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Requestor
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Document
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($requests as $request)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" name="request_ids[]" value="{{ $request->id }}" class="rounded request-checkbox">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $request->tracking_id }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $request->full_name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $request->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $request->documentType->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $request->quantity }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($request->status === 'pending') bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                                @elseif($request->status === 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                                                @elseif($request->status === 'ready') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                                @elseif($request->status === 'completed') bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200
                                                @endif">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $request->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.requests.show', $request->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            No requests found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($requests->hasPages())
                        <div class="px-6 py-4">
                            {{ $requests->links() }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        // Select all checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.request-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        // Bulk form validation
        document.getElementById('bulkForm').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.request-checkbox:checked');
            const status = this.querySelector('select[name="status"]').value;
            
            if (checked.length === 0) {
                e.preventDefault();
                alert('Please select at least one request.');
                return;
            }
            
            if (!status) {
                e.preventDefault();
                alert('Please select a status.');
                return;
            }
            
            if (!confirm(`Update ${checked.length} request(s) to "${status}" status?`)) {
                e.preventDefault();
            }
        });
    </script>
</x-app-layout>
