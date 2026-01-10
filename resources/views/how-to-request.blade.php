@extends('layouts.public')

@section('title', 'How to Request a Document - BNHS eDocument Request')

@section('content')
<main class="py-12">
    <!-- Page Header Section -->
    <section class="mb-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center pt-8">
            <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                How to <span class="text-bnhs-blue">Request</span> a Document
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Our streamlined process makes getting your school documents easier than ever.
            </p>
        </div>
    </section>

    @php
    $steps = [
    [
    'number' => 1,
    'title' => 'Select Document',
    'description' => 'Browse and pick the document type you need from our available list.',
    'image' => 'images/how-to-request/step-1.png',
    'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>',
    'details' => [
    'Grouped by document categories',
    'Real-time processing day estimates',
    'Multiple copies selection available',
    ],
    ],
    [
    'number' => 2,
    'title' => 'Email Verification',
    'description' => 'Security first! Verify your identity using a one-time code sent to your email.',
    'image' => 'images/how-to-request/step-2.png',
    'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>',
    'details' => [
    'Enter your active school or personal email',
    'Receive a 6-digit OTP code',
    'Instant verification to proceed',
    ],
    ],
    [
    'number' => 3,
    'title' => 'Fill the Details',
    'description' => 'Provide the necessary information and your digital signature to complete the request.',
    'image' => 'images/how-to-request/step-3.png',
    'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>',
    'details' => [
    'Student information and purpose',
    'Interactive digital signature pad',
    'Summary of your request details',
    ],
    ],
    [
    'number' => 4,
    'title' => 'Track & Receive',
    'description' => 'Monitor your request status and pick up your documents when ready!',
    'image' => 'images/how-to-request/step-4.png',
    'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
    </svg>',
    'details' => [
    'Get a unique Tracking ID',
    'Email notifications on status changes',
    'Office pickup once status is "Ready"',
    ],
    ],
    ];
    @endphp

    <!-- Steps Section -->
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-16 md:gap-24">
            @foreach ($steps as $index => $step)
            <div class="flex flex-col md:flex-row items-center gap-12 {{ $index % 2 === 1 ? 'md:flex-row-reverse' : '' }}">
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
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-bnhs-blue text-white shadow-xl shadow-bnhs-blue/30 transform -rotate-6 group-hover:rotate-0 transition duration-300">
                            {!! $step['icon'] !!}
                        </div>
                        <span class="text-xs font-bold text-bnhs-blue uppercase tracking-widest">Step {{ $step['number'] }}</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                        {{ $step['title'] }}
                    </h2>

                    <p class="text-lg text-gray-600 leading-relaxed font-medium">
                        {{ $step['description'] }}
                    </p>

                    <ul class="space-y-4 pt-2">
                        @foreach ($step['details'] as $detail)
                        <li class="flex items-center gap-3">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-semibold text-sm">{{ $detail }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection