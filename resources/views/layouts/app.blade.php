{{-- 
    =============================================
    LAYOUT UTAMA APLIKASI (AUTHENTICATED)
    =============================================
    
    Deskripsi:
    Layout ini digunakan untuk semua halaman yang memerlukan autentikasi user.
    Layout ini menyediakan struktur HTML dasar, meta tags, dan memuat asset CSS/JS.
    
    Penggunaan:
    - Digunakan oleh komponen <x-app-layout> di semua halaman dashboard dan survey
    - Menyediakan slot untuk konten utama ($slot)
    - Menyediakan stack untuk script tambahan (@stack('scripts'))
    
    Fitur:
    - Meta viewport untuk responsivitas mobile
    - CSRF token untuk keamanan form
    - Font Inter dari Bunny Fonts
    - Vite untuk bundling CSS dan JavaScript
    - Background slate-50 untuk tampilan yang bersih
    
    Responsivitas:
    - Viewport meta tag sudah diset untuk mobile-first design
    - Font dan spacing otomatis menyesuaikan dengan ukuran layar
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        {{-- Meta tags untuk karakter encoding dan viewport --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        {{-- CSRF Token untuk keamanan form Laravel --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Judul halaman menggunakan nama aplikasi dari config --}}
        <title>{{ config('app.name', 'AnalisaPro') }}</title>

        {{-- Font Poppins untuk tipografi yang modern --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        {{-- Vite: memuat bundel CSS dan JavaScript (Tailwind CSS, Alpine.js, dll) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="font-sans antialiased bg-slate-50">
    {{-- 
        Slot utama: konten dari halaman yang menggunakan <x-app-layout>
        Semua konten halaman akan dirender di sini
    --}}
        {{ $slot }}
    
    {{-- 
        Stack untuk script tambahan: halaman dapat menambahkan script
        menggunakan @push('scripts') dan akan dirender di sini
    --}}
        @stack('scripts')
    </body>

</html>
