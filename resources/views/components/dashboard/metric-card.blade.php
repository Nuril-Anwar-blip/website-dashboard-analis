@props(['title', 'value', 'change' => null, 'icon', 'theme' => 'light', 'chart' => null])

@php
    $bgClass = $theme === 'dark' ? 'bg-gray-800' : 'bg-white';
    $borderClass = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
    $iconBgClass = $theme === 'dark' ? 'bg-gray-700' : 'bg-gray-100';
    $textSecondaryClass = $theme === 'dark' ? 'text-gray-400' : 'text-gray-600';
    $textPrimaryClass = $theme === 'dark' ? 'text-white' : 'text-gray-900';
@endphp

<div class="{{ $bgClass }} rounded-xl p-6 shadow-sm border {{ $borderClass }}">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 {{ $iconBgClass }} rounded-lg flex items-center justify-center">
                {!! $icon !!}
            </div>
            <div>
                <h3 class="text-sm font-semibold {{ $textSecondaryClass }}">{{ $title }}</h3>
                <p class="text-2xl font-bold {{ $textPrimaryClass }} mt-1">{{ $value }}</p>
            </div>
        </div>
    </div>
    
    @if($change)
        <div class="flex items-center gap-1 text-sm">
            <span class="font-semibold {{ str_contains($change, '↑') ? 'text-green-600' : 'text-red-600' }}">
                {{ $change }}
            </span>
            <span class="{{ $textSecondaryClass }}">since last month</span>
        </div>
    @endif
    
    @if($chart)
        <div class="mt-4">
            {!! $chart !!}
        </div>
    @endif
</div>

