@props(['kicker', 'title'])

<div class="reveal reveal-soft mb-16 text-center">
    <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-[var(--background)]/60 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--foreground)]/70 backdrop-blur-md">
        <span class="size-2 rounded-full bg-[var(--gold)]"></span>
        {{ $kicker }}
    </span>
    <h2 class="font-display text-4xl font-semibold leading-[1.05] tracking-tight text-[var(--foreground)] sm:text-5xl md:text-6xl">{{ $title }}</h2>
</div>
