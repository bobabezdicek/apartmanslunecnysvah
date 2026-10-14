@php
    $cookieLocale = app()->getLocale();
    $cookiesUrl = $cookieLocale === 'cs' && ! request()->routeIs('localized.*')
        ? route('cookies')
        : route('localized.cookies', ['locale' => $cookieLocale]);
@endphp

<form class="js-cookie-consent fixed inset-x-4 bottom-4 z-[60] mx-auto hidden max-w-4xl flex-col rounded-[1.5rem] border border-white/70 bg-[var(--cream-soft)]/95 p-4 text-[var(--foreground)] opacity-100 shadow-[0_24px_80px_rgba(36,30,26,0.18)] backdrop-blur transition duration-300 md:bottom-6 md:flex-row md:items-center md:gap-5 md:p-5" aria-label="{{ __('site.cookies.aria') }}">
    <div class="flex flex-1 gap-3">
        <span class="mt-1 flex size-10 shrink-0 items-center justify-center rounded-2xl bg-[var(--cream)] text-[var(--gold)]">
            <i class="fa-solid fa-cookie-bite" aria-hidden="true"></i>
        </span>
        <div>
            <p class="font-display text-lg font-semibold tracking-tight">{{ __('site.cookies.title') }}</p>
            <p class="mt-1 text-sm leading-relaxed text-[var(--muted-foreground)]">
                {{ __('site.cookies.text') }}
                {!! __('site.cookies.more', ['link' => '<a class="font-semibold text-[var(--foreground)] underline decoration-[var(--gold)] decoration-2 underline-offset-4" href="'.$cookiesUrl.'">Cookies</a>']) !!}
            </p>
        </div>
    </div>

    <div class="mt-4 flex shrink-0 flex-col gap-2 sm:flex-row md:mt-0">
        <button class="rounded-full border border-[var(--soft-border)] bg-white/70 px-5 py-3 text-sm font-semibold text-[var(--foreground)] transition-colors hover:border-[var(--gold)]" type="submit" data-cookie-choice="necessary">
            {{ __('site.cookies.reject') }}
        </button>
        <button class="rounded-full bg-[var(--foreground)] px-5 py-3 text-sm font-semibold text-[var(--background)] shadow-lg transition-colors hover:bg-[var(--forest)]" type="submit" data-cookie-choice="all">
            {{ __('site.cookies.accept') }}
        </button>
    </div>
</form>
