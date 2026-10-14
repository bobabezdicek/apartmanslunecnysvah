@props([
    'href',
    'variant' => 'dark',
    'icon' => null,
])

@php
    $classes = [
        'dark' => 'bg-[#201915] text-[#fffaf2]',
        'light' => 'bg-[#fffaf2] text-[#201915]',
        'ghost' => 'bg-[#fffaf2]/20 text-[#fffaf2]',
    ][$variant] ?? 'bg-[#201915] text-[#fffaf2]';
@endphp

<a {{ $attributes->merge(['class' => 'inline-flex min-h-11 items-center justify-center rounded-full px-5 py-3 text-sm font-extrabold ' . $classes, 'href' => $href]) }}>
    @if ($icon)
        <i class="fa-solid {{ $icon }} mr-2 text-[0.95em]" aria-hidden="true"></i>
    @endif
    {{ $slot }}
</a>
