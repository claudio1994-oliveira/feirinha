<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-root">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased bg-[#fff7ed] text-[#1b1b18] dark:bg-neutral-900 dark:text-white">
    <div class="flex h-screen overflow-hidden">
        <div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0">
            <div
                class="flex flex-col flex-grow border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4 py-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2" wire:navigate>
                        <x-app-logo />
                    </a>
                </div>
                <nav class="flex-1 px-2 py-4 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium rounded-md" wire:navigate>Dashboard</a>
                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium rounded-md" wire:navigate>Produtos</a>
                    <a href="{{ route('fairs.index') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium rounded-md" wire:navigate>Feirinhas</a>
                    <a href="{{ route('pos') }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md"
                        wire:navigate>Caixa</a>
                    <a href="{{ route('customers.index') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium rounded-md" wire:navigate>Clientes</a>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium rounded-md" wire:navigate>Usu�rios</a>
                </nav>
                <div class="flex-shrink-0 p-4 border-t border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Tema</span>
                        <button onclick="toggleDarkMode()"
                            class="p-1 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg id="sun-icon" class="h-4 w-4 hidden" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <svg id="moon-icon" class="h-4 w-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-gray-500">Sair</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="lg:hidden">
            <button type="button"
                class="fixed top-4 left-4 z-50 p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                onclick="toggleMobileMenu()">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 z-40 lg:hidden hidden">
            <div class="fixed inset-0 bg-slate-900 opacity-50" onclick="toggleMobileMenu()"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-900 shadow-xl">
                <div class="flex flex-col h-full">
                    <div
                        class="flex items-center flex-shrink-0 px-4 py-4 border-b border-gray-200 dark:border-gray-700">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2" wire:navigate
                            onclick="toggleMobileMenu()">
                            <x-app-logo />
                        </a>
                    </div>
                    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Dashboard</a>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Produtos</a>
                        <a href="{{ route('fairs.index') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Feirinhas</a>
                        <a href="{{ route('pos') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Caixa</a>
                        <a href="{{ route('customers.index') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Clientes</a>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            wire:navigate onclick="toggleMobileMenu()">Usuários</a>
                    </nav>
                    <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Tema</span>
                            <button onclick="toggleDarkMode()"
                                class="p-1 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                <svg id="sun-icon-mobile" class="h-4 w-4 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <svg id="moon-icon-mobile" class="h-4 w-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-xs text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col flex-1 lg:pl-64">
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobile-menu-overlay');
            overlay.classList.toggle('hidden');
        }

        function toggleDarkMode() {
            const html = document.getElementById('html-root');
            const isDark = html.classList.contains('dark');

            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }

            updateThemeIcons();
        }

        function updateThemeIcons() {
            const html = document.getElementById('html-root');
            const isDark = html.classList.contains('dark');

            // Desktop icons
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');

            // Mobile icons
            const sunIconMobile = document.getElementById('sun-icon-mobile');
            const moonIconMobile = document.getElementById('moon-icon-mobile');

            if (isDark) {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
                sunIconMobile.classList.remove('hidden');
                moonIconMobile.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
                sunIconMobile.classList.add('hidden');
                moonIconMobile.classList.remove('hidden');
            }
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const html = document.getElementById('html-root');

            if (savedTheme === 'light') {
                html.classList.remove('dark');
            } else {
                html.classList.add('dark');
            }

            updateThemeIcons();
        });
    </script>

    @fluxScripts
</body>

</html>
