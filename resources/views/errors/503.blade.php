@extends('layouts.public')

@section('title', 'BNHS eDocument Request - Maintenance')

@section('content')
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
            We are currently undergoing scheduled maintenance. We will be back online shortly!
        </p>


    </div>
</section>
@endsection