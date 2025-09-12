<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex flex-col md:flex-row  items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                    🎪 Feirinhas
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Gerencie suas feirinhas e defina qual está ativa</p>
            </div>
            <div class="flex gap-3">
                @if ($currentFair)
                    <button
                        class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                        wire:click="endCurrent" wire:confirm="Tem certeza que deseja encerrar a feirinha atual?">
                        🛑 Encerrar Atual
                    </button>
                @endif
                <button
                    class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                    wire:click="create">
                    ✨ Nova Feirinha
                </button>
            </div>
        </div>
    </div>

    <!-- Status da Feirinha Atual -->
    @if ($currentFair)
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl p-6 text-white shadow-xl">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/20 rounded-xl">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold">🎉 Feirinha Ativa</h3>
                    <p class="text-green-100 text-lg">
                        {{ $currentFair->name }} -
                        {{ \Carbon\Carbon::parse($currentFair->event_date)->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/20 rounded-xl">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold">⚠️ Nenhuma Feirinha Ativa</h3>
                    <p class="text-amber-100 text-lg">Crie uma nova feirinha ou ative uma existente</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Feirinhas -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" />
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">📋 Todas as Feirinhas</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($fairs as $fair)
                <div
                    class="group relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl shadow-lg border-2 {{ $fair->is_current ? 'border-purple-500 shadow-purple-200 dark:shadow-purple-900/30' : 'border-gray-200 dark:border-gray-600' }} p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-105 hover:-rotate-1">

                    <!-- Badge de status -->
                    @if ($fair->is_current)
                        <div class="absolute -top-3 -right-3">
                            <div
                                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                ⭐ ATIVA
                            </div>
                        </div>
                    @endif

                    <!-- Conteúdo do card -->
                    <div class="space-y-4">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-2xl">
                                🎪
                            </div>
                            <h3
                                class="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">
                                {{ $fair->name }}
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                📅 {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}
                            </p>
                        </div>

                        <!-- Botões de ação -->
                        <div class="space-y-2">
                            <a href="{{ route('fairs.manage', $fair) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95"
                                wire:navigate>
                                🛠️ Gerenciar
                            </a>
                            @unless ($fair->is_current)
                                <button
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95"
                                    wire:click="setCurrent({{ $fair->id }})"
                                    wire:confirm="Deseja definir '{{ $fair->name }}' como feirinha atual?">
                                    🚀 Definir como Atual
                                </button>
                            @endunless
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div
                        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v1a1 1 0 01-1 1h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7H3a1 1 0 01-1-1V5a1 1 0 011-1h4zM9 3v1h6V3H9z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Nenhuma feirinha criada
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Comece criando sua primeira feirinha para
                            começar as vendas</p>
                        <button wire:click="create"
                            class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                            ✨ Criar Primeira Feirinha
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal de Criação de Feirinha -->
    @if ($showCreateForm)
        <div
            class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
            <div
                class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 w-full max-w-md">
                <div class="p-6">
                    <!-- Header do modal -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                        </div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                            ✨ Nova Feirinha
                        </h2>
                    </div>

                    <!-- Formulário -->
                    <div class="space-y-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                🎪 Nome da Feirinha <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                placeholder="Ex: Feirinha de Dezembro" required>
                            @error('name')
                                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label for="event_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                📅 Data do Evento <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="event_date" wire:model="event_date"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                required>
                            @error('event_date')
                                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Aviso informativo -->
                        <div
                            class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-blue-700 dark:text-blue-200">
                                    💡 <strong>Importante:</strong> A nova feirinha será automaticamente definida como
                                    ativa, encerrando a atual (se houver).
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="flex justify-end gap-3 mt-8">
                        <button
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95"
                            wire:click="cancel">
                            🚫 Cancelar
                        </button>
                        <button
                            class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                            wire:click="save">
                            🎪 Criar Feirinha
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
