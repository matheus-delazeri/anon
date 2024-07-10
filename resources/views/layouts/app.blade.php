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
</head>
<body class="font-sans antialiased">
<div class="min-h-screen flex justify-center relative items-center bg-gray-200 dark:bg-gray-900">
    <div class="w-3/4 absolute bg-gray-100 dark:bg-gray-800 border rounded-md border-gray-100 dark:border-gray-900"
         style="height: 90%">
        <div class="p-2" style="max-height: 7%">
            <livewire:layout.navigation/>
        </div>

        <!-- Page Content -->
        <main class="overflow-y-auto" style="height: 93%">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
