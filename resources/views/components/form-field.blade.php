@props([
    'label',
    'name',
    'type' => 'text',
    'textarea' => false,
])

@php($hasError = $errors->has($name))

<label class="block">
    <span class="mb-2 block text-[12px] font-semibold text-[var(--foreground)]/70">{{ $label }}</span>
    @if ($textarea)
        <textarea
            class="min-h-[150px] w-full resize-none rounded-2xl border bg-white/70 px-4 py-3 text-[var(--foreground)] outline-none transition-colors focus:border-[var(--gold)] {{ $hasError ? 'border-red-400' : 'border-[var(--soft-border)]' }}"
            name="{{ $name }}"
            rows="5"
        >{{ old($name) }}</textarea>
    @else
        <input
            class="h-12 w-full rounded-full border bg-white/70 px-4 text-[var(--foreground)] outline-none transition-colors focus:border-[var(--gold)] {{ $hasError ? 'border-red-400' : 'border-[var(--soft-border)]' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name) }}"
        >
    @endif

    <span class="{{ $hasError ? '' : 'hidden' }} mt-2 block text-xs font-medium text-red-600" data-error-for="{{ $name }}">{{ $hasError ? $errors->first($name) : '' }}</span>
</label>
