@props(['items'])

<div class="grid gap-6">
    @foreach ($items as $item)
        <article class="reveal reveal-soft">
            <h3 class="font-display text-2xl font-semibold tracking-tight text-[var(--foreground)] sm:text-3xl">{{ $item['title'] }}</h3>
            <p class="mt-3 text-[15px] leading-relaxed text-[var(--muted-foreground)]">{{ $item['text'] }}</p>
        </article>
    @endforeach
</div>
