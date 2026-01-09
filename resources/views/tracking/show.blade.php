@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Request Status
                    </h2>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        @if($documentRequest->status === 'pending') bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                        @elseif($documentRequest->status === 'processing') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                        @elseif($documentRequest->status === 'ready') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                        @elseif($documentRequest->status === 'completed') bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200
                        @endif">
                        {{ ucfirst($documentRequest->status) }}
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tracking ID</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $documentRequest->tracking_id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Document Type</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $documentRequest->documentType->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Submitted On</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $documentRequest->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Estimated Completion</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $documentRequest->estimated_completion_date ? $documentRequest->estimated_completion_date->format('M d, Y') : 'TBD' }}
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Requestor</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $documentRequest->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Quantity</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $documentRequest->quantity }}</p>
                    </div>
                </div>

                @if($documentRequest->admin_remarks)
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                        <p class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-1">Registrar's Remarks:</p>
                        <p class="text-sm text-blue-700 dark:text-blue-300">{{ $documentRequest->admin_remarks }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Activity Timeline</h3>

                <div class="space-y-6">
                    @forelse($documentRequest->logs as $log)
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-4 h-4 rounded-full bg-blue-600 dark:bg-blue-400"></div>
                                @if(!$loop->last)
                                    <div class="w-0.5 h-full bg-gray-300 dark:bg-gray-600 mt-2"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-6">
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $log->action }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $log->created_at->format('M d, Y h:i A') }}
                                    @if($log->user)
                                        <span class="text-gray-500 dark:text-gray-500">by {{ $log->user->name }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No activity yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
