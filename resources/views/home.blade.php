@extends('layouts.public')

@section('title', 'BNHS eDocument Request - Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[calc(100vh-4rem)] overflow-hidden flex items-center justify-center">
    <!-- Optimized Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/bg_view.png');"></div>
        <div class="absolute inset-0 bg-white/60"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-7xl">
                <span class="block mb-2">Bato National High School</span>
                <span class="block text-bnhs-blue tracking-tight">eDocument Request</span>
            </h1>

            <p class="mx-auto mt-8 max-w-2xl text-xl leading-relaxed text-gray-700 font-medium">
                Request and track your school documents online. Simple, fast, and secure—verify your email and submit your request in minutes.
            </p>

            <div class="mt-12 flex flex-col items-center justify-center gap-6 sm:flex-row">
                <a
                    href="{{ route('request.select') }}"
                    wire:navigate
                    class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-bnhs-blue px-10 py-4 text-lg font-bold text-white shadow-2xl shadow-bnhs-blue/30 transition-all hover:bg-bnhs-blue-600 hover:scale-105 active:scale-95 sm:w-auto">
                    <svg class="h-6 w-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Request a Document
                </a>
                <a
                    href="{{ route('tracking.form') }}"
                    class="inline-flex w-full items-center justify-center gap-3 rounded-2xl border-2 border-gray-200 bg-white/80 backdrop-blur-md px-10 py-4 text-lg font-bold text-gray-900 shadow-xl transition-all hover:bg-gray-50 hover:border-bnhs-blue/30 hover:text-bnhs-blue sm:w-auto">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Track Request
                </a>
            </div>

            <!-- How to Request Guide Link -->
            <div class="mt-10 text-center animate-bounce">
                <a
                    href="{{ route('how-to-request') }}"
                    class="inline-flex items-center gap-2 text-sm font-bold text-bnhs-blue hover:text-bnhs-blue-600 underline decoration-2 underline-offset-4 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    How to Request a Document?
                </a>
            </div>
        </div>
    </div>
</section>
@endsection