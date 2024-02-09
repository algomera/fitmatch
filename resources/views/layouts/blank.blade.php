<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-fit-sans antialiased">
<div class="min-h-screen bg-fit-lighter-gray">
    <!-- Page Content -->
    <main class="min-h-screen grid place-items-center">
        {{ $slot }}
    </main>
</div>
<x-notification/>
@livewire('livewire-ui-modal')
@livewireScripts
</body>
</html>
