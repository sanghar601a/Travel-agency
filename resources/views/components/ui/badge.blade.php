@props([
    'variant' => 'info',
])

@php
    $baseClasses = 'px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider';
    
    $variants = [
        'info' => 'bg-blue-50 text-blue-600',
        'success' => 'bg-emerald-50 text-emerald-600',
        'warning' => 'bg-amber-50 text-amber-600',
        'danger' => 'bg-rose-50 text-rose-600',
        'neutral' => 'bg-slate-100 text-slate-500',
        'indigo' => 'bg-indigo-50 text-indigo-600',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['info']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
