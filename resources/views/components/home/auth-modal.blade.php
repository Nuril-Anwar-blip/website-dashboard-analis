{{-- 
    Komponen modal autentikasi untuk landing page.
    - Berisi dua modal:
        1) Login: form masuk sederhana (email + password + remember me).
        2) Register: form pendaftaran akun baru.
    - Dikontrol melalui fungsi JS:
        - showLogin(), showRegister() untuk membuka modal tertentu.
        - closeAuthModal() untuk menutup semua modal.
        - switchToRegister(), switchToLogin() untuk pindah antar modal.
    - Tombol pemicu utama berada pada komponen navbar & hero (onClick="showLogin()/showRegister()").
--}}
<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-100 to-yellow-50 rounded-full text-xs font-black text-yellow-700 mb-4 border border-yellow-200/50">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span>
                        <span>Selamat Datang Kembali</span>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">
                        Masuk ke <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Business</span>
                    </h2>
                    <p class="text-sm text-gray-500 font-semibold">Silakan masuk ke akun Anda untuk melanjutkan</p>
                </div>
                <button onclick="closeAuthModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-black text-gray-900">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" required autofocus value="{{ old('email') }}" placeholder="nama@email.com" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                    @error('email')
                        <p class="text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-black text-gray-900">Kata Sandi</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-gray-500 hover:text-purple-600 transition-colors">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" required placeholder="Masukkan kata sandi" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                    @error('password')
                        <p class="text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded-lg border-2 border-gray-300 bg-white text-purple-600 shadow-sm focus:ring-2 focus:ring-purple-500 w-5 h-5">
                    <label for="remember_me" class="ms-3 text-sm font-bold text-gray-600">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-xl font-black text-lg hover:from-purple-700 hover:to-indigo-700 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm font-bold text-gray-500">Belum punya akun? 
                    <button onclick="switchToRegister()" class="text-purple-600 font-black hover:underline">Daftar Akun Baru</button>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full mx-4 transform transition-all max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-50 rounded-full text-xs font-black text-green-700 mb-4 border border-green-200/50">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span>Bergabung Sekarang</span>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">
                        Buat Akun <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Baru</span>
                    </h2>
                    <p class="text-sm text-gray-500 font-semibold">Bergabunglah dengan platform analisis tercanggih</p>
                </div>
                <button onclick="closeAuthModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-black text-gray-900">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="name" required autofocus value="{{ old('name') }}" placeholder="Nuril Anwar" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                    @error('name')
                        <p class="text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-gray-900">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="nama@email.com" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                    @error('email')
                        <p class="text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-gray-900">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                    @error('password')
                        <p class="text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-gray-900">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3.5 pl-12 pr-5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all font-semibold">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-xl font-black text-lg hover:from-purple-700 hover:to-indigo-700 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm font-bold text-gray-500">Sudah punya akun? 
                    <button onclick="switchToLogin()" class="text-purple-600 font-black hover:underline">Masuk ke Akun Anda</button>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function showLogin() {
    document.getElementById('loginModal').classList.remove('hidden');
    document.getElementById('loginModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function showRegister() {
    document.getElementById('registerModal').classList.remove('hidden');
    document.getElementById('registerModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeAuthModal() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginModal').classList.remove('flex');
    document.getElementById('registerModal').classList.add('hidden');
    document.getElementById('registerModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function switchToRegister() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginModal').classList.remove('flex');
    document.getElementById('registerModal').classList.remove('hidden');
    document.getElementById('registerModal').classList.add('flex');
}

function switchToLogin() {
    document.getElementById('registerModal').classList.add('hidden');
    document.getElementById('registerModal').classList.remove('flex');
    document.getElementById('loginModal').classList.remove('hidden');
    document.getElementById('loginModal').classList.add('flex');
}

// Close on outside click
document.getElementById('loginModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeAuthModal();
});

document.getElementById('registerModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeAuthModal();
});
</script>

