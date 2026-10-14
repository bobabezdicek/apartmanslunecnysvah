@props([
    'initialSrc',
    'initialAlt',
])

<div
    class="js-gallery-lightbox fixed inset-0 z-[100] hidden bg-black/90 px-4 py-5 text-white backdrop-blur-sm sm:px-8"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('site.gallery.dialog_label') }}"
>
    <button class="js-gallery-close absolute right-4 top-4 z-10 grid size-11 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition-colors hover:bg-white/20 sm:right-8 sm:top-8" type="button" aria-label="{{ __('site.gallery.close') }}">
        <i class="fa-solid fa-xmark text-xl" aria-hidden="true"></i>
    </button>

    <button class="js-gallery-prev absolute left-3 top-1/2 z-10 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition-colors hover:bg-white/20 sm:left-8 sm:size-12" type="button" aria-label="{{ __('site.gallery.prev') }}">
        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
    </button>

    <button class="js-gallery-next absolute right-3 top-1/2 z-10 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white backdrop-blur transition-colors hover:bg-white/20 sm:right-8 sm:size-12" type="button" aria-label="{{ __('site.gallery.next') }}">
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
    </button>

    <div class="js-gallery-backdrop flex min-h-full items-center justify-center">
        <figure class="mx-auto grid max-h-full w-full max-w-6xl gap-4">
            <img class="js-gallery-image mx-auto max-h-[78vh] max-w-full rounded-2xl object-contain shadow-[0_24px_80px_rgba(0,0,0,0.45)]" src="{{ $initialSrc }}" alt="{{ $initialAlt }}">
        </figure>
    </div>
</div>
