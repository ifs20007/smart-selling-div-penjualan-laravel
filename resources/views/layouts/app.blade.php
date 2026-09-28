<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart Selling') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <!-- Background diubah agar menyatu dengan background CMS Anda -->
    <body class="font-sans antialiased bg-[#F4F7F6]"> 
        
        <!-- Konten Halaman (Tanpa Navbar dan Header bawaan Laravel Breeze) -->
        <main class="w-full h-full">
            {{ $slot }}
        </main>
        
    </body>
</html>