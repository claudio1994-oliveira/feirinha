<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header com gradiente e sombra -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 dark:from-orange-400 dark:to-amber-400 bg-clip-text text-transparent">
                    Dashboard
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">
                    {{ $fair?->name ?? 'Sem feirinha atual' }}
                </p>
            </div>
            <a href="{{ route('pos') }}"
                class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                wire:navigate>
                🛒 Ir para o Caixa
            </a>
        </div>
    </div>

    <!-- Cards de métricas principais com ícones e gradientes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Faturamento -->
        <div
            class="group relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-rotate-1">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" />
                </svg>
            </div>
            <div class="relative">
                <div class="text-green-100 text-sm font-medium">💰 Faturamento</div>
                <div class="text-3xl font-bold mt-2">R$ {{ number_format($total, 2, ',', '.') }}</div>
                <div
                    class="absolute inset-0 bg-white/10 rounded-lg blur-xl -z-10 group-hover:bg-white/20 transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- Vendas pagas -->
        <div
            class="group relative bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:rotate-1">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM6 12a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1-3a1 1 0 100 2h6a1 1 0 100-2H7z" />
                </svg>
            </div>
            <div class="relative">
                <div class="text-blue-100 text-sm font-medium">🎯 Vendas Pagas</div>
                <div class="text-3xl font-bold mt-2">{{ $ordersCount }}</div>
            </div>
        </div>

        <!-- Ticket médio -->
        <div
            class="group relative bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-rotate-1">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="relative">
                <div class="text-purple-100 text-sm font-medium">📊 Ticket Médio</div>
                <div class="text-3xl font-bold mt-2">R$ {{ number_format($avgTicket, 2, ',', '.') }}</div>
            </div>
        </div>

        <!-- Itens vendidos -->
        <div
            class="group relative bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:rotate-1">
            <div class="absolute top-4 right-4 opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" />
                </svg>
            </div>
            <div class="relative">
                <div class="text-orange-100 text-sm font-medium">📦 Itens Vendidos</div>
                <div class="text-3xl font-bold mt-2">{{ $itemsSold }}</div>
            </div>
        </div>
    </div>

    <!-- Seção de análises detalhadas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Formas de pagamento -->
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Formas de Pagamento</h3>
            </div>
            <div class="space-y-4">
                <div
                    class="group flex items-center justify-between p-3 rounded-xl bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">💰</span>
                        <span class="font-medium text-gray-700 dark:text-gray-300">Espécie</span>
                    </div>
                    <span class="font-bold text-green-600 dark:text-green-400">R$
                        {{ number_format($cashTotal, 2, ',', '.') }}</span>
                </div>
                <div
                    class="group flex items-center justify-between p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📱</span>
                        <span class="font-medium text-gray-700 dark:text-gray-300">PIX</span>
                    </div>
                    <span class="font-bold text-blue-600 dark:text-blue-400">R$
                        {{ number_format($pixTotal, 2, ',', '.') }}</span>
                </div>
                <div
                    class="group flex items-center justify-between p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">💳</span>
                        <span class="font-medium text-gray-700 dark:text-gray-300">Cartão</span>
                    </div>
                    <span class="font-bold text-purple-600 dark:text-purple-400">R$
                        {{ number_format($cardTotal, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Vendas por hora -->
        <div
            class="lg:col-span-2 bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Vendas por Hora</h3>
            </div>
            <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-12 gap-3">
                @foreach ($byHour as $row)
                    <div
                        class="group relative bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl p-3 text-center hover:from-orange-50 hover:to-orange-100 dark:hover:from-orange-900/20 dark:hover:to-orange-800/20 transition-all duration-300 transform hover:scale-105 hover:-rotate-1">
                        <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $row->hour }}h</div>
                        <div class="text-lg font-bold text-orange-600 dark:text-orange-400 my-1">{{ $row->count }}
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-300">R$
                            {{ number_format($row->total, 0, ',', '.') }}</div>
                        <div
                            class="absolute inset-0 bg-orange-200/20 dark:bg-orange-600/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top produtos e últimas vendas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top 5 produtos -->
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">🏆 Top 5 Produtos</h3>
            </div>
            <div class="space-y-3">
                @forelse ($topProducts as $index => $p)
                    <div
                        class="group flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 hover:from-emerald-50 hover:to-teal-50 dark:hover:from-emerald-900/20 dark:hover:to-teal-900/20 transition-all duration-300 transform hover:scale-[1.02]">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800 dark:text-gray-200">{{ $p->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $p->qty }} unidades
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-emerald-600 dark:text-emerald-400">
                                R$ {{ number_format($p->total, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" />
                        </svg>
                        Nenhum produto vendido ainda
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Últimas vendas -->
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">🕒 Últimas Vendas</h3>
            </div>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse ($recentOrders as $o)
                    <div
                        class="group flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 transition-all duration-300 transform hover:scale-[1.02]">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                #{{ $o->id }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800 dark:text-gray-200">
                                    {{ $o->customer?->name ?? 'Cliente Avulso' }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $o->created_at->format('H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-blue-600 dark:text-blue-400">
                                R$ {{ number_format($o->total, 2, ',', '.') }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ ucfirst($o->payment_method) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM6 12a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1-3a1 1 0 100 2h6a1 1 0 100-2H7z" />
                        </svg>
                        Nenhuma venda realizada ainda
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer com informações adicionais -->
    @if ($openTabs > 0)
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" />
                </svg>
                <div>
                    <h4 class="font-semibold">⚠️ Comandas em Aberto</h4>
                    <p class="text-amber-100">Existem {{ $openTabs }} comandas em aberto aguardando pagamento</p>
                </div>
            </div>
        </div>
    @endif
</div>
