<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 mb-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent">
                    🛒 Ponto de Venda
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">
                    {{ $fair?->name ?? 'Nenhuma feirinha ativa' }}
                    @if ($fair)
                        - {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}
                    @endif
                </p>
            </div>
            <div class="flex gap-3">
                <button wire:click="clearCart"
                    class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95 {{ empty($cart) ? 'opacity-50 cursor-not-allowed' : '' }}"
                    @if (empty($cart)) disabled @endif>
                    🗑️ Limpar Carrinho
                </button>
                <a href="{{ route('fairs.index') }}"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                    wire:navigate>
                    🎪 Gerenciar Feirinhas
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
        <!-- Menu de Produtos (2 colunas) -->
        <div class="xl:col-span-2">
            <div
                class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">🍽️ Menu de Produtos</h2>
                </div>
                @if ($menu->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($menu as $fp)
                            <button wire:click="addToCart({{ $fp->id }})"
                                class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-700 dark:to-gray-800 border-2 border-gray-200 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 rounded-2xl p-4 text-left transition-all duration-300 transform hover:scale-105 hover:-rotate-1 hover:shadow-xl active:scale-95">

                                <!-- Badge de disponibilidade -->
                                @if (!is_null($fp->quantity))
                                    <div class="absolute top-2 right-2">
                                        <div
                                            class="px-2 py-1 {{ $fp->quantity - $fp->sold > 0 ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs font-semibold rounded-full shadow-lg">
                                            {{ $fp->quantity - $fp->sold }} unidades
                                        </div>
                                    </div>
                                @endif

                                <div class="space-y-3">
                                    <!-- Nome do produto -->
                                    <div
                                        class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                                        {{ $fp->product->name }}
                                    </div>

                                    <!-- Preço -->
                                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        R$ {{ number_format($fp->price, 2, ',', '.') }}
                                    </div>

                                    @if (!is_null($fp->quantity) && $fp->quantity - $fp->sold <= 5 && $fp->quantity - $fp->sold > 0)
                                        <div
                                            class="text-xs text-amber-600 dark:text-amber-400 font-medium bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded-lg">
                                            ⚠️ Poucas unidades restantes
                                        </div>
                                    @endif
                                </div>

                                <!-- Efeito de hover -->
                                <div
                                    class="absolute inset-0 bg-green-200/20 dark:bg-green-600/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10">
                                </div>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8V4a2 2 0 00-2-2H6a2 2 0 00-2 2v1m16 8H4">
                            </path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Nenhum produto
                            disponível</h3>
                        <p class="text-gray-500 dark:text-gray-400">Configure os produtos da feirinha para começar as
                            vendas.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Carrinho de Compras -->
        <div class="xl:col-span-1">
            <div
                class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">🛒 Carrinho</h2>
                </div>

                @if (!empty($cart))
                    <div class="space-y-3 mb-6 max-h-60 overflow-y-auto">
                        @foreach ($cart as $i => $item)
                            <div
                                class="group bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl p-4 hover:from-orange-50 hover:to-red-50 dark:hover:from-orange-900/20 dark:hover:to-red-900/20 transition-all duration-300">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 dark:text-white">{{ $item['name'] }}
                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            R$ {{ number_format($item['price'], 2, ',', '.') }} por unidade
                                        </div>
                                    </div>
                                    <button wire:click="removeFromCart({{ $i }})"
                                        class="p-2 text-red-500 hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200 transform hover:scale-110 active:scale-95">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Qtd:</label>
                                        <input type="number" min="1" value="{{ $item['qty'] }}"
                                            wire:change="updateQty({{ $i }}, $event.target.value)"
                                            class="w-20 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 text-sm bg-white dark:bg-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                    </div>
                                    <div class="font-bold text-lg text-orange-600 dark:text-orange-400">
                                        R$ {{ number_format($item['subtotal'], 2, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total e Ações -->
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-6">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-xl font-semibold text-gray-800 dark:text-gray-200">Total:</span>
                            <span
                                class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent">
                                R$ {{ number_format($this->total, 2, ',', '.') }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <button wire:click="startPayment('instant')"
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-lg">💳</span>
                                    <span>Pagar Agora</span>
                                </div>
                            </button>

                            <button wire:click="startPayment('open_tab')"
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-lg">📋</span>
                                    <span>Abrir Conta</span>
                                </div>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <div
                            class="p-4 bg-gray-100 dark:bg-gray-700 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                </path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium mb-1">🛒 Carrinho vazio</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Selecione produtos do menu para começar</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Contas Abertas -->
        <div class="xl:col-span-1">
            <div
                class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">📋 Contas Abertas</h2>
                </div>

                @if ($openOrders->count() > 0)
                    <div class="space-y-4 max-h-80 overflow-y-auto">
                        @foreach ($openOrders as $order)
                            <div
                                class="group bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 hover:from-amber-100 hover:to-yellow-100 dark:hover:from-amber-900/30 dark:hover:to-yellow-900/30 transition-all duration-300">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100">
                                                Conta #{{ $order->id }}
                                            </span>
                                        </div>
                                        <div class="font-medium text-base text-gray-900 dark:text-white">
                                            @if ($order->customer)
                                                <div class="flex items-center gap-2">
                                                    <span>👤</span>
                                                    <span>{{ $order->customer->name }}</span>
                                                </div>
                                                @if ($order->customer->phone)
                                                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                        📞 {{ $order->customer->phone }}
                                                    </div>
                                                @endif
                                            @else
                                                <div class="flex items-center gap-2">
                                                    <span>🎯</span>
                                                    <span>Cliente avulso</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div
                                            class="text-sm text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Aberta em: {{ $order->created_at->format('d/m H:i') }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div
                                            class="font-bold text-xl bg-gradient-to-r from-amber-600 to-yellow-600 dark:from-amber-400 dark:to-yellow-400 bg-clip-text text-transparent">
                                            R$ {{ number_format($order->total, 2, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-4">
                                    <button wire:click="addToOpenOrder({{ $order->id }})"
                                        class="flex-1 font-medium py-3 px-4 rounded-xl transition-all duration-200 text-sm transform hover:scale-105 active:scale-95
                                               {{ empty($cart)
                                                   ? 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed'
                                                   : 'bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-lg hover:shadow-xl' }}"
                                        @if (empty($cart)) disabled @endif>
                                        <div class="flex items-center justify-center gap-2">
                                            <span>🛒</span>
                                            <span>Adicionar Produtos</span>
                                        </div>
                                    </button>
                                    <button wire:click="selectOpenOrder({{ $order->id }})"
                                        class="flex-1 bg-gradient-to-r from-yellow-600 to-amber-600 hover:from-yellow-700 hover:to-amber-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 text-sm transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                                        <div class="flex items-center justify-center gap-2">
                                            <span>💰</span>
                                            <span>Fechar Conta</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <div
                            class="p-4 bg-gray-100 dark:bg-gray-700 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium mb-1">📋 Nenhuma conta aberta</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">As contas em aberto aparecerão aqui</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de Pagamento -->
    @if ($show_payment_modal)
        <div
            class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
            <div
                class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-md border border-white/20 dark:border-gray-700/50 w-full max-w-md shadow-2xl rounded-2xl p-6">
                <div class="space-y-6">
                    @if ($payment_type === 'instant')
                        <div class="text-center">
                            <div
                                class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl">💳</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Finalizar Pagamento
                            </h2>
                        </div>
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-700 dark:text-gray-300">Total a
                                    pagar:</span>
                                <span
                                    class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent">
                                    R$ {{ number_format($this->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @elseif($payment_type === 'open_tab')
                        <div class="text-center">
                            <div
                                class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl">📋</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Abrir Conta</h2>
                        </div>
                        <div
                            class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-700 dark:text-gray-300">Total da
                                    conta:</span>
                                <span
                                    class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">
                                    R$ {{ number_format($this->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-lg font-semibold text-gray-800 dark:text-gray-200">
                                👤 Cliente <span class="text-gray-500 font-normal">(opcional)</span>
                            </label>
                            <select wire:model="customer_id"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <option value="">🎯 Cliente avulso</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name }}
                                        @if ($customer->phone)
                                            - {{ $customer->phone }}
                                        @endif
                                        @if ($customer->email)
                                            - {{ $customer->email }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
                                <div class="flex items-start gap-2">
                                    <span class="text-blue-500">💡</span>
                                    <p class="text-sm text-blue-700 dark:text-blue-300">Selecione um cliente para
                                        facilitar o controle de contas em aberto</p>
                                </div>
                            </div>
                        </div>
                    @elseif($payment_type === 'add_to_tab')
                        <div class="text-center">
                            <div
                                class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl">🛒</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Adicionar à Conta
                                #{{ $order_to_pay->id }}</h2>
                        </div>
                        <div
                            class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">👤 Cliente:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $order_to_pay->customer?->name ?? 'Avulso' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">💰 Total atual:</span>
                                    <span class="font-bold text-lg text-gray-900 dark:text-white">R$
                                        {{ number_format($order_to_pay->total, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">🛒 Novos itens:</span>
                                    <span class="font-bold text-lg text-blue-600 dark:text-blue-400">R$
                                        {{ number_format($this->total, 2, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-blue-200 dark:border-blue-700 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">🏆 Novo
                                            total:</span>
                                        <span
                                            class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">
                                            R$ {{ number_format($order_to_pay->total + $this->total, 2, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($payment_type === 'close_tab')
                        <div class="text-center">
                            <div
                                class="p-3 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-xl w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl">💰</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Fechar Conta
                                #{{ $order_to_pay->id }}</h2>
                        </div>
                        <div
                            class="bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">👤 Cliente:</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $order_to_pay->customer?->name ?? 'Avulso' }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">🕒 Aberta em:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $order_to_pay->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="border-t border-amber-200 dark:border-amber-700 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">💰 Total a
                                            pagar:</span>
                                        <span
                                            class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-yellow-600 dark:from-amber-400 dark:to-yellow-400 bg-clip-text text-transparent">
                                            R$ {{ number_format($order_to_pay->total, 2, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($payment_type !== 'open_tab')
                        <div class="space-y-4">
                            <label class="block text-lg font-semibold text-gray-800 dark:text-gray-200">
                                💳 Forma de Pagamento <span class="text-red-500">*</span>
                            </label>
                            <div class="grid gap-3">
                                <label
                                    class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-200 transform hover:scale-105">
                                    <input type="radio" wire:model="payment_method" value="cash"
                                        class="mr-3 w-4 h-4 text-green-600 focus:ring-green-500">
                                    <span class="text-lg mr-2">💵</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">Dinheiro</span>
                                </label>
                                <label
                                    class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-200 transform hover:scale-105">
                                    <input type="radio" wire:model="payment_method" value="pix"
                                        class="mr-3 w-4 h-4 text-blue-600 focus:ring-blue-500">
                                    <span class="text-lg mr-2">📱</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">PIX</span>
                                </label>
                                <label
                                    class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-200 transform hover:scale-105">
                                    <input type="radio" wire:model="payment_method" value="card"
                                        class="mr-3 w-4 h-4 text-purple-600 focus:ring-purple-500">
                                    <span class="text-lg mr-2">💳</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">Cartão</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <div
                                    class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                    <span
                                        class="text-red-600 dark:text-red-400 text-sm font-medium">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    @endif

                    <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <button wire:click="cancelPayment"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95">
                            ❌ Cancelar
                        </button>
                        <button wire:click="{{ $payment_type === 'close_tab' ? 'closeOpenOrder' : 'processPayment' }}"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                            @if ($payment_type === 'instant')
                                ✅ Finalizar Pagamento
                            @elseif($payment_type === 'open_tab')
                                📋 Abrir Conta
                            @else
                                💰 Fechar Conta
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
