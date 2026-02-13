{{-- 
    Komponen navbar untuk halaman landing.
    - Menampilkan logo, menu navigasi ke section halaman (Features, About, Contact).
    - Menyediakan tombol Login dan Get Started yang memicu modal autentikasi (lihat x-home.auth-modal).
    - Dipakai di: welcome.blade.php lewat <x-home.navbar />.
--}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg">
                    X
                </div>
                <span class="text-2xl font-black text-gray-900">Business</span>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Features</a>
                <a href="#about" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">About</a>
                <a href="#contact" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Contact</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                <button onclick="showLogin()" class="hidden md:block px-6 py-2.5 text-gray-700 font-semibold hover:text-purple-600 transition-colors">
                    Login
                </button>
                <button onclick="showRegister()" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Get Started
                </button>
            </div>
        </div>
    </div>
</nav>

