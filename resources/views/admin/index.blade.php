<!DOCTYPE html>
<html lang="cs" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <title>Administrace | Slunečný Svah</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[var(--background)] font-sans text-[var(--foreground)] antialiased">
        <main class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
            <section class="mx-auto flex min-h-[calc(100vh-3rem)] max-w-6xl flex-col justify-between overflow-hidden rounded-[2rem] border border-white/70 bg-[var(--cream-soft)] shadow-[0_28px_90px_rgba(36,30,26,0.1)]">
                <header class="flex flex-col gap-5 border-b border-[var(--soft-border)] px-6 py-6 sm:flex-row sm:items-center sm:justify-between lg:px-10">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[var(--muted-foreground)]">Mountain Apartment</p>
                        <h1 class="mt-1 font-display text-2xl font-semibold tracking-tight">Slunečný Svah</h1>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a class="inline-flex w-fit items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-table-cells-large" aria-hidden="true"></i>
                            Dashboard
                        </a>
                        <a class="inline-flex w-fit items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('home') }}">
                            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                            Zpět na web
                        </a>
                    </div>
                </header>

                <div class="grid flex-1 items-center gap-10 px-6 py-12 lg:grid-cols-[1.1fr_0.9fr] lg:px-10 lg:py-16">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)] shadow-sm">
                            <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                            Admin
                        </span>

                        <h2 class="mt-7 max-w-2xl font-display text-4xl font-semibold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                            Admin část je připravená.
                        </h2>

                        <p class="mt-6 max-w-xl text-base leading-relaxed text-[var(--muted-foreground)] sm:text-lg">
                            Tahle subdoména je oddělená od veřejného webu a připravená pro budoucí správu obsahu, fotek nebo rezervací.
                        </p>

                        <a class="mt-8 inline-flex items-center gap-2 rounded-full bg-[var(--anthracite)] px-6 py-3 text-sm font-semibold text-white shadow-[0_16px_34px_rgba(36,30,26,0.18)] transition duration-300 hover:bg-[var(--anthracite-hover)]" href="{{ route('admin.dashboard') }}">
                            Otevřít dashboard
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="rounded-[1.75rem] border border-[var(--soft-border)] bg-white/70 p-5 shadow-[0_24px_70px_rgba(36,30,26,0.08)]">
                        <div class="rounded-[1.35rem] bg-[var(--anthracite)] p-6 text-white">
                            <p class="text-sm font-semibold text-white/70">Stav</p>
                            <p class="mt-3 font-display text-3xl font-semibold">Online</p>
                            <div class="mt-8 space-y-3 text-sm text-white/70">
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-3">
                                    <span>Doména</span>
                                    <span class="font-semibold text-white">{{ config('app.admin_domain') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-3">
                                    <span>Přístup</span>
                                    <span class="font-semibold text-white">připraveno</span>
                                </div>
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-3">
                                    <span>Indexace</span>
                                    <span class="font-semibold text-white">vypnuto</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
