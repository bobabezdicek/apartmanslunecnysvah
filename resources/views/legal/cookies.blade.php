@php
    $currentLocale = app()->getLocale();
    $homeUrl = $currentLocale === 'cs' && ! request()->routeIs('localized.*')
        ? route('home')
        : route('localized.home', ['locale' => $currentLocale]);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ __('site.cookies_page.meta_description') }}">

        <title>{{ __('site.cookies_page.title') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden bg-[var(--background)] font-sans text-[var(--foreground)] antialiased">
        <main class="px-4 py-10 sm:px-6 lg:py-16">
            <div class="mx-auto max-w-4xl">
                <a class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/70 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition-colors hover:border-[var(--gold)]" href="{{ $homeUrl }}">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    {{ __('site.cookies_page.back') }}
                </a>

                <section class="mt-10 rounded-[1.75rem] border border-white/70 bg-[var(--cream-soft)]/90 p-8 shadow-[0_24px_80px_rgba(36,30,26,0.08)] sm:p-10 lg:p-12">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/70 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)] shadow-sm">
                        <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                        {{ __('site.cookies_page.kicker') }}
                    </span>
                    <h1 class="mt-6 font-display text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">{{ __('site.cookies_page.heading') }}</h1>
                    <p class="mt-5 text-base leading-relaxed text-[var(--muted-foreground)]">
                        {{ __('site.cookies_page.valid_from') }}
                    </p>
                    <p class="mt-4 text-base leading-relaxed text-[var(--muted-foreground)]">
                        {{ __('site.cookies_page.intro') }}
                    </p>

                    <div class="mt-10 space-y-8 text-[15px] leading-relaxed text-[var(--muted-foreground)]">
                        <section>
                            <h2 class="font-display text-2xl font-semibold tracking-tight text-[var(--foreground)]">{{ __('site.cookies_page.what_title') }}</h2>
                            <p class="mt-3">{{ __('site.cookies_page.what_text') }}</p>
                        </section>

                        <section>
                            <h2 class="font-display text-2xl font-semibold tracking-tight text-[var(--foreground)]">{{ __('site.cookies_page.types_title') }}</h2>
                            <div class="mt-4 space-y-4">
                                <div class="rounded-2xl border border-[var(--soft-border)] bg-white/60 p-5">
                                    <p class="font-semibold text-[var(--foreground)]">{{ __('site.cookies_page.necessary_title') }}</p>
                                    <p class="mt-2">{{ __('site.cookies_page.necessary_text_1') }}</p>
                                    <p class="mt-2">{{ __('site.cookies_page.necessary_text_2') }}</p>
                                </div>
                                <div class="rounded-2xl border border-[var(--soft-border)] bg-white/60 p-5">
                                    <p class="font-semibold text-[var(--foreground)]">{{ __('site.cookies_page.external_title') }}</p>
                                    <p class="mt-2">{{ __('site.cookies_page.external_text') }}</p>
                                    <ul class="mt-3 list-disc space-y-2 pl-5">
                                        @foreach (trans('site.cookies_page.external_items') as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                    <p class="mt-3">{{ __('site.cookies_page.external_text_2') }}</p>
                                    <p class="mt-3">{{ __('site.cookies_page.external_text_3') }}</p>
                                    <p class="mt-3">{{ __('site.cookies_page.external_text_4') }}</p>
                                </div>
                            </div>
                        </section>

                        <section>
                            <h2 class="font-display text-2xl font-semibold tracking-tight text-[var(--foreground)]">{{ __('site.cookies_page.settings_title') }}</h2>
                            <p class="mt-3">{{ __('site.cookies_page.settings_text_1') }}</p>
                            <p class="mt-3">{{ __('site.cookies_page.settings_text_2') }}</p>
                            <p class="mt-3">{{ __('site.cookies_page.settings_text_3') }}</p>
                        </section>

                        <section>
                            <h2 class="font-display text-2xl font-semibold tracking-tight text-[var(--foreground)]">{{ __('site.cookies_page.contact_title') }}</h2>
                            <p class="mt-3">{{ __('site.cookies_page.contact_text') }}</p>
                            <div class="mt-4 rounded-2xl border border-[var(--soft-border)] bg-white/60 p-5 text-[var(--muted-foreground)]">
                                <p class="font-semibold text-[var(--foreground)]">Mountain Apartment {{ __('site.brand.name') }}</p>
                                <p class="mt-1">{{ __('site.cookies_page.owners') }}</p>
                                <p class="mt-1">{{ __('site.cookies_page.email_label') }}: <a class="font-semibold text-[var(--foreground)] underline decoration-[var(--gold)] decoration-2 underline-offset-4" href="mailto:slunecny.svah@gmail.com">slunecny.svah@gmail.com</a></p>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </main>

        <x-cookie-consent />
    </body>
</html>
