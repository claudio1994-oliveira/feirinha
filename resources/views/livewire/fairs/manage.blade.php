<div
    class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="space-y-2">
                <div class="flex items-center gap-3">

                    <h1
                        class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent">
                        🏪 Gerenciar: {{ $fair->name }}
                    </h1>
                </div>
                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">📅 {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}</span>
                </div>
            </div>
            <a href="{{ route('fairs.index') }}"
                class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl flex items-center gap-2"
                wire:navigate>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Formulário de Adicionar/Editar Produto -->
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">📝 Adicionar/Editar Produto</h2>
            </div>

            <form wire:submit="addOrUpdateProduct" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">🥕 Produto</label>
                    <select wire:model="product_id"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        <option value="">Selecione um produto...</option>
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">💰 Preço</label>
                        <input type="number" min="0" step="0.01" wire:model="price"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                            placeholder="0,00" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">📦
                            Quantidade</label>
                        <input type="number" min="0" step="1" wire:model="quantity"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                            placeholder="Opcional" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>✅ Salvar Produto</span>
                    </div>
                </button>
            </form>
        </div>

        <!-- Cardápio do Dia -->
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">🍽️ Cardápio do Dia</h2>
            </div>

            <div class="space-y-4 max-h-96 overflow-y-auto">
                @forelse($menu as $fp)
                    <div
                        class="group bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl p-4 hover:from-orange-50 hover:to-red-50 dark:hover:from-orange-900/20 dark:hover:to-red-900/20 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="font-semibold text-lg text-gray-900 dark:text-white mb-1">
                                    🥕 {{ $fp->product->name }}
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <span>💰</span>
                                        <span class="font-semibold text-green-600 dark:text-green-400">
                                            R$ {{ number_format($fp->price, 2, ',', '.') }}
                                        </span>
                                    </span>
                                    @if (!is_null($fp->quantity))
                                        <span class="flex items-center gap-1">
                                            <span>📦</span>
                                            <span class="font-medium">
                                                {{ $fp->sold }}/{{ $fp->quantity }} vendidos
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-3 items-center">
                                @if ($fp->sold_out)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                        ❌ Esgotado
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                        ✅ Disponível
                                    </span>
                                @endif
                                <button wire:click="toggleSoldOut({{ $fp->id }})"
                                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 transform hover:scale-105 active:scale-95 font-medium text-gray-700 dark:text-gray-300">
                                    {{ $fp->sold_out ? '🔄 Reabrir' : '🚫 Esgotar' }}
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <div
                            class="p-4 bg-gray-100 dark:bg-gray-700 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-lg font-medium mb-1">🍽️ Cardápio vazio</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Adicione produtos ao cardápio da feirinha
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
