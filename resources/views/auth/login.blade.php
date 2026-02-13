{{-- 
    =============================================
    HALAMAN LOGIN / MASUK
    =============================================
    
    Deskripsi:
    Halaman untuk user yang sudah memiliki akun untuk masuk ke sistem.
    Menggunakan layout guest dengan desain modern dan responsif.
    
    Fitur:
    - Form login dengan email dan password
    - Checkbox "Remember me" untuk tetap login
    - Link "Forgot Password" untuk reset password
    - Link ke halaman register untuk user baru
    - Tombol social login (Google, GitHub, Facebook) - placeholder
    - Validasi form dengan error messages
    
    Responsivitas:
    - Mobile: Form full width dengan padding yang disesuaikan
    - Desktop: Form dengan max-width untuk readability
    - Input dan button responsif dengan ukuran font yang menyesuaikan
    - Social login buttons stack di mobile, inline di desktop
--}}
<x-guest-layout>
    {{-- Header --}}
    <div class="mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-1">Sign in</h1>
        <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label for="email" value="Email Address" class="text-xs sm:text-sm font-medium text-gray-700" />
            <x-text-input id="email" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus
                          autocomplete="username"
                          class="block w-full rounded-xl border border-gray-200 px-3.5 py-2.5 sm:py-3 text-sm sm:text-base text-gray-900 placeholder-gray-400 focus:border-black focus:ring-black bg-white"
                          placeholder="johndoe@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label for="password" value="Password" class="text-xs sm:text-sm font-medium text-gray-700" />
            <x-text-input id="password" 
                                type="password"
                                name="password"
                          required 
                          autocomplete="current-password"
                          class="block w-full rounded-xl border border-gray-200 px-3.5 py-2.5 sm:py-3 text-sm sm:text-base text-gray-900 placeholder-gray-400 focus:border-black focus:ring-black bg-white"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="rounded border-gray-300 text-black focus:ring-black">
                <span class="text-xs sm:text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-900">
                    Forgot Password?
                </a>
            @endif
        </div>

        <!-- Primary button -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full rounded-xl bg-primary-600 text-white text-sm sm:text-base font-medium py-3 sm:py-3.5 shadow-sm hover:bg-primary-700 transition-colors">
                Sign in
            </button>
        </div>
    </form>
    
    <!-- Bottom text + social logins -->
    <div class="mt-6 sm:mt-8 space-y-4">

        <div class="text-xs sm:text-sm text-gray-400 text-center">Or continue with</div>

        <div class="flex items-center justify-center sm:justify-start gap-3 sm:gap-4">
            <button type="button"
                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-colors">
                <span class="text-base sm:text-lg">G</span>
            </button>
            <button type="button"
                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-colors">
                <span class="text-xs sm:text-sm font-semibold">GH</span>
            </button>
            <button type="button"
                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-colors">
                <span class="text-base sm:text-lg">f</span>
            </button>
        </div>
    </div>
</x-guest-layout>
