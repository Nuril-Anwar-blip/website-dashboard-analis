<x-guest-layout>
    <div class="mb-8 sm:mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-50 rounded-full text-xs font-black text-green-700 mb-6 border border-green-200/50 shadow-md">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span>Bergabung Sekarang</span>
        </div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#1B254B] mb-3 tracking-tight leading-tight">
            Buat Akun <span class="bg-gradient-to-r from-[#FFCB42] to-[#FFD970] bg-clip-text text-transparent">Baru</span>
        </h2>
        <p class="text-sm sm:text-base text-gray-500 font-semibold">Bergabunglah dengan platform analisis survey tercanggih</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-black text-[#1B254B] text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="name" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-2xl py-3.5 sm:py-4 pl-12 pr-5 focus:ring-2 focus:ring-[#FFCB42] focus:border-[#FFCB42] transition-all font-semibold text-sm sm:text-base" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nuril Anwar" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Alamat Email')" class="font-black text-[#1B254B] text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-2xl py-3.5 sm:py-4 pl-12 pr-5 focus:ring-2 focus:ring-[#FFCB42] focus:border-[#FFCB42] transition-all font-semibold text-sm sm:text-base" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Kata Sandi')" class="font-black text-[#1B254B] text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-2xl py-3.5 sm:py-4 pl-12 pr-5 focus:ring-2 focus:ring-[#FFCB42] focus:border-[#FFCB42] transition-all font-semibold text-sm sm:text-base"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="font-black text-[#1B254B] text-sm sm:text-base" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full bg-gray-50 border-2 border-gray-200 rounded-2xl py-3.5 sm:py-4 pl-12 pr-5 focus:ring-2 focus:ring-[#FFCB42] focus:border-[#FFCB42] transition-all font-semibold text-sm sm:text-base"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-600" />
        </div>

        <div class="pt-4">
            <button type="submit" class="relative w-full bg-gradient-to-r from-[#1B254B] via-[#2A355F] to-[#1B254B] text-white py-4 sm:py-5 rounded-2xl font-black text-base sm:text-lg hover:from-[#2A355F] hover:via-[#3B4D8F] hover:to-[#2A355F] transition-all transform hover:-translate-y-1 hover:scale-[1.02] shadow-2xl shadow-indigo-300/60 flex items-center justify-center gap-3 overflow-hidden group glow-effect">
                <span class="absolute inset-0 shimmer opacity-30"></span>
                <span class="relative z-10 flex items-center gap-3">
                    {{ __('Daftar Sekarang') }}
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                </span>
            </button>
        </div>
    </form>
    
    <div class="mt-8 sm:mt-10 pt-6 sm:pt-8 border-t-2 border-gray-100 text-center">
        <p class="text-sm sm:text-base font-bold text-gray-500">Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-[#1B254B] font-black border-b-2 border-[#FFCB42] hover:bg-yellow-50 transition-all px-2 pb-1 ml-1 inline-block">Masuk ke Akun Anda</a>
        </p>
    </div>
</x-guest-layout>
