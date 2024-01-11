<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @page {
            size: 210mm 297mm;
            /* Chrome sets own margins, we change these printer settings */
            margin: 5mm;
        }

        * {
            -webkit-print-color-adjust: exact !important; /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important; /* Firefox 48 – 96 */
            print-color-adjust: exact !important; /* Firefox 97+, Safari 15.4+ */
        }
    </style>
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div>
    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
<x-notification/>
@livewire('livewire-ui-modal')
@livewireScripts
</body>
</html>
