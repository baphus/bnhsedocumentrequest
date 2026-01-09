@extends('layouts.public')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Icon Header -->
            <div class="bg-gradient-to-br from-bnhs-blue to-bnhs-blue-600 px-6 py-8 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white">
                    Track Your Request
                </h2>
                <p class="text-bnhs-blue-100 text-sm mt-2">
                    Check the status of your document request
                </p>
            </div>

            <div class="p-6 sm:p-8">
                <p class="text-gray-600 mb-6 text-center">
                    Enter your tracking ID and email address to view your request status
                </p>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('tracking.track') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="tracking_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Tracking ID <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="tracking_id" 
                                name="tracking_id" 
                                value="{{ old('tracking_id') }}"
                                required 
                                placeholder="DOC-XXXXXX"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition uppercase font-mono"
                            >
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Enter the tracking ID you received after submission</p>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                placeholder="your.email@example.com"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition"
                            >
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Use the same email from your request</p>
                    </div>

                    <button type="submit" class="w-full bg-bnhs-blue text-white py-3 px-6 rounded-lg hover:bg-bnhs-blue-600 transition font-semibold shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Track Request
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500 mb-3">Need help?</p>
                    <a href="{{ route('home') }}" class="text-sm text-bnhs-blue hover:underline font-medium inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>

        <!-- Help Text -->
        <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-gray-700">
                        <strong class="font-semibold">Lost your tracking ID?</strong> Check your email inbox for the confirmation message sent after you submitted your request.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
