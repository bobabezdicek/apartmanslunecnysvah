@props(['src', 'alt'])

<button
    {{ $attributes->merge([
        'class' => 'js-gallery-item reveal reveal-zoom group relative h-[280px] w-full overflow-hidden rounded-[1.75rem] text-left shadow-[0_20px_60px_rgba(36,30,26,0.12)] outline-none ring-[var(--gold)] transition-transform focus-visible:ring-2 lg:h-full',
        'type' => 'button',
        'data-full-src' => $src,
        'data-alt' => $alt,
        'aria-label' => __('site.gallery.open_photo', ['alt' => $alt]),
    ]) }}
>
    <img class="size-full object-cover transition duration-500 group-hover:scale-105" src="{{ $src }}" alt="{{ $alt }}">
    <span class="pointer-events-none absolute inset-0 bg-black/0 transition-colors group-hover:bg-black/15"></span>
    <span class="pointer-events-none absolute bottom-4 right-4 grid size-10 place-items-center rounded-full bg-white/85 text-[var(--foreground)] opacity-0 shadow-lg backdrop-blur transition-opacity group-hover:opacity-100">
        <i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i>
    </span>
</button>
