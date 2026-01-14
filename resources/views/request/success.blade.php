@extends('layouts.public')

@section('content')
<div class="min-h-screen flex items-center justify-center py-8 px-4 sm:py-12 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="p-6 sm:p-12 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">
                    Request Submitted Successfully!
                </h2>

                <p class="text-sm sm:text-base text-gray-600 mb-8">
                    Your document request has been received. Please save your tracking ID below.
                </p>

                <!-- Tracking ID Card -->
                <div class="bg-gradient-to-br from-bnhs-blue to-bnhs-blue-600 rounded-xl p-6 sm:p-8 mb-8 shadow-lg">
                    <p class="text-bnhs-blue-100 text-xs sm:text-sm mb-3 uppercase tracking-wide font-semibold">Your Tracking ID</p>
                    <p class="text-3xl sm:text-5xl font-bold text-white mb-4 tracking-wider font-mono break-all">
                        {{ $request->tracking_id }}
                    </p>
                    <p class="text-bnhs-blue-100 text-xs sm:text-sm">
                        Use this ID to track your request status
                    </p>
                </div>

                <!-- Request Summary -->
                <div class="bg-gray-50 rounded-lg p-4 sm:p-6 mb-6 text-left">
                    <h3 class="font-semibold text-gray-900 mb-4 text-center">Request Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-start sm:items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-600 text-sm shrink-0">Document Type</span>
                            <span class="text-gray-900 font-medium text-right ml-2">{{ $request->documentType->name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-600 text-sm shrink-0">Quantity</span>
                            <span class="text-gray-900 font-medium">{{ $request->quantity }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-600 text-sm shrink-0">Current Status</span>
                            <span class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-xs font-semibold uppercase">{{ $request->status }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-600 text-sm shrink-0">Estimated Completion</span>
                            <span class="text-gray-900 font-medium text-right">{{ $request->estimated_completion_date->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-blue-50 border-l-4 border-bnhs-blue rounded-lg p-4 mb-8 text-left">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-700">
                                <strong class="font-semibold">IMPORTANT:</strong> Please <strong class="font-bold uppercase text-red-600">SCREENSHOT</strong> or save your Tracking ID immediately. You will need it to track the progress of your request.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('tracking.form', ['tracking_id' => $request->tracking_id]) }}" 
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-bnhs-blue text-white py-3 px-6 rounded-lg hover:bg-bnhs-blue-600 transition font-semibold shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Track This Request
                    </a>
                    <a href="{{ route('home') }}" 
                       class="flex-1 text-center bg-white border-2 border-gray-300 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-50 transition font-semibold">
                        Request Another Document
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
