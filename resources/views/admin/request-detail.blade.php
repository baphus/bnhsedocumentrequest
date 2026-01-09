<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Request Details - {{ $request->tracking_id }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Request Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Request Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Tracking ID</dt>
                                <dd class="text-base font-semibold text-gray-900 dark:text-white">{{ $request->tracking_id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Status</dt>
                                <dd>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($request->status === 'pending') bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                        @elseif($request->status === 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                                        @elseif($request->status === 'ready') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                        @elseif($request->status === 'completed') bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200
                                        @endif">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Document Type</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->documentType->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Quantity</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->quantity }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Purpose</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->purpose }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Submitted</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->created_at->format('M d, Y h:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Estimated Completion</dt>
                                <dd class="text-base text-gray-900 dark:text-white">
                                    {{ $request->estimated_completion_date ? $request->estimated_completion_date->format('M d, Y') : 'Not set' }}
                                </dd>
                            </div>
                            @if($request->processor)
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Processed By</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->processor->name }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Requestor Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Requestor Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Full Name</dt>
                                <dd class="text-base font-semibold text-gray-900 dark:text-white">{{ $request->full_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Email</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Contact Number</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->contact_number }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">LRN</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->lrn }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Grade Level</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->grade_level }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Section</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->section ?: 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">Track/Strand</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->track_strand }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-600 dark:text-gray-400">School Year Last Attended</dt>
                                <dd class="text-base text-gray-900 dark:text-white">{{ $request->school_year_last_attended }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Update Request</h3>
                        <form method="POST" action="{{ route('admin.requests.update-status', $request->id) }}">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Status
                                    </label>
                                    <select name="status" required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                        <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $request->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="ready" {{ $request->status === 'ready' ? 'selected' : '' }}>Ready</option>
                                        <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estimated Completion Date
                                    </label>
                                    <input type="date" name="estimated_completion_date" 
                                        value="{{ $request->estimated_completion_date ? $request->estimated_completion_date->format('Y-m-d') : '' }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Admin Remarks (Visible to User)
                                </label>
                                <textarea name="admin_remarks" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">{{ $request->admin_remarks }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Internal Notes (Staff Only)
                                </label>
                                <textarea name="internal_notes" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">{{ $request->internal_notes }}</textarea>
                            </div>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Update Request
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Digital Signature -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Digital Signature</h3>
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 bg-white">
                            <img src="{{ $request->signature }}" alt="Signature" class="max-w-full h-auto">
                        </div>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Activity Log</h3>
                        <div class="space-y-4">
                            @forelse($request->logs as $log)
                                <div class="flex gap-3">
                                    <div class="flex flex-col items-center">
                                        <div class="w-3 h-3 rounded-full bg-blue-600 dark:bg-blue-400"></div>
                                        @if(!$loop->last)
                                            <div class="w-0.5 flex-1 bg-gray-300 dark:bg-gray-600 mt-1"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 pb-4">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $log->action }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $log->created_at->format('M d, Y h:i A') }}
                                            @if($log->user)
                                                <span class="text-gray-500 dark:text-gray-500">by {{ $log->user->name }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-400 text-sm">No activity yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
