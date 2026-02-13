@props(['title', 'amount', 'period', 'change', 'icon', 'theme' => 'light'])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $borderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $textSecondaryClass = $theme === 'dark' ? 'text-gray-400' : 'text-gray-600';
    $textPrimaryClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
    $iconBgClass = $theme === 'dark' ? 'bg-gray-700' : 'bg-gray-100';
    $changeBgClass = str_contains($change, '+') 
        ? ($theme === 'dark' ? 'bg-green-900/30 text-green-400' : 'bg-green-100 text-green-800')
        : ($theme === 'dark' ? 'bg-purple-900/30 text-purple-400' : 'bg-purple-100 text-purple-800');
@endphp

<div class="{{ $bgClass }} rounded-xl p-6 shadow-sm border {{ $borderClass }}">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-sm font-semibold {{ $textSecondaryClass }} mb-1">{{ $title }}</h3>
            <p class="text-2xl font-bold {{ $textPrimaryClass }}">{{ $amount }}</p>
            <p class="text-xs {{ $textSecondaryClass }} mt-1">{{ $period }}</p>
        </div>
        <div class="w-12 h-12 {{ $iconBgClass }} rounded-lg flex items-center justify-center">
            {!! $icon !!}
        </div>
    </div>
    <div class="flex items-center gap-2">
        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $changeBgClass }}">
            {{ $change }}
        </span>
    </div>
</div>

