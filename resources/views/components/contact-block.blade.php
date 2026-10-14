@props(['icon', 'title'])

<div class="reveal reveal-soft flex gap-4">
    <div class="mt-1 flex size-10 shrink-0 items-center justify-center rounded-full bg-[var(--cream)] text-[var(--gold)]">
        <i class="fa-solid {{ $icon }}" aria-hidden="true"></i>
    </div>
    <div>
        <p class="mb-2 text-sm font-semibold uppercase tracking-wide text-[var(--foreground)]/60">{{ $title }}</p>
        <div class="space-y-1">
            {{ $slot }}
        </div>
    </div>
</div>
