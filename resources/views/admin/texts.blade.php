<!DOCTYPE html>
<html lang="cs" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <title>Texty | Slunečný Svah</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[var(--background)] font-sans text-[var(--foreground)] antialiased">
        <main class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
            <section class="mx-auto max-w-7xl overflow-hidden rounded-[2rem] border border-white/70 bg-[var(--cream-soft)] shadow-[0_28px_90px_rgba(36,30,26,0.1)]">
                <header class="flex flex-col gap-5 border-b border-[var(--soft-border)] px-6 py-6 sm:flex-row sm:items-center sm:justify-between lg:px-10">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[var(--muted-foreground)]">Administrace</p>
                        <h1 class="mt-1 font-display text-2xl font-semibold tracking-tight">Texty a překlady</h1>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-table-cells-large" aria-hidden="true"></i>
                            Dashboard
                        </a>
                        <a class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-white/75 px-4 py-2 text-sm font-semibold text-[var(--foreground)] shadow-sm transition duration-300 hover:border-[var(--gold)] hover:bg-white" href="{{ route('admin.media') }}">
                            <i class="fa-solid fa-images" aria-hidden="true"></i>
                            Obrázky
                        </a>
                    </div>
                </header>

                <div class="px-6 py-8 lg:px-10 lg:py-10">
                    <div class="rounded-[1.75rem] border border-[var(--soft-border)] bg-white/75 p-6 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                            <div>
                                <span class="inline-flex items-center gap-2 rounded-full border border-[var(--soft-border)] bg-[var(--cream)]/70 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-[var(--muted-foreground)]">
                                    <span class="size-2 rounded-full bg-[var(--gold)]"></span>
                                    CS / EN
                                </span>
                                <h2 class="mt-5 font-display text-3xl font-semibold tracking-tight">Připraveno pro editaci obsahu</h2>
                                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-[var(--muted-foreground)]">
                                    Pole zatím čtou aktuální překladové soubory. Ukládání se zapojí ve chvíli, kdy bude připravená databáze.
                                </p>
                            </div>

                            <button class="inline-flex cursor-not-allowed items-center justify-center rounded-full bg-[var(--anthracite)]/40 px-6 py-3 text-sm font-semibold text-white" type="button" disabled>
                                Ukládání čeká na databázi
                            </button>
                        </div>
                    </div>

                    <form class="mt-6 space-y-4">
                        @foreach ($translationRows as $row)
                            <section class="rounded-[1.5rem] border border-[var(--soft-border)] bg-white/75 p-5 shadow-sm">
                                <div class="flex flex-col gap-3 border-b border-[var(--soft-border)] pb-4 sm:flex-row sm:items-center sm:justify-between">
                                    <h3 class="font-mono text-xs font-semibold text-[var(--muted-foreground)]">{{ $row['key'] }}</h3>
                                    <span class="w-fit rounded-full bg-[var(--cream)] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-[var(--muted-foreground)]">Text</span>
                                </div>

                                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                                    <label class="block">
                                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--muted-foreground)]">Česky</span>
                                        <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-3 text-sm leading-relaxed outline-none transition focus:border-[var(--gold)] focus:bg-white" name="cs[{{ $row['key'] }}]">{{ $row['cs'] }}</textarea>
                                    </label>

                                    <label class="block">
                                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--muted-foreground)]">English</span>
                                        <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-[var(--soft-border)] bg-[var(--cream-soft)] px-4 py-3 text-sm leading-relaxed outline-none transition focus:border-[var(--gold)] focus:bg-white" name="en[{{ $row['key'] }}]">{{ $row['en'] }}</textarea>
                                    </label>
                                </div>
                            </section>
                        @endforeach
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>
