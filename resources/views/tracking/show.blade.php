@extends('layouts.public')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('tracking.form') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-bnhs-blue transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Track Another Request
            </a>
        </div>

        <!-- Status Header Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-bnhs-blue to-bnhs-blue-600 px-6 py-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">
                            Request Details
                        </h2>
                        <p class="text-bnhs-blue-100 text-sm">
                            Tracking ID: <span class="font-mono font-semibold">{{ $documentRequest->tracking_id }}</span>
                        </p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        @if($documentRequest->status === 'pending') bg-gray-100 text-gray-800
                        @elseif($documentRequest->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($documentRequest->status === 'ready') bg-green-100 text-green-800
                        @elseif($documentRequest->status === 'completed') bg-purple-100 text-purple-800
                        @endif">
                        {{ ucfirst($documentRequest->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <!-- Status Timeline -->
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Request Progress</h3>
                    <div class="flex items-center justify-between">
                        <!-- Pending -->
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($documentRequest->status, ['pending', 'processing', 'ready', 'completed']) ? 'bg-bnhs-blue text-white' : 'bg-gray-200 text-gray-500' }}">
                                @if(in_array($documentRequest->status, ['processing', 'ready', 'completed']))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <span class="text-sm font-semibold">1</span>
                                @endif
                            </div>
                            <p class="text-xs mt-2 text-center font-medium {{ $documentRequest->status === 'pending' ? 'text-bnhs-blue' : 'text-gray-600' }}">Pending</p>
                        </div>

                        <div class="flex-1 h-1 {{ in_array($documentRequest->status, ['processing', 'ready', 'completed']) ? 'bg-bnhs-blue' : 'bg-gray-200' }}"></div>

                        <!-- Processing -->
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($documentRequest->status, ['processing', 'ready', 'completed']) ? 'bg-bnhs-blue text-white' : 'bg-gray-200 text-gray-500' }}">
                                @if(in_array($documentRequest->status, ['ready', 'completed']))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <span class="text-sm font-semibold">2</span>
                                @endif
                            </div>
                            <p class="text-xs mt-2 text-center font-medium {{ $documentRequest->status === 'processing' ? 'text-bnhs-blue' : 'text-gray-600' }}">Processing</p>
                        </div>

                        <div class="flex-1 h-1 {{ in_array($documentRequest->status, ['ready', 'completed']) ? 'bg-bnhs-blue' : 'bg-gray-200' }}"></div>

                        <!-- Ready -->
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($documentRequest->status, ['ready', 'completed']) ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                                @if($documentRequest->status === 'completed')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <span class="text-sm font-semibold">3</span>
                                @endif
                            </div>
                            <p class="text-xs mt-2 text-center font-medium {{ $documentRequest->status === 'ready' ? 'text-green-600' : 'text-gray-600' }}">Ready</p>
                        </div>

                        <div class="flex-1 h-1 {{ $documentRequest->status === 'completed' ? 'bg-purple-500' : 'bg-gray-200' }}"></div>

                        <!-- Completed -->
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $documentRequest->status === 'completed' ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                                <span class="text-sm font-semibold">4</span>
                            </div>
                            <p class="text-xs mt-2 text-center font-medium {{ $documentRequest->status === 'completed' ? 'text-purple-600' : 'text-gray-600' }}">Completed</p>
                        </div>
                    </div>
                </div>

                <!-- Request Information Grid -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-50 rounded-lg p-5">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Personal Information</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Full Name</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->full_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Email Address</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->email }}</p>
                            </div>
                            @if($documentRequest->contact_number)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Contact Number</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->contact_number }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="bg-gray-50 rounded-lg p-5">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Student Information</h4>
                        <div class="space-y-3">
                            @if($documentRequest->lrn)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">LRN</p>
                                <p class="text-sm font-medium text-gray-900 font-mono">{{ $documentRequest->lrn }}</p>
                            </div>
                            @endif
                            @if($documentRequest->grade_level)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Grade Level</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->grade_level }}</p>
                            </div>
                            @endif
                            @if($documentRequest->track_strand)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Track/Strand</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->track_strand }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Document Details -->
                    <div class="bg-gray-50 rounded-lg p-5">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Document Details</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Document Type</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->documentType->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Quantity</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->quantity }}</p>
                            </div>
                            @if($documentRequest->purpose)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Purpose</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->purpose }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Request Details -->
                    <div class="bg-gray-50 rounded-lg p-5">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Request Details</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Submitted On</p>
                                <p class="text-sm font-medium text-gray-900">{{ $documentRequest->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Estimated Completion</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $documentRequest->estimated_completion_date ? $documentRequest->estimated_completion_date->format('F d, Y') : 'To be determined' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Current Status</p>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($documentRequest->status === 'pending') bg-gray-200 text-gray-800
                                    @elseif($documentRequest->status === 'processing') bg-blue-200 text-blue-800
                                    @elseif($documentRequest->status === 'ready') bg-green-200 text-green-800
                                    @elseif($documentRequest->status === 'completed') bg-purple-200 text-purple-800
                                    @endif">
                                    {{ ucfirst($documentRequest->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Remarks -->
                @if($documentRequest->admin_remarks)
                    <div class="bg-blue-50 border-l-4 border-bnhs-blue rounded-lg p-5 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-bnhs-blue mb-1">Registrar's Remarks</p>
                                <p class="text-sm text-gray-700">{{ $documentRequest->admin_remarks }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Ready for Pickup Notice -->
                @if($documentRequest->status === 'ready')
                    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-5 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-green-800 mb-1">Document Ready for Pickup!</p>
                                <p class="text-sm text-green-700">Your document is ready. Please visit the registrar's office during office hours to collect your document. Bring a valid ID.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Activity Timeline</h3>
            </div>

            <div class="p-6">
                <div class="space-y-6">
                    @forelse($documentRequest->logs as $log)
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full {{ $loop->first ? 'bg-bnhs-blue' : 'bg-gray-300' }}"></div>
                                @if(!$loop->last)
                                    <div class="w-0.5 flex-1 bg-gray-200 mt-2"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-6">
                                <p class="font-semibold text-gray-900 mb-1">{{ $log->action }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $log->created_at->format('F d, Y - h:i A') }}
                                    @if($log->user)
                                        <span class="text-gray-500">• by {{ $log->user->name }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-gray-500">No activity recorded yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('tracking.form') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Track Another Request
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
