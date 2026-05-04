@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-300 rounded-2xl premium-shadow hover:-translate-y-0.5';
    
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-slate-900 text-white hover:bg-slate-800',
        'outline' => 'border-2 border-slate-200 text-slate-700 hover:bg-slate-50',
        'ghost' => 'bg-transparent text-slate-600 hover:bg-slate-50 premium-shadow-none',
        'accent' => 'accent-gradient text-white hover:shadow-xl',
        'danger' => 'bg-rose-500 text-white hover:bg-rose-600',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-6 py-3 text-sm',
        'lg' => 'px-10 py-4 text-base',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
