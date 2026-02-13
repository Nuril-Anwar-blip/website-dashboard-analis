@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-slate-300 focus:border-slate-900 focus:ring-slate-900 rounded-lg shadow-sm',
]) !!}>
