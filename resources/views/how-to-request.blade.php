@extends('layouts.public')

@section('title', 'How to Request a Document - BNHS eDocument Request')

@section('content')
<!-- Navigation Header -->
<header class="fixed top-0 z-50 w-full bg-white/90 backdrop-blur-md shadow-md">
    <nav class="w-full px-6 sm:px-8 lg:px-12">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo & School Name -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 transition">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-10 w-auto" />
                    @else
                        <x-application-logo class="h-10 w-10 fill-current text-bnhs-blue" />
                    @endif
                    <div>
                        <p class="text-sm font-bold text-gray-900">eDocument Request</p>
                        <p class="text-xs text-bnhs-blue font-semibold">Bato National High School</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center gap-4">
                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-600 transition px-4 py-1.5 hover:text-bnhs-blue"
                >
                    ❮ Back to Home
                </a>
            </div>
        </div>
    </nav>
</header>

<main class="pt-24 pb-12">
    <!-- Page Header Section -->
    <section class="mb-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                How to Request a Document
            </h1>
            <p class="text-xl text-gray-600">
                Follow these simple steps to get your school documents.
            </p>
        </div>
    </section>

    @php
        $steps = [
            [
                'number' => 1,
                'title' => 'Select Document Type',
                'description' => 'Choose which school document you need',
                'image' => 'images/how-to-request/step-1.png',
                'details' => [
                    'Browse available documents',
                    'Select from official, informal, or certified documents',
                    'Click on your desired document',
                ],
            ],
            [
                'number' => 2,
                'title' => 'Verify Your Email',
                'description' => 'Confirm your identity with a one-time code',
                'image' => 'images/how-to-request/step-2.png',
                'details' => [
                    'Enter your email address',
                    'We’ll send you a verification code',
                    'Check your inbox and enter the code',
                ],
            ],
            [
                'number' => 3,
                'title' => 'Submit Your Request',
                'description' => 'Fill out the request form with your details',
                'image' => 'images/how-to-request/step-3.png',
                'details' => [
                    'Complete all required information',
                    'You’ll receive a tracking ID',
                    'Keep it for follow-up',
                ],
            ],
            [
                'number' => 4,
                'title' => 'Receive Notification',
                'description' => 'Get notified when your document is ready',
                'image' => 'images/how-to-request/step-4.png',
                'details' => [
                    'We’ll email you when it’s prepared',
                    'Check tracking for updates anytime',
                    'Pick up at the registrar’s office',
                ],
            ],
        ];
    @endphp

    <!-- Steps Section -->
    <section class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-16">
            @foreach ($steps as $index => $step)
                <div
                    class="flex flex-col md:flex-row items-center gap-10
                    {{ $index % 2 === 1 ? 'md:flex-row-reverse' : '' }}"
                >
                    <!-- Step Image -->
                    <div class="flex-1 flex justify-center">
                        <div class="w-full max-w-sm">
                            <img
                                src="{{ asset($step['image']) }}"
                                alt="{{ $step['title'] }}"
                                loading="lazy"
                                class="w-full rounded-2xl shadow-lg object-contain bg-white p-3"
                            >
                        </div>
                    </div>

                    <!-- Step Content -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-bnhs-blue text-white text-xl font-bold">
                                {{ $step['number'] }}
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900">
                                {{ $step['title'] }}
                            </h2>
                        </div>

                        <p class="text-lg text-gray-600 mb-6">
                            {{ $step['description'] }}
                        </p>

                        <ul class="space-y-3">
                            @foreach ($step['details'] as $detail)
                                <li class="flex items-start gap-3">
                                    <svg class="h-6 w-6 text-bnhs-blue mt-0.5 flex-shrink-0"
                                         fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ $detail }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="border-t border-gray-200 bg-white py-2">
    <div class="w-full px-6 sm:px-10 lg:px-16">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Logo & Info -->
            <div class="flex items-center gap-3">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-12 w-auto" />
                @else
                    <x-application-logo class="h-12 w-12 fill-current text-bnhs-blue" />
                @endif
                <div>
                    <p class="text-sm font-bold text-gray-900">Bato National High School</p>
                    <p class="text-xs text-gray-600">DepEd Toledo City Division - Region 7</p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center md:text-right">
                <p class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Need help? 
                    <a href="#" class="text-bnhs-blue hover:underline" onclick="event.preventDefault(); document.getElementById('reportModal').classList.remove('hidden');">Report a Problem</a>
                    <span class="mx-1">|</span>
                    <a href="#" class="text-bnhs-blue hover:underline" onclick="event.preventDefault(); document.getElementById('contactModal').classList.remove('hidden');">Contact Information</a>
                    <span class="mx-1">|</span>
                    <a href="#" class="text-bnhs-blue hover:underline" onclick="event.preventDefault(); document.getElementById('faqModal').classList.remove('hidden');">Frequently Asked Questions</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Report Problem Modal -->
<div id="reportModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Report a Problem</h3>
            <button onclick="document.getElementById('reportModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Problem Description</label>
                    <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue"></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 bg-bnhs-blue text-white px-4 py-2 rounded-lg hover:bg-bnhs-blue-600 font-semibold transition">
                    Submit
                </button>
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="flex-1 bg-gray-200 text-gray-900 px-4 py-2 rounded-lg hover:bg-gray-300 font-semibold transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Contact Information Modal -->
<div id="contactModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Contact Information</h3>
            <button onclick="document.getElementById('contactModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Email -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-bnhs-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-1">Email</h4>
                    <p class="text-sm text-gray-600">bnhs@deped.gov.ph</p>
                </div>
            </div>

            <!-- Phone -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-bnhs-gold-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-1">Phone</h4>
                    <p class="text-sm text-gray-600">(032) 123-4567</p>
                </div>
            </div>

            <!-- Office Hours -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-1">Office Hours</h4>
                    <p class="text-sm text-gray-600">Mon-Fri: 8AM-5PM</p>
                </div>
            </div>

            <!-- Location -->
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-1">Location</h4>
                    <p class="text-sm text-gray-600">National Highway, Bato, Toledo City, Philippines, 6038</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Frequently Asked Questions Modal -->
<div id="faqModal" class="hidden fixed inset-0 bg-gray-900/50 z-50 flex items-center justify-center p-4" x-data="{ openFaq: null }">
    <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Frequently Asked Questions</h3>
            <button onclick="document.getElementById('faqModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-3">
            <!-- FAQ 1 -->
            <div class="border border-gray-200 rounded-lg">
                <button
                    @click="openFaq = openFaq === 1 ? null : 1"
                    class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"
                >
                    <span class="text-sm font-semibold text-gray-900">How long does it take to process my request?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transition-transform"
                        :class="{ 'rotate-180': openFaq === 1 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 1"
                    x-transition
                    class="px-4 pb-4 border-t border-gray-200"
                    style="display: none;"
                >
                    <p class="text-sm text-gray-600 mt-2">Processing time varies depending on the document type. Most documents are ready within 3-5 business days. You'll receive email updates on your request status.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="border border-gray-200 rounded-lg">
                <button
                    @click="openFaq = openFaq === 2 ? null : 2"
                    class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"
                >
                    <span class="text-sm font-semibold text-gray-900">Do I need to create an account?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transition-transform"
                        :class="{ 'rotate-180': openFaq === 2 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 2"
                    x-transition
                    class="px-4 pb-4 border-t border-gray-200"
                    style="display: none;"
                >
                    <p class="text-sm text-gray-600 mt-2">No account is required! Simply verify your email address and submit your request. You'll receive a tracking ID to monitor your request status.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="border border-gray-200 rounded-lg">
                <button
                    @click="openFaq = openFaq === 3 ? null : 3"
                    class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"
                >
                    <span class="text-sm font-semibold text-gray-900">How do I track my request?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transition-transform"
                        :class="{ 'rotate-180': openFaq === 3 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 3"
                    x-transition
                    class="px-4 pb-4 border-t border-gray-200"
                    style="display: none;"
                >
                    <p class="text-sm text-gray-600 mt-2">Use the tracking ID provided after submission and your email address on the "Track Request" page to view your request status in real-time.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="border border-gray-200 rounded-lg">
                <button
                    @click="openFaq = openFaq === 4 ? null : 4"
                    class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"
                >
                    <span class="text-sm font-semibold text-gray-900">What if I lost my tracking ID?</span>
                    <svg
                        class="w-5 h-5 text-gray-500 transition-transform"
                        :class="{ 'rotate-180': openFaq === 4 }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    x-show="openFaq === 4"
                    x-transition
                    class="px-4 pb-4 border-t border-gray-200"
                    style="display: none;"
                >
                    <p class="text-sm text-gray-600 mt-2">Check your email - we sent the tracking ID to your verified email address. If you still can't find it, please contact the registrar's office.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
