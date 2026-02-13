{{-- 
    =============================================
    LAYOUT TAMU (GUEST) - HALAMAN AUTHENTIKASI
    =============================================

    File ini adalah layout dasar untuk seluruh halaman
    yang hanya bisa diakses oleh "tamu" (belum login), yaitu:
    - Halaman Login
    - Halaman Register
    - Halaman Lupa Password, Reset Password, Verifikasi Email, dll.

    Cara pakai:
    - Di view lain (misalnya auth/login.blade.php) gunakan:
        <x-guest-layout> ... konten form ... </x-guest-layout>
    - Konten di dalam <x-guest-layout> akan dimasukkan ke variabel $slot
      dan dirender di bagian kiri layout ini.

    Secara visual:
    - Kiri  : panel form sederhana di atas background terang.
    - Kanan : panel gelap berisi informasi / promosi produk.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
    {{-- Pengaturan dasar dokumen HTML --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Token CSRF Laravel untuk mengamankan form dan request --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul halaman mengambil nama aplikasi dari config --}}
        <title>{{ config('app.name', 'Laravel') }} - AnalisaPro</title>

    <!-- Fonts: menggunakan Inter sebagai font utama untuk halaman auth -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- Scripts: memuat bundel CSS & JS dari Vite (Tailwind, Alpine, dll.) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="font-sans antialiased bg-slate-50">
    {{-- 
        Wrapper utama:
        - min-h-screen : tinggi minimal 1 layar penuh.
        - flex        : membagi layar menjadi dua sisi (kiri & kanan).
    --}}
    <div class="min-h-screen flex">
        <!-- LEFT SIDE - PANEL FORM AUTH -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md">
                <!-- Logo aplikasi di pojok kiri atas layout auth -->
                <a href="/" class="flex items-center gap-3 mb-8">
                    <div
                        class="w-10 h-10 rounded-lg bg-slate-900 flex items-center justify-center text-white font-bold text-lg">
                        A
                    </div>
                    <span class="text-xl font-bold text-slate-900">AnalisaPro</span>
                </a>

                <!-- Content ($slot): diisi oleh form login/register dari view lain -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
            
        <!-- RIGHT SIDE - PANEL BRANDING / PROMO -->
        {{-- 
            Untuk memastikan panel kanan benar‑benar terlihat saat debug,
            sementara dibuat selalu tampil (tidak di-hidden di mobile).
            Jika sudah ok, kelas bisa dikembalikan menjadi `hidden lg:flex`.
        --}}
        <div class="flex w-full lg:w-1/2 bg-slate-900 relative overflow-hidden items-center justify-center p-12">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 32px 32px;">
                </div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-lg">
                <div class="mb-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-semibold text-white mb-6">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span>Analytics Platform</span>
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-4">
                        Welcome to AnalisaPro
                    </h2>
                    <p class="text-lg text-slate-300 leading-relaxed">
                        Transform your data into actionable insights with our powerful analytics dashboard.
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">10K+</div>
                        <div class="text-sm text-slate-400">Active Users</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">50M+</div>
                        <div class="text-sm text-slate-400">Data Points</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">99.9%</div>
                        <div class="text-sm text-slate-400">Uptime</div>
                </div>
            </div>
            
                <!-- Testimonial Card -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex items-center gap-1 mb-3">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-200 text-sm mb-4 leading-relaxed">
                        "AnalisaPro has transformed how we make data-driven decisions. The interface is intuitive and
                        powerful."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            SJ
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-white">Sarah Johnson</div>
                            <div class="text-xs text-slate-400">CEO, TechStart Inc</div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </body>

</html>
