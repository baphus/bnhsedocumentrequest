@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Request Submitted Successfully!
                </h2>

                <p class="text-gray-600 dark:text-gray-400 mb-8">
                    Your document request has been received and is being processed.
                </p>

                <!-- Tracking ID Card -->
                <div class="bg-blue-50 dark:bg-blue-900 border-2 border-blue-200 dark:border-blue-700 rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Your Tracking ID:</p>
                    <p class="text-4xl font-bold text-blue-600 dark:text-blue-300 mb-4 tracking-wider">
                        {{ $request->tracking_id }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Save this tracking ID to check your request status
                    </p>
                </div>

                <!-- Request Details -->
                <div class="text-left bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Request Summary</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Document:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $request->documentType->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Quantity:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $request->quantity }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Status:</span>
                            <span class="text-gray-900 dark:text-white font-medium capitalize">{{ $request->status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Estimated Completion:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $request->estimated_completion_date->format('F d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Email:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $request->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4 mb-6 text-left">
                    <p class="text-sm text-yellow-800 dark:text-yellow-200">
                        <strong>Important:</strong> A confirmation email has been sent to <strong>{{ $request->email }}</strong>. 
                        You will receive updates about your request status via email.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('otp.request', ['purpose' => 'tracking']) }}" 
                       class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-semibold">
                        Track This Request
                    </a>
                    <a href="{{ route('home') }}" 
                       class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white py-3 px-6 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition font-semibold">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
