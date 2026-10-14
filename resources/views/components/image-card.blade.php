@props([
    'src',
    'alt',
    'imageClass' => 'aspect-[1/0.92]',
])

<figure {{ $attributes->merge(['class' => 'reveal reveal-zoom overflow-hidden rounded-xl shadow-[0_24px_70px_rgb(57_43_28_/_0.16)]']) }}>
    <img class="h-full w-full object-cover {{ $imageClass }}" src="{{ $src }}" alt="{{ $alt }}">
</figure>
