{{-- 
    =============================================
    HALAMAN REGISTER / DAFTAR
    =============================================
    
    Deskripsi:
    Halaman untuk user baru untuk membuat akun baru di sistem.
    Menggunakan layout guest dengan desain modern, gradient, dan responsif.
    
    Fitur:
    - Form registrasi dengan nama, email, password, dan konfirmasi password
    - Icon di setiap input field untuk UX yang lebih baik
    - Validasi form dengan error messages
    - Link ke halaman login untuk user yang sudah punya akun
    - Desain dengan gradient dan animasi untuk menarik perhatian
    
    Responsivitas:
    - Mobile: Form full width dengan padding yang disesuaikan
    - Desktop: Form dengan max-width untuk readability
    - Input fields responsif dengan ukuran font yang menyesuaikan
    - Button dengan efek hover dan transform
    - Badge "Bergabung Sekarang" responsif
--}}
<x-guest-layout>
    {{-- Header dengan badge dan judul --}}
    <div class="mb-6 sm:mb-8 lg:mb-10">
        <div
            class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-gradient-to-r from-green-100 to-emerald-50 rounded-full text-xs sm:text-sm font-black text-green-700 mb-4 sm:mb-6 border border-green-200/50 shadow-md">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span>Bergabung Sekarang</span>
        </div>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-[#1B254B] mb-2 sm:mb-3 tracking-tight leading-tight">
            Buat Akun <span
                class="bg-gradient-to-r from-[#FFCB42] to-[#FFD970] bg-clip-text text-transparent">Baru</span>
        </h2>
        <p class="text-xs sm:text-sm lg:text-base text-gray-500 font-semibold">Bergabunglah dengan platform analisis survey
            tercanggih</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-slate-800 text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="name"
                    class="block w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-10 sm:pl-12 pr-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-medium text-sm sm:text-base"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Nuril Anwar" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Alamat Email')" class="font-bold text-slate-800 text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <x-text-input id="email"
                    class="block w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-10 sm:pl-12 pr-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-medium text-sm sm:text-base"
                    type="email" name="email" :value="old('email')" required autocomplete="username"
                    placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Kata Sandi')" class="font-bold text-slate-800 text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password"
                    class="block w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-10 sm:pl-12 pr-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-medium text-sm sm:text-base"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')"
                class="font-bold text-slate-800 text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation"
                    class="block w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-10 sm:pl-12 pr-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-medium text-sm sm:text-base"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Ulangi kata sandi" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-primary-600 text-white py-3.5 rounded-xl font-bold text-sm sm:text-base hover:bg-primary-700 transition-all shadow-lg shadow-primary-200 flex items-center justify-center gap-3 group">
                {{ __('Daftar Sekarang') }}
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>

    {{-- Link ke Login --}}
    <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-sm font-medium text-slate-500">Sudah punya akun?
            <a href="{{ route('login') }}"
                class="text-primary-600 font-bold border-b-2 border-primary-500 hover:bg-primary-50 transition-all px-1 ml-1 inline-block">Masuk ke Akun Anda</a>
        </p>
    </div>
</x-guest-layout>
