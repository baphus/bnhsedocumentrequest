@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-8 text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    E-Document Request System
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                    Request official school documents online, anytime, anywhere.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('otp.request', ['purpose' => 'submission']) }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Request a Document
                    </a>
                    <a href="{{ route('otp.request', ['purpose' => 'tracking']) }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Track My Request
                    </a>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    How It Works
                </h2>
                <div class="grid md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-300">1</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Verify Email</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Enter your email and verify with OTP code
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-300">2</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Fill Form</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Complete your information and request details
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-300">3</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Get Tracking ID</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Receive a unique tracking ID via email
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-300">4</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Track Progress</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Monitor your request status online
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Documents -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    Available Documents
                </h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Form 137 (SF10)</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Academic Record</p>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Diploma</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Graduation Certificate</p>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Certificate of Enrollment</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Enrollment Verification</p>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Good Moral Certificate</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Character Reference</p>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Certificate of Grades</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Grade Report</p>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Transcript of Records</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Complete Academic Record</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
