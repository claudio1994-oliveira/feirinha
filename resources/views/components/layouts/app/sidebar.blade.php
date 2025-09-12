<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased bg-[#fff7ed] text-[#1b1b18] dark:bg-neutral-900 dark:text-white">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Plataforma')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                <flux:navlist.item icon="shopping-bag" :href="route('products.index')"
                    :current="request()->routeIs('products.*')" wire:navigate>Produtos</flux:navlist.item>
                <flux:navlist.item icon="calendar" :href="route('fairs.index')" :current="request()->routeIs('fairs.*')"
                    wire:navigate>Feirinhas</flux:navlist.item>
                <flux:navlist.item icon="credit-card" :href="route('pos')" :current="request()->routeIs('pos')"
                    wire:navigate>Caixa</flux:navlist.item>
                <flux:navlist.item icon="users" :href="route('customers.index')"
                    :current="request()->routeIs('customers.*')" wire:navigate>Clientes</flux:navlist.item>
                <flux:navlist.item icon="shield-check" :href="route('users.index')"
                    :current="request()->routeIs('users.*')" wire:navigate>Usuários</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Culinário: faixa superior -->
    <section class="relative bg-gradient-to-r from-amber-500 via-rose-400 to-orange-500 text-white shadow">
        <div class="mx-auto max-w-6xl px-6 py-3 hidden lg:flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="size-5 opacity-90" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M7 2a1 1 0 0 1 1 1v4a2 2 0 1 0 2 2V3a1 1 0 1 1 2 0v6a2 2 0 1 0 2-2V3a1 1 0 1 1 2 0v6a4 4 0 0 1-4 4h-1v8a2 2 0 1 1-4 0v-8H9a4 4 0 0 1-4-4V3a1 1 0 0 1 1-1Z" />
                </svg>
                <span class="font-semibold">Painel da Feirinha</span>
            </div>
            <span class="text-xs/none opacity-90">Cardápio, produtos e caixa</span>
        </div>
        <div class="px-4 py-2 lg:hidden text-center text-sm font-medium">Painel da Feirinha</div>
    </section>

    {{ $slot }}

    <x-notifications />

    @fluxScripts
</body>

</html>
