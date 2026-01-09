@extends('layouts.public')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <!-- Step 1: Select Document -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue-100 border-2 border-bnhs-blue text-bnhs-blue flex items-center justify-center font-semibold">
                        1
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Select Document</span>
                </div>
                
                <div class="w-12 sm:w-24 h-1 bg-bnhs-blue mx-2"></div>
                
                <!-- Step 2: Verify Email (Current) -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Verify Email</span>
                </div>
                
                <div class="w-12 sm:w-24 h-1 bg-gray-300 mx-2"></div>
                
                <!-- Step 3: Fill Form -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-semibold">
                        3
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500 hidden sm:block">Fill Form</span>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-xl p-8">
            <!-- Icon -->
            <div class="w-16 h-16 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-3">
                Verify Your Email
            </h2>

            <p class="text-gray-600 text-center mb-8">
                We'll send a 6-digit verification code to your email address to secure your request
            </p>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

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

            <form method="POST" action="{{ route('otp.send') }}">
                @csrf
                <input type="hidden" name="purpose" value="{{ $purpose }}">

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition"
                        placeholder="your.email@example.com"
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        We'll send updates about your request to this email
                    </p>
                </div>

                <button type="submit" class="w-full bg-bnhs-blue text-white py-3 px-6 rounded-lg hover:bg-bnhs-blue-600 transition font-semibold text-base shadow-lg">
                    Send Verification Code
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-bnhs-blue transition inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
