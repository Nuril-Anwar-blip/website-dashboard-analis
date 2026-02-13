{{-- 
    Halaman landing / home publik.
    - Menyusun tampilan utama website marketing (navbar, hero, fitur, modal auth, footer).
    - Mendukung dua mode:
        1) Mode penuh (default): semua section tampil dengan animasi muncul satu per satu.
        2) Mode "preview part": hanya satu section yang dirender, ditentukan lewat query ?part=...
    - Dipakai saat ingin melihat atau menguji setiap komponen landing page secara terpisah.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Analytics - Powerful Dashboard Platform</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- 
        Style khusus halaman welcome.
        Tailwind tetap datang dari Vite, tetapi di sini ada:
        - Font default
        - Animasi fade + slide untuk efek muncul satu per satu pada setiap komponen
    --}}
    <style>
        body { font-family: 'Figtree', sans-serif; }
        
        /* Animation untuk komponen yang muncul satu per satu */
        .component-fade {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .component-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Delay untuk setiap komponen */
        .component-fade:nth-child(1) { transition-delay: 0s; }
        .component-fade:nth-child(2) { transition-delay: 0.2s; }
        .component-fade:nth-child(3) { transition-delay: 0.4s; }
        .component-fade:nth-child(4) { transition-delay: 0.6s; }
        .component-fade:nth-child(5) { transition-delay: 0.8s; }
    </style>
</head>
<body class="antialiased">
    {{-- 
        Jika variabel $part terisi (dikirim dari route):
        - Hanya komponen yang cocok dengan nilai $part yang dirender.
        - Cocok untuk keperluan preview 1 komponen saja.
    --}}
    @if (!empty($part))
        {{-- MODE: Tampilkan hanya satu part sesuai parameter --}}
        @if ($part === 'navbar')
            <x-home.navbar />
        @elseif ($part === 'hero')
            <x-home.hero />
        @elseif ($part === 'features')
            <x-home.features />
        @elseif ($part === 'auth')
            <x-home.auth-modal />
        @elseif ($part === 'footer')
            <x-home.footer />
        @else
            {{-- Jika part tidak dikenal, tetap tampilkan semua --}}
            <!-- Navbar -->
            <div class="component-fade" id="component-1">
                <x-home.navbar />
            </div>
            
            <!-- Hero Section -->
            <div class="component-fade" id="component-2">
                <x-home.hero />
            </div>
            
            <!-- Features Section -->
            <div class="component-fade" id="component-3">
                <x-home.features />
            </div>
            
            <!-- Auth Modals -->
            <div class="component-fade" id="component-4">
                <x-home.auth-modal />
            </div>
            
            <!-- Footer -->
            <div class="component-fade" id="component-5">
                <x-home.footer />
            </div>
        @endif
    @else
        {{-- 
            MODE: Default, tampilkan semua section dengan animasi.
            - Setiap komponen dibungkus div .component-fade agar bisa dianimasikan lewat JS di bawah.
        --}}
        <!-- Navbar -->
        <div class="component-fade" id="component-1">
            <x-home.navbar />
        </div>
        
        <!-- Hero Section -->
        <div class="component-fade" id="component-2">
            <x-home.hero />
        </div>
        
        <!-- Features Section -->
        <div class="component-fade" id="component-3">
            <x-home.features />
        </div>
        
        <!-- Auth Modals -->
        <div class="component-fade" id="component-4">
            <x-home.auth-modal />
        </div>
        
        <!-- Footer -->
        <div class="component-fade" id="component-5">
            <x-home.footer />
        </div>
    @endif
    
    {{-- 
        Script front-end ringan:
        - Fungsi revealComponents: menambahkan class .visible ke setiap .component-fade dengan jeda,
          sehingga komponen muncul berurutan (seperti timeline).
        - IntersectionObserver disediakan sebagai opsi jika nanti ingin mengaktifkan animasi saat scroll.
    --}}
    <script>
        // Fungsi untuk menampilkan komponen satu per satu
        function revealComponents() {
            const components = document.querySelectorAll('.component-fade');
            let delay = 0;
            
            components.forEach((component, index) => {
                setTimeout(() => {
                    component.classList.add('visible');
                }, delay);
                delay += 300; // Delay 300ms antara setiap komponen
            });
        }
        
        // Jalankan animasi saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            revealComponents();
        });
        
        // Atau jika ingin menggunakan Intersection Observer untuk animasi saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Opsional: Gunakan Intersection Observer untuk animasi saat scroll
        // document.querySelectorAll('.component-fade').forEach(component => {
        //     observer.observe(component);
        // });
    </script>
</body>
</html>
