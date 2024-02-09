<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-fit-sans text-gray-900 antialiased">
<div class="relative min-h-screen flex flex-col sm:justify-center items-center">
    <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#F72585] to-[#3A0CA3] opacity-60"></div>
    <img
        class="hidden lg:block aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
        src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80"
        alt="">
    <div class="z-10 w-full sm:max-w-md bg-white shadow-md overflow-hidden sm:rounded-md">
        {{ $slot }}
    </div>
</div>
@livewireScripts
</body>
</html>
