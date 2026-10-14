@props([
    'image',
    'imageAlt',
    'items',
    'reverse' => false,
])

<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-20">
    <x-image-card
        class="rounded-[1.75rem] {{ $reverse ? 'lg:order-2' : '' }}"
        :src="$image"
        :alt="$imageAlt"
        image-class="aspect-video lg:aspect-[1.05/1]"
    />

    <div class="{{ $reverse ? 'lg:order-1' : '' }}">
        <x-copy-stack :items="$items" />
    </div>
</div>
