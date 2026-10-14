@props(['icon', 'text'])

<div class="reveal reveal-soft flex min-h-[116px] flex-col items-center justify-center gap-4 rounded-[1.35rem] border border-[var(--soft-border)] bg-white px-4 py-6 text-center shadow-[0_10px_22px_rgba(36,30,26,0.08)]">
    <span class="text-[26px] leading-none" aria-hidden="true">{{ $icon }}</span>
    <span class="text-[13px] font-medium leading-snug text-[var(--foreground)]">{{ $text }}</span>
</div>
