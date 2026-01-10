<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'BNHS eDocument Request'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col bg-gradient-to-br from-bnhs-blue-50 via-white to-bnhs-gold-50">
        <livewire:components.public.header />

        <main class="flex-grow pt-16">
            @hasSection('content')
            @yield('content')
            @else
            {{ $slot ?? '' }}
            @endif
        </main>

        <livewire:components.public.footer />
    </div>
    @livewireScripts
</body>

</html>