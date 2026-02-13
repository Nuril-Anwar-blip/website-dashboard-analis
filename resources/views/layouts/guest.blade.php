{{-- 
    Layout khusus halaman tamu (guest), seperti:
    - Login
    - Register
    - Lupa password, reset password, verifikasi email

    Ciri utama:
    - Latar belakang dekoratif dengan gradien dan partikel animasi.
    - Card auth transparan (glassmorphism) yang berisi konten dari $slot.
    - Dipakai melalui komponen <x-guest-layout>.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Token CSRF Laravel untuk mengamankan form dan request --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - AnalisaPro</title>

        <!-- Fonts: menggunakan Plus Jakarta Sans sebagai font utama untuk halaman auth -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts: memuat bundel CSS & JS dari Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- 
            Style khusus untuk tampilan halaman auth:
            - .auth-card : efek glassmorphism pada kartu login/register.
            - .bg-pattern : pola titik animasi di background.
            - .animate-float, .gradient-bg, .shimmer, .glow-effect, .particle : 
              efek animasi dan pencahayaan untuk elemen dekoratif.
        --}}
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .auth-card { 
                background: rgba(255, 255, 255, 0.98); 
                backdrop-filter: blur(30px); 
                -webkit-backdrop-filter: blur(30px);
                border: 2px solid rgba(255, 255, 255, 0.9);
                box-shadow: 0 20px 60px rgba(27, 37, 75, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.5);
            }
            .bg-pattern { 
                background-image: radial-gradient(circle, #FFCB42 1.5px, transparent 1.5px); 
                background-size: 50px 50px; 
                opacity: 0.12;
                animation: pattern-move 25s linear infinite;
            }
            @keyframes pattern-move {
                0% { background-position: 0 0; }
                100% { background-position: 50px 50px; }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-15px) rotate(2deg); }
                66% { transform: translateY(-25px) rotate(-2deg); }
            }
            .animate-float { animation: float 6s ease-in-out infinite; }
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .shimmer {
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
                background-size: 200% 100%;
                animation: shimmer 3s infinite;
            }
            @keyframes shimmer {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            .glow-effect {
                box-shadow: 0 0 20px rgba(255, 203, 66, 0.4), 0 0 40px rgba(255, 203, 66, 0.2);
            }
            .glow-effect:hover {
                box-shadow: 0 0 30px rgba(255, 203, 66, 0.6), 0 0 60px rgba(255, 203, 66, 0.4);
            }
            .particle {
                position: absolute;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255, 203, 66, 0.5), transparent);
                animation: particle-float 10s ease-in-out infinite;
            }
            @keyframes particle-float {
                0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
                50% { transform: translate(30px, -40px) scale(1.3); opacity: 1; }
            }
        </style>
    </head>
    <body class="antialiased bg-[#F4F4F5] text-[#111827] overflow-x-hidden">
        {{-- 
            Struktur utama mengikuti inspirasi desain:
            - Kiri: panel form sign-in di atas background terang.
            - Kanan: panel promosi/branding gelap dengan konten marketing.
        --}}
        <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-10 py-10">
            <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-[1.1fr,1.4fr] gap-10">
                {{-- Panel kiri: logo + form (konten dari $slot) --}}
                <div class="flex flex-col justify-center">
                    <a href="/" class="flex items-center gap-3 mb-10">
                        <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white font-bold">
                            A
                        </div>
                        <span class="text-lg font-semibold tracking-tight">AnalisaPro</span>
                    </a>

                    <div class="max-w-md">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Panel kanan: kartu promosi gelap --}}
                <div class="hidden lg:flex items-center">
                    <div class="relative w-full h-full bg-[#050509] rounded-[32px] text-white overflow-hidden p-10 flex flex-col justify-between shadow-2xl">
                        {{-- Logo besar / ilustrasi di bagian atas --}}
                        <div class="absolute inset-0 opacity-40 pointer-events-none">
                            <div class="w-[320px] h-[320px] rounded-[48px] border border-white/10 mx-auto mt-10 rotate-6 bg-gradient-to-br from-white/10 via-white/5 to-transparent"></div>
                        </div>

                        <div class="relative z-10">
                            <p class="text-xs font-semibold text-gray-400 mb-2">AnalisaPro</p>
                            <h2 class="text-2xl font-bold mb-3">Welcome to AnalisaPro</h2>
                            <p class="text-sm text-gray-400 max-w-md">
                                AnalisaPro membantu Anda membangun dashboard yang rapi, modern, dan mudah dibaca
                                untuk memantau performa bisnis secara real-time.
                            </p>
                            <p class="text-xs text-gray-500 mt-4">
                                Lebih dari 10K pengguna sudah mempercayakan analitik bisnisnya di sini.
                            </p>
                        </div>

                        <div class="relative z-10 mt-10">
                            <div class="bg-[#111118] rounded-3xl p-6 max-w-md">
                                <p class="text-sm font-semibold mb-2">
                                    Dapatkan insight yang tepat, ambil keputusan lebih cepat.
                                </p>
                                <p class="text-xs text-gray-400 mb-4">
                                    Jadilah bagian dari tim yang mengandalkan data untuk menggerakkan strategi bisnis.
                                </p>
                                <div class="flex items-center gap-3">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-[#111118]"></div>
                                        <div class="w-8 h-8 rounded-full bg-gray-500 border-2 border-[#111118]"></div>
                                        <div class="w-8 h-8 rounded-full bg-gray-700 border-2 border-[#111118] flex items-center justify-center text-xs font-bold">
                                            +2
                                        </div>
                                    </div>
                                    <span class="text-[11px] text-gray-400">
                                        Tim lain sudah bergabung, sekarang giliran Anda.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
