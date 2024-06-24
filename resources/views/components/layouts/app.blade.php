<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('dark', val))" x-bind:class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/stis_logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-gray-50" cz-shortcut-listen="true">
    <x-navbar />
    {{-- <div class="flex gap-8 bg-white dark:bg-gray-900"> --}}
    <div class="flex pt-10 overflow-hidden bg-white">
        <x-sidebar />
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64">
            <main>
                {{ $slot }}
            </main>
            <x-footer />
        </div>
        @livewireScripts
        @stack('scripts')
    </div>


    {{-- <x-header /> <!-- Misalnya, komponen header -->
    {{ $slot }}
    <x-footer /> <!-- Misalnya, komponen footer -->
    <x-sidebar /> <!-- Misalnya, komponen sidebar -->
    <x-table /> <!-- Misalnya, komponen table --> --}}
</body>

</html>
