<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-svh antialiased bg-[#fff7ed] text-[#1b1b18] dark:bg-neutral-950 dark:text-white">
    <!-- Header -->
    <header class="relative z-10">
        <div class="mx-auto max-w-6xl px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Feirinha" wire:navigate>
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
        </div>
    </header>

    <main class="relative grid gap-0 md:grid-cols-2 min-h-[calc(100svh-64px)]">
        <!-- Hero Side -->
        <section class="relative hidden md:block overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500 via-rose-400 to-orange-500"></div>
            <div class="pointer-events-none absolute -top-10 -left-10 size-64 rounded-full bg-white/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -right-10 size-72 rounded-full bg-white/10 blur-3xl">
            </div>

            <div class="relative h-full w-full flex items-center">
                <div class="mx-auto max-w-md p-10 text-white">
                    <h2 class="text-3xl font-bold leading-tight">Bem-vindo(a) de volta</h2>
                    <p class="mt-3 text-white/90">Acesse para gerenciar produtos, feirinhas e o caixa. Que o atendimento
                        de hoje seja um sucesso!</p>

                    <div class="mt-8 grid grid-cols-3 gap-3 text-center text-xs">
                        <div class="rounded-lg bg-white/10 px-3 py-2">Sabores<br><span
                                class="font-semibold">Autênticos</span></div>
                        <div class="rounded-lg bg-white/10 px-3 py-2">Gestão<br><span
                                class="font-semibold">Descomplicada</span></div>
                        <div class="rounded-lg bg-white/10 px-3 py-2">Vendas<br><span class="font-semibold">Ágeis</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Side -->
        <section class="relative flex items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-sm">
                <div
                    class="rounded-xl border border-amber-200/60 bg-white/90 shadow-[0_2px_20px_-8px_rgba(0,0,0,0.2)] backdrop-blur-md dark:border-white/10 dark:bg-neutral-900/60">
                    <div class="p-6 md:p-8">
                        {{ $slot }}
                    </div>
                </div>
                <p class="mt-6 text-center text-xs text-neutral-600 dark:text-neutral-400">© {{ date('Y') }}
                    Feirinha — Todos os direitos reservados.</p>
            </div>
        </section>
    </main>

    @fluxScripts
</body>

</html>
