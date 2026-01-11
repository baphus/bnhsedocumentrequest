@extends('layouts.public')

@section('title', 'BNHS eDocument Request - Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background & Overlays -->
    <div class="absolute inset-0 z-0">
        <!-- Main Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transform scale-105" 
             style="background-image: url('/bg_view.png');">
        </div>
        
        <!-- Light Overlay for Text Readability -->
        <!-- <div class="absolute inset-0 bg-white/30 backdrop-blur-[1px]"></div> -->

        <!-- Gradient Fade to Next Section -->
        <div class="absolute bottom-0 left-0 right-0 h-64 bg-gradient-to-t from-gray-50 via-gray-50/60 to-transparent"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 sm:py-20 text-center">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-7xl mb-6 sm:mb-8">
            <span class="block mb-2">Bato National High School</span>
            <span class="block text-bnhs-blue tracking-tight">eDocument Request</span>
        </h1>

        <p class="mx-auto mt-4 sm:mt-6 max-w-2xl text-lg sm:text-xl leading-relaxed text-gray-700 font-medium">
            Request and track your school documents online. Simple, fast, and secure—verify your email and submit your request in minutes.
        </p>

        <div class="mt-8 sm:mt-12 flex flex-col items-center justify-center gap-4 sm:gap-6 sm:flex-row">
            <a
                href="{{ route('request.select') }}"
                wire:navigate
                class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-bnhs-blue px-6 py-3 sm:px-10 sm:py-4 text-base sm:text-lg font-bold text-white shadow-2xl shadow-bnhs-blue/30 transition-all hover:bg-bnhs-blue-600 hover:scale-105 active:scale-95 sm:w-auto">
                <svg class="h-5 w-5 sm:h-6 sm:w-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Request a Document
            </a>
            <a
                href="{{ route('tracking.form') }}"
                class="inline-flex w-full items-center justify-center gap-3 rounded-2xl border-2 border-gray-200 bg-white/80 backdrop-blur-md px-6 py-3 sm:px-10 sm:py-4 text-base sm:text-lg font-bold text-gray-900 shadow-xl transition-all hover:bg-gray-50 hover:border-bnhs-blue/30 hover:text-bnhs-blue sm:w-auto">
                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Track Request
            </a>
        </div>
    </div>
</section>

<!-- How to Request Section -->
<section class="py-12 sm:py-20 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                How to <span class="text-bnhs-blue">Request</span> a Document
            </h2>
            <p class="mt-3 sm:mt-4 text-lg sm:text-xl text-gray-600 font-medium">
                Our streamlined process makes getting your school documents easier than ever.
            </p>
        </div>

        @php
        $steps = [
            [
                'number' => 1,
                'title' => 'Select Document',
                'description' => 'Browse and pick the document type you need from our available list.',
                'image' => 'images/how_to_request/Step_1.png',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
                'details' => ['Grouped by document categories', 'Real-time processing day estimates', 'Multiple copies selection available'],
            ],
            [
                'number' => 2,
                'title' => 'Email Verification',
                'description' => 'Security first! Verify your identity using a one-time code sent to your email.',
                'image' => 'images/how_to_request/Step_2.png',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',
                'details' => ['Enter your active school or personal email', 'Receive a 6-digit OTP code', 'Instant verification to proceed'],
            ],
            [
                'number' => 3,
                'title' => 'Fill the Details',
                'description' => 'Provide the necessary information and your digital signature to complete the request.',
                'image' => 'images/how_to_request/Step_3.png',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>',
                'details' => ['Student information and purpose', 'Interactive digital signature pad', 'Summary of your request details'],
            ],
            [
                'number' => 4,
                'title' => 'Track & Receive',
                'description' => 'Monitor your request status and pick up your documents when ready!',
                'image' => 'images/how_to_request/Step_4.png',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>',
                'details' => ['Get a unique Tracking ID', 'Email notifications on status changes', 'Office pickup once status is "Ready"'],
            ],
        ];
        @endphp

        <div class="grid grid-cols-1 gap-12 sm:gap-16 md:gap-24">
            @foreach ($steps as $index => $step)
            <div class="flex flex-col md:flex-row items-center gap-8 sm:gap-12 {{ $index % 2 === 1 ? 'md:flex-row-reverse' : '' }}">
                <!-- Image -->
                <div class="flex-1 w-full">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-bnhs-blue/20 to-bnhs-gold/20 rounded-[2rem] blur-2xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <div class="relative bg-white border border-gray-100 rounded-[2rem] p-4 shadow-xl shadow-gray-200/50">
                            <img src="{{ asset($step['image']) }}" alt="{{ $step['title'] }}" class="w-full h-auto rounded-xl object-cover">
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 space-y-6 text-left">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-2xl bg-bnhs-blue text-white shadow-xl shadow-bnhs-blue/30 transform -rotate-6 group-hover:rotate-0 transition duration-300">
                            {!! $step['icon'] !!}
                        </div>
                        <span class="text-4xl sm:text-6xl font-black text-gray-100 select-none absolute -z-10 transform -translate-x-2 -translate-y-2 sm:-translate-x-4 sm:-translate-y-4">0{{ $step['number'] }}</span>
                    </div>
                    
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-base sm:text-lg text-gray-600 leading-relaxed">{{ $step['description'] }}</p>
                    </div>

                    <ul class="space-y-3">
                        @foreach($step['details'] as $detail)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700 font-medium">{{ $detail }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section class="py-12 sm:py-20 bg-white" x-data="{ openFaq: null }">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Frequently Asked Questions</h2>
            <p class="mt-3 sm:mt-4 text-base sm:text-lg text-gray-600">Common questions about the request process</p>
        </div>

        <div class="space-y-4">
            <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full flex items-center justify-between p-4 sm:p-6 text-left bg-gray-50 hover:bg-gray-100 transition">
                    <span class="font-bold text-gray-900 text-base sm:text-lg">How long does it take to process my request?</span>
                    <svg class="w-6 h-6 text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openFaq === 1" x-collapse>
                    <div class="p-4 sm:p-6 text-sm sm:text-base text-gray-600 bg-white leading-relaxed border-t border-gray-100">
                        Processing time varies by document. Most are ready within 3-5 business days. You will receive an email notification when it is ready.
                    </div>
                </div>
            </div>

            <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full flex items-center justify-between p-4 sm:p-6 text-left bg-gray-50 hover:bg-gray-100 transition">
                    <span class="font-bold text-gray-900 text-base sm:text-lg">Do I need to create an account?</span>
                    <svg class="w-6 h-6 text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openFaq === 2" x-collapse>
                    <div class="p-4 sm:p-6 text-sm sm:text-base text-gray-600 bg-white leading-relaxed border-t border-gray-100">
                        No account required. Every request is verified via a One-Time Password (OTP) sent to your email address.
                    </div>
                </div>
            </div>

            <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full flex items-center justify-between p-4 sm:p-6 text-left bg-gray-50 hover:bg-gray-100 transition">
                    <span class="font-bold text-gray-900 text-base sm:text-lg">How do I track my request?</span>
                    <svg class="w-6 h-6 text-gray-500 transition-transform duration-300" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openFaq === 3" x-collapse>
                    <div class="p-4 sm:p-6 text-sm sm:text-base text-gray-600 bg-white leading-relaxed border-t border-gray-100">
                        After submission, you'll receive a Tracking ID. Enter this ID and your email on our "Track Request" page to see real-time status.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection