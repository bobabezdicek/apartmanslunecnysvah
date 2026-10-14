@php
    $fallbackPhotoDefinitions = [
        'hero' => ['path' => 'storage/lovable/01-exterior-summer-hero.jpg', 'gallery_key' => 'exterior_summer'],
        'courtyardExterior' => ['path' => 'storage/lovable/02-courtyard-exterior.png', 'gallery_key' => 'courtyard_exterior'],
        'livingKitchen' => ['path' => 'storage/lovable/03-living-kitchen-wide.png', 'gallery_key' => 'living_kitchen'],
        'livingRoom' => ['path' => 'storage/lovable/04-living-room.png', 'gallery_key' => 'living_room'],
        'bedroom' => ['path' => 'storage/lovable/05-bedroom.jpg', 'gallery_key' => 'bedroom'],
        'bathroom' => ['path' => 'storage/lovable/06-bathroom.png', 'gallery_key' => 'bathroom'],
        'gardenView' => ['path' => 'storage/lovable/07-garden-view.png', 'gallery_key' => 'garden_view'],
        'terraceView' => ['path' => 'storage/lovable/08-terrace-view.png', 'gallery_key' => 'terrace_view'],
        'valleySummer' => ['path' => 'storage/lovable/valley-summer.jpg'],
        'slopesWinter' => ['path' => 'storage/lovable/slopes-winter.jpg'],
        'medvedin' => ['path' => 'storage/lovable/medvedin.jpg'],
    ];
    $fallbackGalleryOrder = [
        'courtyardExterior' => 'lg:col-span-2 lg:row-span-2',
        'livingKitchen' => 'lg:col-span-2',
        'livingRoom' => 'lg:col-span-2',
        'bathroom' => 'lg:col-span-2 lg:row-span-2',
        'hero' => 'lg:col-span-2',
        'bedroom' => 'lg:col-span-2 lg:row-span-2',
        'gardenView' => 'lg:col-span-2 lg:row-span-2',
        'terraceView' => 'lg:col-span-2',
    ];

    $photoDefinitions = config('site_media.photos', $fallbackPhotoDefinitions);
    $photos = collect($photoDefinitions)
        ->map(fn (array $photo) => asset($photo['path']))
        ->all();
    $galleryPhotos = collect(config('site_media.gallery_order', $fallbackGalleryOrder))
        ->map(fn (string $class, string $key) => [
            'key' => $key,
            'class' => $class,
            'alt_key' => $photoDefinitions[$key]['gallery_key'],
        ])
        ->values();

    $currentLocale = app()->getLocale();
    $usesLocalizedRoutes = request()->routeIs('localized.*');
    $localizedRoute = fn (string $name, array $parameters = []) => route(
        ($currentLocale === 'cs' && ! $usesLocalizedRoutes) ? $name : 'localized.'.$name,
        ($currentLocale === 'cs' && ! $usesLocalizedRoutes) ? $parameters : ['locale' => $currentLocale] + $parameters,
    );
    $languageUrls = [
        'cs' => route('localized.home', ['locale' => 'cs']),
        'en' => route('localized.home', ['locale' => 'en']),
    ];

    $navItems = trans('site.nav');
    $introItems = trans('site.about.intro_items');
    $comfortItems = trans('site.about.comfort_items');
    $outdoorItems = trans('site.about.outdoor_items');
    $amenities = trans('site.about.amenities');
    $nearbyDistances = trans('site.location.nearby_distances');
    $locationRows = trans('site.location.rows');
    $bookingCards = trans('site.booking.cards');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ __('site.meta.description') }}">

        <title>{{ __('site.meta.title') }}</title>

        <script>
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden bg-[var(--background)] font-sans text-[var(--foreground)] antialiased">
        <header class="js-site-header site-header fixed left-0 right-0 top-0 z-50" data-scrolled="false" data-menu-open="false">
            <div class="site-header__shell mx-auto">
                <div class="flex items-center justify-between gap-6">
                    <button class="js-scroll-target text-left leading-tight transition-colors cursor-pointer" data-target="uvod" type="button">
                        <span class="block text-[9px] font-medium uppercase tracking-[0.3em] opacity-70">{{ __('site.brand.eyebrow') }}</span>
                        <span class="block font-display text-base font-semibold tracking-tight">{{ __('site.brand.name') }}</span>
                    </button>

                    <nav class="site-header__desktop-nav hidden items-center gap-2 lg:flex" aria-label="{{ __('site.nav_label') }}">
                        @foreach ($navItems as $item)
                            <button class="js-scroll-target site-header__nav-link cursor-pointer text-[13px] font-medium" data-target="{{ $item['target'] }}" type="button">
                                {{ $item['label'] }}
                            </button>
                        @endforeach
                    </nav>

                    <div class="site-header__language hidden items-center gap-1 rounded-full border border-current/10 bg-white/10 p-1 text-[11px] font-semibold uppercase backdrop-blur lg:flex" aria-label="{{ __('site.locale_name') }}">
                        @foreach ($languageUrls as $locale => $url)
                            <a @class([
                                'site-header__language-link rounded-full px-3 py-1.5',
                                'bg-current/12' => $currentLocale === $locale,
                            ]) href="{{ $url }}" hreflang="{{ $locale }}" data-language-switch>
                                {{ strtoupper($locale) }}
                            </a>
                        @endforeach
                    </div>

                    <button class="js-menu-toggle site-header__menu-button flex size-10 items-center justify-center rounded-full shadow-sm backdrop-blur-md transition-colors lg:hidden" type="button" aria-label="{{ __('site.menu_label') }}" aria-expanded="false">
                        <i class="fa-solid fa-bars text-lg" aria-hidden="true"></i>
                    </button>
                </div>

                <nav class="js-mobile-menu site-header__mobile-menu hidden lg:hidden" aria-label="{{ __('site.mobile_nav_label') }}">
                    <div class="grid gap-1">
                        @foreach ($navItems as $item)
                            <button class="js-scroll-target text-left" data-target="{{ $item['target'] }}" type="button">
                                {{ $item['label'] }}
                            </button>
                        @endforeach
                    </div>
                    <div class="mt-6 flex gap-2 border-t border-current/10 pt-5 text-sm font-semibold uppercase">
                        @foreach ($languageUrls as $locale => $url)
                            <a @class([
                                'rounded-full border border-current/15 px-4 py-2 transition-colors',
                                'bg-current/10' => $currentLocale === $locale,
                            ]) href="{{ $url }}" hreflang="{{ $locale }}" data-language-switch>
                                {{ strtoupper($locale) }}
                            </a>
                        @endforeach
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section class="relative min-h-screen w-full overflow-hidden bg-[var(--cream)]" id="uvod">
                <div class="relative flex min-h-screen w-full items-center justify-center overflow-hidden">
                    <img class="hero-media absolute inset-0 size-full object-cover" src="{{ $photos['hero'] }}" alt="{{ __('site.hero.image_alt') }}">
                    <div class="hero-overlay absolute inset-0"></div>
                    <div class="hero-readability"></div>

                    <div class="hero-copy relative z-10 mx-auto max-w-5xl px-6 pb-16 pt-36 text-center text-white sm:pt-40 lg:pt-44">
                        <h1 class="hero-reveal font-display text-4xl font-semibold leading-[1.05] tracking-tight sm:text-6xl md:text-7xl" style="--hero-delay: 260ms;">
                            {{ __('site.hero.title') }}<br>
                            <span class="font-light opacity-90">{{ __('site.hero.subtitle') }}</span>
                        </h1>
                        <p class="hero-reveal mx-auto mt-5 max-w-xl text-[15px] font-medium leading-relaxed text-white/95 sm:text-base" style="--hero-delay: 390ms;">
                            {{ __('site.hero.text') }}
                        </p>
                        <div class="hero-reveal mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row" style="--hero-delay: 520ms;">
                            <button class="js-scroll-target w-full cursor-pointer rounded-full bg-[var(--foreground)] px-8 py-4 text-sm font-semibold text-[var(--background)] shadow-lg transition-all hover:bg-[var(--anthracite-hover)] hover:shadow-[0_18px_45px_rgba(36,30,26,0.20)] active:scale-[0.98] sm:w-auto" data-target="rezervace" type="button">
                                {{ __('site.hero.reserve') }}
                            </button>
                            <button class="js-scroll-target w-full cursor-pointer  rounded-full border border-white/75 bg-white/90 px-8 py-4 text-sm font-semibold text-[var(--foreground)] shadow-[0_18px_45px_rgba(0,0,0,0.22)] backdrop-blur-xl transition-colors hover:bg-white sm:w-auto" data-target="apartman" type="button">
                                {{ __('site.hero.more') }}
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-[var(--background)] py-24 sm:py-32" id="apartman">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <x-section-heading :kicker="__('site.about.kicker')" :title="__('site.about.title')" />

                    <div class="space-y-24">
                        <x-split-section :image="$photos['livingKitchen']" :image-alt="__('site.about.image_alt')" :items="$introItems" />
                        <x-split-section :image="$photos['livingRoom']" :image-alt="__('site.about.image_alt')" :items="$comfortItems" reverse />
                        <x-split-section :image="$photos['gardenView']" :image-alt="__('site.about.image_alt')" :items="$outdoorItems" />
                    </div>

                    <div class="reveal mx-auto mt-16 max-w-6xl rounded-[1.75rem] border border-white/70 bg-[var(--cream-soft)]/80 p-5 shadow-[0_22px_60px_rgba(36,30,26,0.08)] backdrop-blur md:p-7">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-6">
                            @foreach ($amenities as $amenity)
                                <x-amenity-card :icon="$amenity['icon']" :text="$amenity['text']" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-[var(--cream)] py-24 sm:py-32" id="galerie">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <x-section-heading :kicker="__('site.gallery.kicker')" :title="__('site.gallery.title')" />

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-flow-dense lg:grid-cols-6 lg:auto-rows-[180px]">
                        @foreach ($galleryPhotos as $galleryPhoto)
                            <x-gallery-image class="{{ $galleryPhoto['class'] }} cursor-pointer" :src="$photos[$galleryPhoto['key']]" :alt="__('site.gallery.items.'.$galleryPhoto['alt_key'])" />
                        @endforeach
                    </div>

                    <x-gallery-lightbox :initial-src="$photos[$galleryPhotos->first()['key']]" :initial-alt="__('site.gallery.items.'.$galleryPhotos->first()['alt_key'])" />
                </div>
            </section>

            <section class="bg-[var(--background)] py-24 sm:py-32" id="lokalita">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <x-section-heading :kicker="__('site.location.kicker')" :title="__('site.location.title')" />

                    <div class="space-y-24">
                        <x-location-row
                            :image="$photos['valleySummer']"
                            :image-alt="$locationRows[0]['image_alt']"
                            :title="$locationRows[0]['title']"
                            :note="$locationRows[0]['note']"
                        >
                            {{ $locationRows[0]['text'] }}
                        </x-location-row>

                        <x-location-row
                            :image="$photos['medvedin']"
                            :image-alt="$locationRows[1]['image_alt']"
                            :title="$locationRows[1]['title']"
                            reverse
                        >
                            {{ $locationRows[1]['text'] }}
                        </x-location-row>

                        <x-location-row
                            :image="$photos['slopesWinter']"
                            :image-alt="$locationRows[2]['image_alt']"
                            :title="$locationRows[2]['title']"
                        >
                            {{ $locationRows[2]['text'] }}
                        </x-location-row>
                    </div>

                    <div class="mt-24 grid gap-10 lg:grid-cols-[0.85fr_1.4fr] lg:items-start">
                        <div class="reveal reveal-left">
                            <span class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-[var(--cream)]/70 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)]">
                                <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                {{ __('site.location.nearby_kicker') }}
                            </span>
                            <h3 class="mt-6 font-display text-3xl font-semibold tracking-tight text-[var(--foreground)] sm:text-4xl">
                                {{ __('site.location.nearby_title') }}
                            </h3>
                            <p class="mt-5 max-w-md text-[15px] leading-relaxed text-[var(--muted-foreground)]">
                                {{ __('site.location.nearby_text') }}
                            </p>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach ($nearbyDistances as $item)
                                <div @class([
                                    'reveal reveal-soft flex items-center justify-between gap-4 rounded-2xl border border-[var(--soft-border)] bg-white/65 p-4 shadow-[0_12px_32px_rgba(36,30,26,0.05)] backdrop-blur',
                                    'sm:col-span-2 sm:mx-auto sm:w-[calc(50%-0.375rem)]' => $loop->last && $loop->count % 2 === 1,
                                ])>
                                    <div class="flex min-w-0 items-center gap-4">
                                        <span class="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-[var(--cream)] text-[var(--gold)]">
                                            <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                                        </span>
                                        <span class="min-w-0">
                                            <span class="block text-sm font-semibold leading-snug text-[var(--foreground)]">{{ $item['label'] }}</span>
                                            <span class="mt-0.5 block truncate text-xs text-[var(--muted-foreground)]">{{ $item['detail'] }}</span>
                                        </span>
                                    </div>
                                    <span class="shrink-0 rounded-full bg-[var(--foreground)] px-3 py-1.5 text-xs font-semibold text-[var(--background)]">
                                        {{ $item['distance'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-[var(--cream)] py-24 sm:py-32" id="rezervace">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <div class="reveal reveal-soft overflow-hidden rounded-[1.75rem] border border-white/70 bg-[var(--cream-soft)]/85 shadow-[0_24px_80px_rgba(36,30,26,0.08)] backdrop-blur lg:rounded-3xl">
                        <div class="grid lg:grid-cols-[1.08fr_0.92fr]">
                            <div class="flex flex-col justify-center p-8 sm:p-10 lg:p-14">
                                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/70 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)] shadow-sm">
                                    <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                    {{ __('site.booking.kicker') }}
                                </span>
                                <h2 class="mt-6 max-w-2xl font-display text-4xl font-semibold leading-[1.05] tracking-tight text-[var(--foreground)] sm:text-5xl md:text-6xl">
                                    {{ __('site.booking.title') }}
                                </h2>
                                <p class="mt-6 max-w-xl text-base leading-relaxed text-[var(--muted-foreground)]">
                                    {{ __('site.booking.text') }}
                                </p>

                                <div class="mt-8 grid gap-3 sm:grid-cols-3">
                                    @foreach ($bookingCards as $card)
                                        <div class="rounded-2xl border border-[var(--soft-border)] bg-white/70 p-4">
                                            <i class="fa-solid {{ $card['icon'] }} text-lg text-[var(--gold)]" aria-hidden="true"></i>
                                            <p class="mt-3 text-sm font-semibold text-[var(--foreground)]">{{ $card['text'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="relative min-h-[320px] overflow-hidden lg:min-h-[460px]">
                                <img class="absolute inset-0 size-full object-cover" src="{{ $photos['gardenView'] }}" alt="{{ __('site.booking.image_alt') }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/5 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 right-6 rounded-2xl border border-white/30 bg-white/15 p-5 text-white shadow-2xl backdrop-blur-md">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/70">{{ __('site.brand.name') }}</p>
                                    <p class="mt-2 font-display text-2xl font-semibold leading-tight">{{ __('site.booking.location') }}</p>
                                    <p class="mt-2 text-sm leading-relaxed text-white/80">{{ __('site.booking.caption') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reveal reveal-soft mt-8 overflow-hidden rounded-[1.75rem] border border-[var(--soft-border)] bg-white/80 p-4 shadow-[0_24px_80px_rgba(36,30,26,0.10)] backdrop-blur sm:p-6 lg:p-8">
                        <div class="mb-5 flex flex-col gap-2 border-b border-[var(--soft-border)] pb-5 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <span class="inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)]">
                                    <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                    {{ __('site.booking.form_kicker') }}
                                </span>
                                <h3 class="mt-2 font-display text-2xl font-semibold tracking-tight text-[var(--foreground)]">{{ __('site.booking.form_title') }}</h3>
                            </div>
                            <p class="max-w-md text-sm leading-relaxed text-[var(--muted-foreground)]">{{ __('site.booking.form_text') }}</p>
                        </div>
                        <div id="previo-booking-engine"></div>
                    </div>
                </div>
            </section>

            <section class="bg-[var(--background)] py-24 sm:py-32" id="kontakty">
                <div class="mx-auto max-w-7xl px-6 lg:px-10">
                    <x-section-heading :kicker="__('site.contact.kicker')" :title="__('site.contact.title')" />

                    <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
                        <form
                            class="js-contact-form reveal reveal-left rounded-[1.75rem] border border-[var(--soft-border)] bg-white/55 p-6 shadow-[0_20px_60px_rgba(36,30,26,0.08)] backdrop-blur sm:p-8"
                            action="{{ $localizedRoute('contact.store') }}"
                            method="post"
                            data-submit-text="{{ __('site.contact.submit') }}"
                            data-loading-text="{{ __('site.contact.loading_fallback') }}"
                            data-validation-message="{{ __('site.contact.validation_failed') }}"
                            data-error-message="{{ __('site.contact.send_error') }}"
                            data-success-message="{{ __('site.contact.success') }}"
                        >
                            @csrf

                            <div class="{{ session('contact_status') ? '' : 'hidden' }} mb-6 rounded-2xl border border-[var(--gold)]/30 bg-[var(--gold)]/10 px-4 py-3 text-sm font-medium text-[var(--foreground)]" data-contact-status>
                                {{ session('contact_status') }}
                            </div>

                            <input class="hidden" type="text" name="website" value="" tabindex="-1" autocomplete="off">

                            <div class="space-y-5">
                                <x-form-field :label="__('site.contact.fields.name')" name="name" />
                                <x-form-field :label="__('site.contact.fields.email')" name="email" type="email" />
                                <x-form-field :label="__('site.contact.fields.message')" name="message" textarea />
                            </div>
                            <button class="mt-8 inline-flex w-full cursor-pointer items-center justify-center rounded-full bg-[var(--foreground)] px-10 py-4 text-sm font-semibold text-[var(--background)] shadow-lg transition-all hover:bg-[var(--anthracite-hover)] hover:shadow-[0_18px_45px_rgba(36,30,26,0.20)] disabled:cursor-wait disabled:opacity-80 active:scale-[0.98]" type="submit">
                                <span data-submit-label>{{ __('site.contact.submit') }}</span>
                                <span class="hidden items-center justify-center gap-2" data-submit-loading>
                                    <i class="fa-solid fa-circle-notch fa-spin" aria-hidden="true"></i>
                                    <span>{{ __('site.contact.loading') }}</span>
                                </span>
                            </button>
                        </form>

                        <div class="space-y-8">
                            <x-contact-block icon="fa-location-dot" :title="__('site.contact.blocks.address')">
                                <p class="font-display text-2xl font-semibold leading-snug tracking-tight text-[var(--foreground)]">Mountain Apartment {{ __('site.brand.name') }}</p>
                                <p class="mt-2 leading-relaxed text-[var(--muted-foreground)]">Apt. č. 32, Bedřichov 112<br>543 51 Špindlerův Mlýn<br>{{ __('site.contact.address_text') }}</p>
                            </x-contact-block>

                            <x-contact-block icon="fa-phone" :title="__('site.contact.blocks.arrival_coordinator')">
                                <p class="text-[var(--foreground)]">{{ __('site.contact.arrival_name') }}</p>
                                <p class="text-[var(--muted-foreground)]">📞 <a class="hover:text-[var(--foreground)]" href="tel:+420776145841">+420 776 145 841</a></p>
                                <p class="text-[var(--muted-foreground)]">✉️ <a class="hover:text-[var(--foreground)]" href="mailto:slunecny.svah@gmail.com">slunecny.svah@gmail.com</a></p>
                            </x-contact-block>

                            <x-contact-block icon="fa-users" :title="__('site.contact.blocks.owners')">
                                <p class="text-[var(--foreground)]">{{ __('site.contact.owners_name') }}</p>
                                <p class="text-[var(--muted-foreground)]">📞 +420 776 145 841</p>
                                <p class="text-[var(--muted-foreground)]">📞 +420 777 125 394</p>
                                <p class="text-[var(--muted-foreground)]">✉️ slunecny.svah@gmail.com</p>
                            </x-contact-block>

                            <x-contact-block icon="fa-clock" :title="__('site.contact.blocks.checkin')">
                                <p class="text-[var(--muted-foreground)]">{{ __('site.contact.checkin_text') }}</p>
                            </x-contact-block>

                            <x-contact-block icon="fa-credit-card" :title="__('site.contact.blocks.payment')">
                                <p class="text-sm text-[var(--muted-foreground)]">{{ __('site.contact.account') }}</p>
                                <p class="text-sm text-[var(--muted-foreground)]">IBAN: CZ05 3030 0000 0022 2192 6041</p>
                                <p class="text-sm text-[var(--muted-foreground)]">SWIFT/BIC: AIRACZPP</p>
                            </x-contact-block>
                        </div>
                    </div>

                    <div class="reveal reveal-zoom relative mt-16 h-[420px] overflow-hidden rounded-[1.75rem] border border-[var(--soft-border)] bg-[var(--cream-soft)] shadow-[0_24px_80px_rgba(36,30,26,0.16)]">
                        <iframe
                            class="size-full border-0"
                            title="{{ __('site.contact.map_title') }}"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=Bed%C5%99ichov%20112%2C%20%C5%A0pindler%C5%AFv%20Ml%C3%BDn&output=embed"
                        ></iframe>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer bg-[var(--cream)] px-4 pt-14 sm:px-6 sm:pt-16">
            <div class="site-footer__card reveal mx-auto max-w-7xl rounded-t-[1.75rem] bg-[var(--anthracite)] p-8 text-white sm:p-10 lg:p-12">
                <div class="grid gap-10 lg:grid-cols-3">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.3em] text-white/60">{{ __('site.brand.eyebrow') }}</p>
                        <p class="font-display text-2xl font-semibold tracking-tight">{{ __('site.brand.name') }}</p>
                        <p class="mt-4 text-sm leading-relaxed text-white/60">{{ __('site.footer.text') }}</p>
                    </div>

                    <div>
                        <p class="mb-4 text-sm font-semibold">{{ __('site.footer.links') }}</p>
                        <ul class="space-y-2 text-sm text-white/60">
                            @foreach ($navItems as $item)
                                <li>
                                    <button class="js-scroll-target hover:text-white" data-target="{{ $item['target'] }}" type="button">{{ $item['label'] }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <p class="mb-4 text-sm font-semibold">{{ __('site.footer.contact') }}</p>
                        <p class="text-sm text-white/75"><a class="hover:text-white" href="mailto:slunecny.svah@gmail.com">slunecny.svah@gmail.com</a></p>
                        <p class="mt-1 text-sm text-white/75"><a class="hover:text-white" href="tel:+420776145841">+420 776 145 841</a></p>
                    </div>
                </div>

                <div class="mt-12 flex flex-col gap-4 border-t border-white/10 pt-6 text-xs text-white/40 sm:flex-row sm:items-center sm:justify-between">
                    <p>{{ __('site.footer.copyright') }}</p>
                    <div class="flex flex-wrap gap-x-5 gap-y-2">
                        <a class="transition-colors hover:text-white" href="{{ $localizedRoute('cookies') }}">Cookies</a>
                        <button class="transition-colors hover:text-white" type="button" data-cookie-settings>{{ __('site.footer.cookie_settings') }}</button>
                    </div>
                </div>
            </div>
        </footer>

        <x-cookie-consent />

        <script type="text/javascript">
            var bookingEngineConfig = {
                id: '019eee7f-b9c9-72fa-90b3-c3c6fc580e23',
                lang: '{{ $currentLocale }}',
                currency: 'CZK'
            };

            var previoLoader = document.createElement('script');
            previoLoader.src = 'https://booking.previo.app/loader/';
            document.head.appendChild(previoLoader);
        </script>
    </body>
</html>
