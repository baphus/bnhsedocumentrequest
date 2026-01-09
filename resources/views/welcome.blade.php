@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-7xl mx-auto text-center">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            No Account Required
        </div>

        <!-- Main Heading -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
            Bato National High School
        </h1>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-bnhs-blue mb-6">
            eDocument Request
        </h2>

        <!-- Description -->
        <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-10 leading-relaxed">
            Request and track your school documents online. Simple, fast, and secure—verify your email and submit your request in minutes. No account needed!
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a
                href="{{ route('request.select') }}"
                class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-bnhs-blue text-white rounded-lg font-semibold text-base shadow-lg hover:bg-bnhs-blue-600 transition-all duration-200 w-full sm:w-auto"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Request a Document
            </a>
            <a
                href="{{ route('tracking.form') }}"
                class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white border-2 border-gray-300 text-gray-900 rounded-lg font-semibold text-base shadow-lg hover:bg-gray-50 transition-all duration-200 w-full sm:w-auto"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Track Request
            </a>
        </div>
    </div>
</section>

<!-- Available Documents Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Available Documents</h2>
            <p class="text-lg text-gray-600">Choose from our wide range of official and certified documents</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Official Documents -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-bnhs-blue">
                <div class="w-14 h-14 bg-bnhs-blue-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Official Documents</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Form 137 (Permanent Record)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Form 138 (Report Card)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Certificate of Good Moral</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Diploma</span>
                    </li>
                </ul>
            </div>

            <!-- Informal Documents -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-bnhs-gold">
                <div class="w-14 h-14 bg-bnhs-gold-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Informal Documents</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-gold-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Certificate of Enrollment</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-gold-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Certificate of Grades</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-bnhs-gold-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Transcript of Records</span>
                    </li>
                </ul>
            </div>

            <!-- Certified Documents -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-green-500">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Certified Documents</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Certified True Copy of Grades</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Authenticated Diploma</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Certified Transcript</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
            <p class="text-lg text-gray-600">Get your documents in 4 simple steps</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-bnhs-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">
                    1
                </div>
                <div class="w-12 h-12 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Select Document</h3>
                <p class="text-gray-600 text-sm">Choose the document type you need from our list of available documents</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-bnhs-gold text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">
                    2
                </div>
                <div class="w-12 h-12 bg-bnhs-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Verify Email</h3>
                <p class="text-gray-600 text-sm">Enter your email address and verify it with the OTP code we send you</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-bnhs-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">
                    3
                </div>
                <div class="w-12 h-12 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Fill Form</h3>
                <p class="text-gray-600 text-sm">Complete the request form with your information and digital signature</p>
            </div>

            <!-- Step 4 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-bnhs-gold text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">
                    4
                </div>
                <div class="w-12 h-12 bg-bnhs-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Track & Collect</h3>
                <p class="text-gray-600 text-sm">Use your tracking ID to monitor your request status and collect when ready</p>
            </div>
        </div>
    </div>
</section>

<!-- Help & Support Section -->
<section class="py-20 bg-gray-50" x-data="{ openFaq: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Help & Support</h2>
            <p class="text-lg text-gray-600">Frequently asked questions</p>
        </div>

        <!-- FAQ Accordion -->
        <div class="max-w-3xl mx-auto space-y-4 mb-12">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-lg shadow">
                <button
                    @click="openFaq = openFaq === 1 ? null : 1"
                    class="w-full flex items-center justify-between p-6 text-left"
                >
                    <span class="text-lg font-semibold text-gray-900">How long does it take to process my request?</span>
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
                    class="px-6 pb-6"
                    style="display: none;"
                >
                    <p class="text-gray-600">Processing time varies depending on the document type. Most documents are ready within 3-5 business days. You'll receive email updates on your request status.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-lg shadow">
                <button
                    @click="openFaq = openFaq === 2 ? null : 2"
                    class="w-full flex items-center justify-between p-6 text-left"
                >
                    <span class="text-lg font-semibold text-gray-900">Do I need to create an account?</span>
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
                    class="px-6 pb-6"
                    style="display: none;"
                >
                    <p class="text-gray-600">No account is required! Simply verify your email address and submit your request. You'll receive a tracking ID to monitor your request status.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-lg shadow">
                <button
                    @click="openFaq = openFaq === 3 ? null : 3"
                    class="w-full flex items-center justify-between p-6 text-left"
                >
                    <span class="text-lg font-semibold text-gray-900">How do I track my request?</span>
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
                    class="px-6 pb-6"
                    style="display: none;"
                >
                    <p class="text-gray-600">Use the tracking ID provided after submission and your email address on the "Track Request" page to view your request status in real-time.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-lg shadow">
                <button
                    @click="openFaq = openFaq === 4 ? null : 4"
                    class="w-full flex items-center justify-between p-6 text-left"
                >
                    <span class="text-lg font-semibold text-gray-900">What if I lost my tracking ID?</span>
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
                    class="px-6 pb-6"
                    style="display: none;"
                >
                    <p class="text-gray-600">Check your email - we sent the tracking ID to your verified email address. If you still can't find it, please contact the registrar's office.</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Email -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="w-12 h-12 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-gray-900 text-center mb-2">Email</h4>
                <p class="text-sm text-gray-600 text-center">bnhs@deped.gov.ph</p>
            </div>

            <!-- Phone -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="w-12 h-12 bg-bnhs-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-gray-900 text-center mb-2">Phone</h4>
                <p class="text-sm text-gray-600 text-center">(032) 123-4567</p>
            </div>

            <!-- Office Hours -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-gray-900 text-center mb-2">Office Hours</h4>
                <p class="text-sm text-gray-600 text-center">Mon-Fri: 8AM-5PM</p>
            </div>

            <!-- Location -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-gray-900 text-center mb-2">Location</h4>
                <p class="text-sm text-gray-600 text-center">Toledo City, Cebu</p>
            </div>
        </div>

        <!-- Help Notice -->
        <div class="bg-blue-50 border-l-4 border-bnhs-blue rounded-lg p-6">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-1">Need Additional Help?</h4>
                    <p class="text-sm text-gray-700">Contact the registrar's office directly during office hours or send us an email. We're here to help!</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
