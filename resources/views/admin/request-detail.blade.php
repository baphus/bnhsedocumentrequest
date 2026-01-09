<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-bnhs-blue transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Requests
                </a>
                <h2 class="text-xl font-bold text-gray-900">
                    Request Details
                </h2>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                @if($request->status === 'pending') bg-gray-100 text-gray-800
                @elseif($request->status === 'processing') bg-blue-100 text-blue-800
                @elseif($request->status === 'ready') bg-green-100 text-green-800
                @elseif($request->status === 'completed') bg-purple-100 text-purple-800
                @endif">
                {{ ucfirst($request->status) }}
            </span>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Request Details Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Request Details</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Tracking ID</p>
                            <p class="text-lg font-bold text-gray-900 font-mono">{{ $request->tracking_id }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Submitted On</p>
                            <p class="text-lg font-medium text-gray-900">{{ $request->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Document Type</p>
                            <p class="text-lg font-medium text-gray-900">{{ $request->documentType->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Quantity</p>
                            <p class="text-lg font-medium text-gray-900">{{ $request->quantity }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs text-gray-500 mb-1">Purpose</p>
                            <p class="text-base text-gray-900">{{ $request->purpose }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Estimated Completion</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ $request->estimated_completion_date ? $request->estimated_completion_date->format('F d, Y') : 'Not set' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Personal Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Full Name</p>
                            <p class="text-base font-medium text-gray-900">{{ $request->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Email Address</p>
                            <p class="text-base text-gray-900">{{ $request->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Contact Number</p>
                            <p class="text-base text-gray-900">{{ $request->contact_number }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Information Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Student Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">LRN</p>
                            <p class="text-base font-medium text-gray-900 font-mono">{{ $request->lrn }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Grade Level</p>
                            <p class="text-base text-gray-900">{{ $request->grade_level }}</p>
                        </div>
                        @if($request->section)
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Section</p>
                            <p class="text-base text-gray-900">{{ $request->section }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Track/Strand</p>
                            <p class="text-base text-gray-900">{{ $request->track_strand }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">School Year Last Attended</p>
                            <p class="text-base text-gray-900">{{ $request->school_year_last_attended }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status History Timeline -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Status History</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($request->logs as $log)
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-3 h-3 rounded-full {{ $loop->first ? 'bg-bnhs-blue' : 'bg-gray-300' }}"></div>
                                    @if(!$loop->last)
                                        <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                                    @endif
                                </div>
                                <div class="flex-1 pb-4">
                                    <p class="text-sm font-semibold text-gray-900">{{ $log->action }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $log->created_at->format('F d, Y - h:i A') }}
                                        @if($log->user)
                                            <span class="text-gray-400">• by {{ $log->user->name }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No activity recorded yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Digital Signature -->
            @if($request->signature)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mt-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Digital Signature</h3>
                    <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-1 rounded uppercase font-bold">Stored as Base64</span>
                </div>
                <div class="p-8 flex justify-center bg-slate-50">
                    <div class="bg-white p-4 rounded-xl shadow-inner border border-gray-200">
                        {{-- Directly echo the string. Most signature pads include the 'data:image/png;base64,' prefix --}}
                        <img src="{{ $request->signature }}" 
                            alt="Student Signature" 
                            class="max-h-48 w-auto mix-blend-multiply"
                            onerror="this.parentElement.innerHTML='<span class=\'text-red-500 text-sm\'>Invalid signature data</span>'">
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Actions</h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Update Status Button -->
                    <button onclick="document.getElementById('statusModal').classList.remove('hidden')" class="w-full px-4 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                        Update Status
                    </button>

                    <!-- Add Remarks Button -->
                    <button onclick="document.getElementById('remarksModal').classList.remove('hidden')" class="w-full px-4 py-2.5 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                        Add Remarks
                    </button>

                    @if(Auth::user()->role === 'admin')
                    <!-- Delete Button (Admins only) -->
                    <form method="POST" action="{{ route('admin.requests.destroy', $request->id) }}" onsubmit="return confirm('Are you sure you want to delete this request? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                            Delete Request
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <!-- Admin Remarks Card -->
            @if($request->admin_remarks)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Admin Remarks</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-700">{{ $request->admin_remarks }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Update Status Modal -->
    <div id="statusModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Update Status</h3>
                <button onclick="document.getElementById('statusModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.requests.update-status', $request->id) }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $request->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="ready" {{ $request->status === 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estimated Completion Date</label>
                        <input type="date" name="estimated_completion_date" 
                            value="{{ $request->estimated_completion_date ? $request->estimated_completion_date->format('Y-m-d') : '' }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Remarks</label>
                        <textarea name="admin_remarks" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">{{ $request->admin_remarks }}</textarea>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit" class="flex-1 bg-bnhs-blue text-white px-4 py-2.5 rounded-lg hover:bg-bnhs-blue-600 font-semibold transition">
                        Update
                    </button>
                    <button type="button" onclick="document.getElementById('statusModal').classList.add('hidden')" class="flex-1 bg-gray-200 text-gray-900 px-4 py-2.5 rounded-lg hover:bg-gray-300 font-semibold transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Remarks Modal -->
    <div id="remarksModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Add Remarks</h3>
                <button onclick="document.getElementById('remarksModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.requests.update-status', $request->id) }}">
                @csrf
                <input type="hidden" name="status" value="{{ $request->status }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Remarks (Visible to User)</label>
                    <textarea name="admin_remarks" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">{{ $request->admin_remarks }}</textarea>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit" class="flex-1 bg-bnhs-blue text-white px-4 py-2.5 rounded-lg hover:bg-bnhs-blue-600 font-semibold transition">
                        Save Remarks
                    </button>
                    <button type="button" onclick="document.getElementById('remarksModal').classList.add('hidden')" class="flex-1 bg-gray-200 text-gray-900 px-4 py-2.5 rounded-lg hover:bg-gray-300 font-semibold transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
