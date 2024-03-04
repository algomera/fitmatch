<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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
<body class="font-fit-sans text-gray-900 antialiased h-full">
<div class="bg-fit-lighter-gray h-full">
    <div class="h-full grid lg:grid-cols-2">
        <div class="flex items-center justify-center">
            <div class="w-full mx-auto pb-14 px-6 lg:col-span-1 lg:px-4 lg:pb-0">
                {{ $slot }}
            </div>
        </div>
        <div class="relative">
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#F72585] to-[#3A0CA3] opacity-60"></div>
            {{ $image }}
        </div>
    </div>
</div>
@livewire('livewire-ui-modal')
@livewireScripts
</body>
</html>
