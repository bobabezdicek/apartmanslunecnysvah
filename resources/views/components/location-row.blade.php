@props([
    'image',
    'imageAlt',
    'title',
    'note' => null,
    'reverse' => false,
])

<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-20 {{ $reverse ? 'lg:[&>div:first-child]:order-2' : '' }}">
    @if (! $reverse)
        <x-image-card class="rounded-[1.75rem]" :src="$image" :alt="$imageAlt" image-class="aspect-video lg:aspect-[1.18/1]" />
    @endif

    <article class="reveal {{ $reverse ? 'reveal-left' : 'reveal-right' }}">
        <h3 class="font-display text-3xl font-semibold tracking-tight text-[var(--foreground)] sm:text-4xl">{{ $title }}</h3>
        <p class="mt-5 text-[15px] leading-relaxed text-[var(--muted-foreground)]">{{ $slot }}</p>

{{--        @if ($note)--}}
{{--            <div class="mt-6 flex items-center gap-3 rounded-2xl border border-[var(--soft-border)] bg-[var(--cream)]/70 p-4">--}}
{{--                <span class="flex size-6 shrink-0 items-center justify-center text-xl leading-none" aria-hidden="true">⭐</span>--}}
{{--                <p class="text-sm leading-relaxed text-[var(--foreground)]">--}}
{{--                {{ $note }}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        @endif--}}
    </article>

    @if ($reverse)
        <x-image-card class="rounded-[1.75rem]" :src="$image" :alt="$imageAlt" image-class="aspect-video lg:aspect-[1.18/1]" />
    @endif
</div>
