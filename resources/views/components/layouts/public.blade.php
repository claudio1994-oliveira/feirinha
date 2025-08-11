<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased bg-[#fff7ed] text-[#1b1b18] dark:bg-neutral-900 dark:text-white">
    <!-- Header -->
    <header class="relative z-10">
        <div class="mx-auto max-w-6xl px-6 py-4 flex items-center justify-between">
            <a href="{{ route('public.menu') }}" class="flex items-center gap-3" aria-label="Feirinha" wire:navigate>
                <!-- Chef hat icon -->
                <svg class="size-8 text-amber-600 dark:text-amber-400" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M4 10a4 4 0 0 1 5.624-3.69A5 5 0 0 1 19 9a3 3 0 0 1-1 5h-1v3a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-3H6a4 4 0 0 1-2-7Zm5 8h6v-3H9v3Z" />
                </svg>
                <div class="leading-tight">
                    <div class="text-lg font-semibold">Feirinha</div>
                    <div class="text-xs text-amber-700/80 dark:text-amber-300/80">Cardápio & Sabores</div>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-4">
                <a href="{{ route('home') }}"
                    class="text-sm text-neutral-700 hover:text-neutral-900 dark:text-neutral-300 dark:hover:text-white"
                    wire:navigate>Início</a>
            </nav>
        </div>
    </header>

    <!-- Hero culinário -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-500 via-rose-400 to-orange-500"></div>
        <!-- Decorações -->
        <div class="pointer-events-none absolute -top-12 -left-12 size-64 rounded-full bg-white/15 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-16 -right-10 size-72 rounded-full bg-white/10 blur-3xl"></div>

        <div class="relative mx-auto max-w-6xl px-6 py-10 md:py-14 text-white">
            <div class="flex items-center gap-3">
                <!-- Fork icon -->
                <svg class="size-7 opacity-90" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M7 2a1 1 0 0 1 1 1v4a2 2 0 1 0 2 2V3a1 1 0 1 1 2 0v6a2 2 0 1 0 2-2V3a1 1 0 1 1 2 0v6a4 4 0 0 1-4 4h-1v8a2 2 0 1 1-4 0v-8H9a4 4 0 0 1-4-4V3a1 1 0 0 1 1-1Z" />
                </svg>
                <h1 class="text-2xl md:text-4xl font-bold tracking-tight">Cardápio da Feirinha</h1>
            </div>
            <p class="mt-2 md:mt-3 text-sm md:text-base text-white/90">Descubra os sabores do dia: preços, quantidades e
                disponibilidade em tempo real.</p>
        </div>
    </section>

    <!-- Conteúdo -->
    <main class="relative z-10">
        {{ $slot }}
    </main>

    <!-- Rodapé -->
    <footer class="mt-8 border-t border-amber-200/60 dark:border-white/10">
        <div class="mx-auto max-w-6xl px-6 py-6 text-xs text-neutral-600 dark:text-neutral-400">
            <span>Com carinho e sabor — Feirinha</span>
        </div>
    </footer>

    @fluxScripts
</body>

</html>
