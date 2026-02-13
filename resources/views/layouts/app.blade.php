{{-- 
    Layout utama aplikasi (authenticated area).
    - Mewrap seluruh halaman yang menggunakan komponen <x-app-layout>.
    - Mengatur:
        - Tag <head> dasar (meta, title, font, CSRF).
        - Load asset CSS & JS via Vite.
        - Slot konten utama ($slot) yang diisi oleh tiap halaman.
        - Stack @push('scripts') untuk menambahkan script khusus per halaman.
    - Beberapa utilitas CSS tambahan disimpan di sini (custom scrollbar, animasi, efek glow).
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Token CSRF Laravel untuk proteksi form & request AJAX --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts: font utama Figtree yang digunakan di seluruh aplikasi -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles bundling via Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- 
            $slot diisi oleh konten halaman yang menggunakan <x-app-layout>.
            Stack "scripts" digunakan oleh halaman untuk menambahkan JS tambahan (mis. Chart.js di dashboard).
        --}}
        {{ $slot }}
        @stack('scripts')
        {{-- 
            Utilitas CSS global tambahan:
            - custom-scrollbar: styling scrollbar untuk area dengan overflow.
            - animate-float & animate-shimmer: efek animasi halus untuk elemen dekoratif.
            - glow-effect: efek glow pada card / tombol penting.
        --}}
        <style>
            .custom-scrollbar::-webkit-scrollbar { width: 6px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #4B5563; border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #6B7280; }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-15px) rotate(2deg); }
                66% { transform: translateY(-25px) rotate(-2deg); }
            }
            .animate-float { animation: float 6s ease-in-out infinite; }
            @keyframes shimmer {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            .animate-shimmer {
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                background-size: 200% 100%;
                animation: shimmer 2s infinite;
            }
            .glow-effect {
                box-shadow: 0 0 20px rgba(255, 203, 66, 0.3), 0 0 40px rgba(255, 203, 66, 0.2);
            }
            .glow-effect:hover {
                box-shadow: 0 0 30px rgba(255, 203, 66, 0.5), 0 0 60px rgba(255, 203, 66, 0.3);
            }
        </style>
    </body>
</html>
