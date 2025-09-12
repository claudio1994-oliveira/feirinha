<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Ponto de Venda</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $fair?->name ?? '' }} @if ($payment_type !== 'open_tab' && $payment_type !== 'add_to_tab')
                @endif
                <button wire:click="{{ $payment_type === 'close_tab' ? 'closeOpenOrder' : 'processPayment' }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    @if ($payment_type === 'instant')
                        Finalizar Pagamento
                    @elseif($payment_type === 'open_tab')
                        Abrir Conta
                    @elseif($payment_type === 'add_to_tab')
                        Adicionar à Conta
                    @else
                        Fechar Conta
                    @endif
                </button>
                @if ($fair)
                    - {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}
                @endif
            </p>
        </div>
        <div class="flex gap-2">
            <button wire:click="clearCart"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors"
                @if (empty($cart)) disabled @endif>
                Limpar Carrinho
            </button>
            <a href="{{ route('fairs.index') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors" wire:navigate>
                Gerenciar Feirinhas
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
        <!-- Menu de Produtos (2 colunas) -->
        <div class="xl:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Menu de Produtos</h2>
                @if ($menu->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach ($menu as $fp)
                            <button wire:click="addToCart({{ $fp->id }})"
                                class="border-2 border-gray-200 hover:border-blue-500 rounded-lg p-4 text-left transition-all hover:shadow-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="font-semibold text-gray-900 dark:text-white">{{ $fp->product->name }}</div>
                                <div class="text-lg font-bold text-green-600 dark:text-green-400">
                                    R$ {{ number_format($fp->price, 2, ',', '.') }}
                                </div>
                                @if (!is_null($fp->quantity))
                                    <div class="text-xs text-gray-500 mt-1">
                                        Restam: {{ $fp->quantity - $fp->sold }}
                                    </div>
                                @endif
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8V4a2 2 0 00-2-2H6a2 2 0 00-2 2v1m16 8H4">
                            </path>
                        </svg>
                        <p class="mt-2">Nenhum produto disponível</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Carrinho de Compras -->
        <div class="xl:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Carrinho</h2>

                @if (!empty($cart))
                    <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                        @foreach ($cart as $i => $item)
                            <div class="border rounded-lg p-3 bg-gray-50 dark:bg-gray-700">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-sm">{{ $item['name'] }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            R$ {{ number_format($item['price'], 2, ',', '.') }}
                                        </div>
                                    </div>
                                    <button wire:click="removeFromCart({{ $i }})"
                                        class="text-red-500 hover:text-red-700 p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs">Qtd:</label>
                                        <input type="number" min="1" value="{{ $item['qty'] }}"
                                            wire:change="updateQty({{ $i }}, $event.target.value)"
                                            class="w-16 border rounded px-2 py-1 text-sm">
                                    </div>
                                    <div class="font-semibold text-sm">
                                        R$ {{ number_format($item['subtotal'], 2, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total e Ações -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold">Total:</span>
                            <span class="text-2xl font-bold text-green-600">
                                R$ {{ number_format($this->total, 2, ',', '.') }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <button wire:click="startPayment('instant')"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                                💳 Pagar Agora
                            </button>

                            <button wire:click="startPayment('open_tab')"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                                📋 Abrir Conta
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                            </path>
                        </svg>
                        <p class="mt-2 text-sm">Carrinho vazio</p>
                        <p class="text-xs text-gray-400">Selecione produtos do menu</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Contas Abertas -->
        <div class="xl:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Contas Abertas</h2>

                @if ($openOrders->count() > 0)
                    <div class="space-y-3">
                        @foreach ($openOrders as $order)
                            <div
                                class="border rounded-lg p-4 bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="font-semibold text-sm text-gray-800 dark:text-gray-200">
                                            Conta #{{ $order->id }}
                                        </div>
                                        <div class="font-medium text-base text-gray-900 dark:text-white">
                                            @if ($order->customer)
                                                👤 {{ $order->customer->name }}
                                                @if ($order->customer->phone)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        📞 {{ $order->customer->phone }}
                                                    </div>
                                                @endif
                                            @else
                                                🎯 Cliente avulso
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Aberta em: {{ $order->created_at->format('d/m H:i') }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-lg text-yellow-600 dark:text-yellow-400">
                                            R$ {{ number_format($order->total, 2, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button wire:click="addToOpenOrder({{ $order->id }})"
                                        class="flex-1 font-medium py-2 px-3 rounded transition-colors text-sm
                                               {{ empty($cart) ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 text-white' }}"
                                        @if (empty($cart)) disabled @endif>
                                        🛒 Adicionar Produtos
                                    </button>
                                    <button wire:click="selectOpenOrder({{ $order->id }})"
                                        class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-3 rounded transition-colors text-sm">
                                        💰 Fechar Conta
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="mt-2 text-sm">Nenhuma conta aberta</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de Pagamento -->
    @if ($show_payment_modal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3">
                    @if ($payment_type === 'instant')
                        <h2 class="text-lg font-semibold mb-4">💳 Finalizar Pagamento</h2>
                        <div
                            class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4 dark:bg-green-900/20 dark:border-green-800">
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Total a pagar:</span>
                                <span class="text-2xl font-bold text-green-600">
                                    R$ {{ number_format($this->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @elseif($payment_type === 'open_tab')
                        <h2 class="text-lg font-semibold mb-4">📋 Abrir Conta</h2>
                        <div
                            class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4 dark:bg-blue-900/20 dark:border-blue-800">
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Total da conta:</span>
                                <span class="text-2xl font-bold text-blue-600">
                                    R$ {{ number_format($this->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">
                                Cliente <span class="text-gray-500">(opcional)</span>
                            </label>
                            <select wire:model="customer_id"
                                class="w-full border rounded-lg px-3 py-2 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Cliente avulso</option>
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
                            <div class="mt-2 text-xs text-gray-500">
                                💡 Selecione um cliente para facilitar o controle de contas em aberto
                            </div>
                        </div>
                    @elseif($payment_type === 'add_to_tab')
                        <h2 class="text-lg font-semibold mb-4">🛒 Adicionar à Conta #{{ $order_to_pay->id }}</h2>
                        <div
                            class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4 dark:bg-blue-900/20 dark:border-blue-800">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Cliente:</span>
                                    <span class="font-medium">{{ $order_to_pay->customer?->name ?? 'Avulso' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total atual:</span>
                                    <span class="font-bold">R$
                                        {{ number_format($order_to_pay->total, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Novos itens:</span>
                                    <span class="font-bold text-blue-600">R$
                                        {{ number_format($this->total, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t">
                                    <span class="font-medium">Novo total:</span>
                                    <span class="text-2xl font-bold text-blue-600">
                                        R$ {{ number_format($order_to_pay->total + $this->total, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @elseif($payment_type === 'close_tab')
                        <h2 class="text-lg font-semibold mb-4">💰 Fechar Conta #{{ $order_to_pay->id }}</h2>
                        <div
                            class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4 dark:bg-yellow-900/20 dark:border-yellow-800">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Cliente:</span>
                                    <span class="font-medium">{{ $order_to_pay->customer?->name ?? 'Avulso' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Aberta em:</span>
                                    <span>{{ $order_to_pay->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t">
                                    <span class="font-medium">Total a pagar:</span>
                                    <span class="text-2xl font-bold text-yellow-600">
                                        R$ {{ number_format($order_to_pay->total, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($payment_type !== 'open_tab')
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Forma de Pagamento <span
                                    class="text-red-500">*</span></label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" wire:model="payment_method" value="cash" class="mr-2">
                                    💵 Dinheiro
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model="payment_method" value="pix" class="mr-2">
                                    📱 PIX
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model="payment_method" value="card" class="mr-2">
                                    💳 Cartão
                                </label>
                            </div>
                            @error('payment_method')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="flex justify-end gap-2">
                        <button wire:click="cancelPayment"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                            Cancelar
                        </button>
                        <button wire:click="{{ $payment_type === 'close_tab' ? 'closeOpenOrder' : 'processPayment' }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            @if ($payment_type === 'instant')
                                Finalizar Pagamento
                            @elseif($payment_type === 'open_tab')
                                Abrir Conta
                            @else
                                Fechar Conta
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
