@props(['theme' => 'light'])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-900' : 'bg-gray-50';
    $borderClass = $theme === 'dark' ? 'border-gray-800' : 'border-gray-200';
    $textClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
    $textSecondaryClass = $theme === 'dark' ? 'text-gray-300' : 'text-gray-700';
    $inputBgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $inputBorderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
@endphp

<div class="h-20 {{ $bgClass }} flex items-center justify-between px-8 border-b {{ $borderClass }}">
    <div class="flex items-center gap-6">
        <h1 class="text-3xl font-bold {{ $textClass }}">Analytics</h1>
        <div class="flex items-center gap-2 px-4 py-2 {{ $inputBgClass }} rounded-lg border {{ $inputBorderClass }} text-sm {{ $textSecondaryClass }}">
            <span>01.08.2022 - 31.08.2022</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <!-- Theme Toggle -->
        <button id="themeToggle" onclick="toggleTheme()" class="p-2 rounded-lg {{ $inputBgClass }} border {{ $inputBorderClass }} {{ $theme === 'dark' ? 'hover:bg-gray-700' : 'hover:bg-gray-50' }} transition-colors">
            <svg id="sunIcon" class="w-5 h-5 text-yellow-500 {{ $theme === 'dark' ? 'hidden' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
            </svg>
            <svg id="moonIcon" class="w-5 h-5 text-blue-400 {{ $theme === 'dark' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
        </button>

        <!-- User Profile -->
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366F1&color=fff&size=40" class="w-10 h-10 rounded-lg object-cover">
            <span class="text-sm font-semibold {{ $textClass }}">{{ auth()->user()->name }}</span>
        </div>
    </div>
</div>

<script>
function toggleTheme() {
    const currentTheme = '{{ $theme }}';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    window.location.href = '{{ route("dashboard") }}?theme=' + newTheme;
}

// Load saved theme
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || '{{ $theme }}';
    if (savedTheme !== '{{ $theme }}') {
        window.location.href = '{{ route("dashboard") }}?theme=' + savedTheme;
    }
});
</script>

