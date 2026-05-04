@props([
    'padding' => 'p-8',
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-[2.5rem] premium-shadow border border-slate-50 overflow-hidden ' . $padding]) }}>
    {{ $slot }}
</div>
