@extends('layouts.public')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <!-- Step 1: Select Document -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">Select Document</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-3">
                Enter Verification Code
            </h2>

            <p class="text-gray-600 text-center mb-2">
                We've sent a 6-digit code to:
            </p>
            <p class="text-bnhs-blue font-semibold text-center mb-8">
                {{ $email }}
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

            <form method="POST" action="{{ route('otp.verify.submit') }}">
                @csrf
                <input type="hidden" name="purpose" value="{{ $purpose }}">

                <div class="mb-6">
                    <label for="code" class="block text-sm font-medium text-gray-700 text-center mb-3">
                        Verification Code
                    </label>
                    <input 
                        type="text" 
                        id="code" 
                        name="code" 
                        value="{{ old('code') }}"
                        required 
                        maxlength="6"
                        pattern="[0-9]{6}"
                        class="w-full px-4 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition text-3xl text-center tracking-[0.5em] font-mono font-bold"
                        placeholder="000000"
                        autofocus
                    >
                    <p class="mt-3 text-sm text-gray-500 text-center">
                        Enter the 6-digit code from your email
                    </p>
                </div>

                <button type="submit" class="w-full bg-bnhs-blue text-white py-3 px-6 rounded-lg hover:bg-bnhs-blue-600 transition font-semibold text-base shadow-lg">
                    Verify & Continue
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 mb-3">
                    Didn't receive the code?
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                    <a href="{{ route('otp.resend', ['purpose' => $purpose]) }}" class="text-sm text-bnhs-blue hover:underline font-medium inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Resend Code
                    </a>
                    <span class="text-gray-400 hidden sm:block">|</span>
                    <a href="{{ route('otp.request', ['purpose' => $purpose]) }}" class="text-sm text-gray-600 hover:text-bnhs-blue transition">
                        Change Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
