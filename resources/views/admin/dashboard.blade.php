<!DOCTYPE html>
<html lang="cs" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <title>Dashboard | Slunečný Svah</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[var(--background)] font-sans text-[var(--foreground)] antialiased">
        <main class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
            <section class="mx-auto min-h-[calc(100vh-3rem)] max-w-7xl overflow-hidden rounded-[2rem] border border-white/70 bg-[var(--cream-soft)] shadow-[0_28px_90px_rgba(36,30,26,0.1)]">
                <header class="flex flex-col gap-5 border-b border-[var(--soft-border)] px-6 py-6 sm:flex-row sm:items-center sm:justify-between lg:px-10">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[var(--muted-foreground)]">Administrace</p>
                        <h1 class="mt-1 font-display text-2xl font-semibold tracking-tight">Dashboard</h1>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.home') }}">
                            <i class="fa-solid fa-table-cells-large" aria-hidden="true"></i>
                            Admin úvod
                        </a>
                        <a class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('home') }}">
                            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                            Veřejný web
                        </a>
                    </div>
                </header>

                <div class="px-6 py-8 lg:px-10 lg:py-10">
                    <div class="grid gap-5 lg:grid-cols-4">
                        <article class="rounded-[1.5rem] border border-[var(--soft-border)] bg-white/75 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-[var(--muted-foreground)]">Stav webu</p>
                            <p class="mt-4 font-display text-3xl font-semibold">Online</p>
                            <p class="mt-2 text-sm text-[var(--muted-foreground)]">Veřejná prezentace běží.</p>
                        </article>

                        <article class="rounded-[1.5rem] border border-[var(--soft-border)] bg-white/75 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-[var(--muted-foreground)]">Fotky</p>
                            <p class="mt-4 font-display text-3xl font-semibold">Lovable</p>
                            <p class="mt-2 text-sm text-[var(--muted-foreground)]">Používané obrázky jsou v jedné složce.</p>
                        </article>

                        <article class="rounded-[1.5rem] border border-[var(--soft-border)] bg-white/75 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-[var(--muted-foreground)]">Jazyky</p>
                            <p class="mt-4 font-display text-3xl font-semibold">CS / EN</p>
                            <p class="mt-2 text-sm text-[var(--muted-foreground)]">Web má českou a anglickou verzi.</p>
                        </article>

                        <article class="rounded-[1.5rem] border border-[var(--soft-border)] bg-white/75 p-5 shadow-sm">
                            <p class="text-sm font-semibold text-[var(--muted-foreground)]">Rezervace</p>
                            <p class="mt-4 font-display text-3xl font-semibold">Previo</p>
                            <p class="mt-2 text-sm text-[var(--muted-foreground)]">Widget je napojený ve veřejné části.</p>
                        </article>
                    </div>

                    <div class="mt-6 grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
                        <section class="rounded-[1.75rem] border border-[var(--soft-border)] bg-white/75 p-6 shadow-sm">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-[var(--muted-foreground)]">Rychlé odkazy</p>
                                    <h2 class="mt-1 font-display text-2xl font-semibold tracking-tight">Správa webu</h2>
                                </div>
                                <span class="flex size-11 items-center justify-center rounded-full bg-[var(--cream)] text-[var(--gold)]">
                                    <i class="fa-solid fa-compass" aria-hidden="true"></i>
                                </span>
                            </div>

                            <div class="mt-6 space-y-3">
                                <a class="flex items-center justify-between rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-4 text-sm font-semibold transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.texts') }}">
                                    Texty a překlady
                                    <i class="fa-solid fa-chevron-right text-xs text-[var(--gold)]" aria-hidden="true"></i>
                                </a>
                                <a class="flex items-center justify-between rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-4 text-sm font-semibold transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.media') }}">
                                    Obrázky a pořadí
                                    <i class="fa-solid fa-chevron-right text-xs text-[var(--gold)]" aria-hidden="true"></i>
                                </a>
                                <a class="flex items-center justify-between rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-4 text-sm font-semibold transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('home') }}#galerie">
                                    Galerie
                                    <i class="fa-solid fa-chevron-right text-xs text-[var(--gold)]" aria-hidden="true"></i>
                                </a>
                                <a class="flex items-center justify-between rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-4 text-sm font-semibold transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('home') }}#rezervace">
                                    Rezervace
                                    <i class="fa-solid fa-chevron-right text-xs text-[var(--gold)]" aria-hidden="true"></i>
                                </a>
                                <a class="flex items-center justify-between rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-4 text-sm font-semibold transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('home') }}#kontakty">
                                    Kontakty
                                    <i class="fa-solid fa-chevron-right text-xs text-[var(--gold)]" aria-hidden="true"></i>
                                </a>
                            </div>
                        </section>

                        <section class="rounded-[1.75rem] bg-[var(--anthracite)] p-6 text-white shadow-[0_24px_70px_rgba(36,30,26,0.16)]">
                            <p class="text-sm font-semibold text-white/65">Technické info</p>
                            <h2 class="mt-1 font-display text-2xl font-semibold tracking-tight">Admin subdoména</h2>

                            <div class="mt-7 space-y-4 text-sm text-white/70">
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-4">
                                    <span>Doména</span>
                                    <span class="font-semibold text-white">{{ config('app.admin_domain') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-4">
                                    <span>Podstránka</span>
                                    <span class="font-semibold text-white">/dashboard</span>
                                </div>
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-4">
                                    <span>Indexace</span>
                                    <span class="font-semibold text-white">noindex</span>
                                </div>
                                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-4">
                                    <span>Stav</span>
                                    <span class="font-semibold text-white">připraveno</span>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
