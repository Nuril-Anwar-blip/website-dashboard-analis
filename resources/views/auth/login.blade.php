<x-guest-layout>
    {{-- Header sederhana seperti di desain: judul Sign in --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 mb-1">Sign in</h1>
        <p class="text-sm text-gray-500">Enter your credentials to access your dashboard.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label for="email" value="Email Address" class="text-xs font-medium text-gray-700" />
            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                class="block w-full rounded-xl border border-gray-200 px-3.5 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-black focus:ring-black bg-white"
                placeholder="johndoe@gmail.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label for="password" value="Password" class="text-xs font-medium text-gray-700" />
            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="block w-full rounded-xl border border-gray-200 px-3.5 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-black focus:ring-black bg-white"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-black focus:ring-black">
                <span class="text-xs text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-500 hover:text-gray-900">
                    Forgot Password?
                </a>
            @endif
        </div>

        <!-- Primary button -->
        <div class="pt-2">
            <button
                type="submit"
                class="w-full rounded-xl bg-black text-white text-sm font-medium py-3 shadow-sm hover:bg-gray-900 transition-colors"
            >
                Sign in
            </button>
        </div>
    </form>

    <!-- Bottom text + social logins -->
    <div class="mt-6 space-y-4">
        <div class="flex items-center justify-between text-xs text-gray-500">
            <span>Don’t have an account?
                <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:underline">Sign up</a>
            </span>
        </div>

        <div class="text-xs text-gray-400 text-center">Or continue with</div>

        <div class="flex items-center justify-start gap-4">
            <button type="button" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50">
                <span class="text-lg">G</span>
            </button>
            <button type="button" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50">
                <span class="text-lg">GH</span>
            </button>
            <button type="button" class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50">
                <span class="text-lg">f</span>
            </button>
        </div>
    </div>
</x-guest-layout>
