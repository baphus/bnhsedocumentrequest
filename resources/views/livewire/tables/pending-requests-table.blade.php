<div>
    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-900">Pending Requests Queue</h2>
            <p class="text-sm text-gray-500 mt-1">Directly manage incoming document requests.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Details</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Requested</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                        <tr class="@if($request->estimated_completion_date && $request->estimated_completion_date->isPast()) bg-red-50 @endif">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $request->tracking_id }}
                                @if($request->estimated_completion_date && $request->estimated_completion_date->isPast())
                                    <span class="ml-2 text-red-600 tooltip" title="This request is overdue.">🔔</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="font-medium text-gray-900">{{ $request->first_name }} {{ $request->last_name }}</div>
                                <div class="text-xs text-gray-500">LRN: {{ $request->lrn }}</div>
                                <div class="text-xs text-gray-400">{{ $request->grade_level }} - {{ $request->section }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->documentType->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <x-request-status :status="$request->status" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.requests.show', $request->id) }}" class="text-bnhs-blue hover:text-bnhs-blue-dark">View</a>
                                <button wire:click="approve({{ $request->id }})" class="ml-4 text-green-600 hover:text-green-900">Approve</button>
                                <button wire:click="reject({{ $request->id }})" class="ml-4 text-red-600 hover:text-red-900">Reject</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                No pending requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
        <div class="p-6 border-t">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
</div>
