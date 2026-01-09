@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen overflow-hidden pt-16 flex items-center justify-center" style="background-image: url('/bg_view.png'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-dark sm:text-5xl lg:text-6xl">
                <span class="block">Bato National High School</span>
                <span class="block text-blue-900">eDocument Request</span>
                </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-700">
                Request and track your school documents online. Simple, fast, and secure—verify your email and submit your request in minutes.
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a
                    href="{{ route('request.select') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-blue-800 px-8 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:w-auto"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                        Request a Document
                    </a>
                <a
                    href="{{ route('tracking.form') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-100 px-8 py-3.5 text-base font-semibold text-gray-900 dark:text-gray-800 shadow-sm transition hover:bg-gray-50 dark:hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:w-auto"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Track Request
                </a>
            </div>

            <!-- How to Request Guide Link -->
            <div class="mt-8 text-center">
                <a
                    href="{{ route('how-to-request') }}"
                    class="text-sm font-semibold text-blue-600 hover:text-blue-800 underline transition"
                >
                    📖 How to Request a Document?
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
