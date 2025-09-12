<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html-root">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-900 dark:text-white">
    <div class="flex h-screen overflow-hidden">
        <div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0">
            <div class="flex flex-col flex-grow bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm border-r border-white/20 dark:border-gray-700/50 shadow-xl overflow-y-auto">
                <!-- Logo Section -->
                <div class="flex items-center flex-shrink-0 px-6 py-6 border-b border-gray-200/50 dark:border-gray-700/50">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group" wire:navigate>
                        <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200 group-hover:scale-110">
                            <x-app-logo class="text-white" />
                        </div>
                        <div class="hidden xl:block">
                            <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent">
                                Feirinha
                            </h1>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Sistema de Gestão</p>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-blue-700 dark:text-blue-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                            </div>
                            <span>📊 Dashboard</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('products.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-700 dark:text-green-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-green-500 group-hover:to-emerald-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>🥕 Produtos</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('fairs.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-red-50 dark:hover:from-orange-900/20 dark:hover:to-red-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('fairs.*') ? 'bg-gradient-to-r from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30 text-orange-700 dark:text-orange-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('fairs.*') ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-orange-500 group-hover:to-red-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span>🏪 Feirinhas</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('pos') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('pos') ? 'bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 text-purple-700 dark:text-purple-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('pos') ? 'bg-gradient-to-r from-purple-500 to-pink-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-purple-500 group-hover:to-pink-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                </svg>
                            </div>
                            <span>💳 Caixa</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('customers.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 dark:hover:from-indigo-900/20 dark:hover:to-blue-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-100 to-blue-100 dark:from-indigo-900/30 dark:to-blue-900/30 text-indigo-700 dark:text-indigo-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-indigo-500 group-hover:to-blue-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span>👥 Clientes</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('users.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 dark:hover:from-teal-900/20 dark:hover:to-cyan-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-teal-100 to-cyan-100 dark:from-teal-900/30 dark:to-cyan-900/30 text-teal-700 dark:text-teal-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                        wire:navigate>
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-lg {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-teal-500 to-cyan-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-teal-500 group-hover:to-cyan-600 group-hover:text-white' }} transition-all duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                </svg>
                            </div>
                            <span>👤 Usuários</span>
                        </div>
                    </a>
                </nav>
                
                <!-- Bottom Section -->
                <div class="flex-shrink-0 p-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-800/50 dark:to-gray-900/50">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">🎨 Tema</span>
                        <button onclick="toggleDarkMode()"
                            class="p-2 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-lg transition-all duration-200 transform hover:scale-110">
                            <svg id="sun-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <svg id="moon-icon" class="h-5 w-5" fill="none" stroke="currentColor"
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
                                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>🚪 Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="lg:hidden">
            <button type="button"
                class="fixed top-4 left-4 z-50 p-3 rounded-xl bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-white/20 dark:border-gray-700/50 text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-110"
                onclick="toggleMobileMenu()">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 z-40 lg:hidden hidden">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border-r border-white/20 dark:border-gray-700/50 shadow-2xl">
                <div class="flex flex-col h-full">
                    <!-- Mobile Logo -->
                    <div class="flex items-center flex-shrink-0 px-6 py-6 border-b border-gray-200/50 dark:border-gray-700/50">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group" wire:navigate
                            onclick="toggleMobileMenu()">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200 group-hover:scale-110">
                                <x-app-logo class="text-white" />
                            </div>
                            <div>
                                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent">
                                    Feirinha
                                </h1>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Sistema de Gestão</p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Mobile Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                        <a href="{{ route('dashboard') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-blue-700 dark:text-blue-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-blue-500 group-hover:to-purple-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                                <span>📊 Dashboard</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('products.index') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-900/20 dark:hover:to-emerald-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 text-green-700 dark:text-green-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-green-500 group-hover:to-emerald-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span>🥕 Produtos</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('fairs.index') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-orange-50 hover:to-red-50 dark:hover:from-orange-900/20 dark:hover:to-red-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('fairs.*') ? 'bg-gradient-to-r from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30 text-orange-700 dark:text-orange-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('fairs.*') ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-orange-500 group-hover:to-red-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span>🏪 Feirinhas</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('pos') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('pos') ? 'bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 text-purple-700 dark:text-purple-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('pos') ? 'bg-gradient-to-r from-purple-500 to-pink-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-purple-500 group-hover:to-pink-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                    </svg>
                                </div>
                                <span>💳 Caixa</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('customers.index') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-blue-50 dark:hover:from-indigo-900/20 dark:hover:to-blue-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-100 to-blue-100 dark:from-indigo-900/30 dark:to-blue-900/30 text-indigo-700 dark:text-indigo-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-indigo-500 group-hover:to-blue-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span>👥 Clientes</span>
                            </div>
                        </a>
                        
                        <a href="{{ route('users.index') }}"
                            class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 dark:hover:from-teal-900/20 dark:hover:to-cyan-900/20 hover:shadow-md transform hover:scale-105 active:scale-95 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-teal-100 to-cyan-100 dark:from-teal-900/30 dark:to-cyan-900/30 text-teal-700 dark:text-teal-300 shadow-md' : 'text-gray-700 dark:text-gray-300' }}"
                            wire:navigate onclick="toggleMobileMenu()">
                            <div class="flex items-center gap-3">
                                <div class="p-1.5 rounded-lg {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-teal-500 to-cyan-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 group-hover:bg-gradient-to-r group-hover:from-teal-500 group-hover:to-cyan-600 group-hover:text-white' }} transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                </div>
                                <span>👤 Usuários</span>
                            </div>
                        </a>
                    </nav>
                    
                    <!-- Mobile Bottom Section -->
                    <div class="flex-shrink-0 p-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-800/50 dark:to-gray-900/50">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">🎨 Tema</span>
                            <button onclick="toggleDarkMode()"
                                class="p-2 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 hover:shadow-lg transition-all duration-200 transform hover:scale-110">
                                <svg id="sun-icon-mobile" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <svg id="moon-icon-mobile" class="h-5 w-5" fill="none" stroke="currentColor"
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
                                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>🚪 Sair</span>
                            </button>
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
