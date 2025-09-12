<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                    📦 Produtos
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Gerencie o catálogo de produtos da feirinha</p>
            </div>
            <button
                class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                wire:click="$toggle('showForm')">
                {{ $showForm ? '❌ Fechar' : '✨ Novo Produto' }}
            </button>
        </div>
    </div>

    @if ($showForm)
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    {{ $editingId ? 'Editar Produto' : 'Novo Produto' }}</h3>
            </div>

            <form wire:submit="save" class="space-y-6 max-w-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">📝 Nome do
                            Produto</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                            placeholder="Digite o nome do produto..." />
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
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">📸 Foto do
                            Produto</label>
                        <input type="file" wire:model="photo"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200" />
                        @error('photo')
                            <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        💾 Salvar Produto
                    </button>
                    <button type="button" wire:click="$toggle('showForm')"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        🚫 Cancelar
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Grid de Produtos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($products as $p)
            <div
                class="group bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-rotate-1">
                <!-- Imagem do produto -->
                <div class="relative mb-4">
                    @if ($p->photo_path)
                        <img src="{{ asset('storage/' . $p->photo_path) }}"
                            class="w-full h-32 object-cover rounded-xl shadow-md group-hover:shadow-lg transition-shadow duration-300"
                            alt="{{ $p->name }}" />
                    @else
                        <div
                            class="w-full h-32 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                            </svg>
                        </div>
                    @endif
                    <!-- Badge de status -->
                    <div class="absolute top-2 right-2">
                        <div class="px-2 py-1 bg-emerald-500 text-white text-xs font-semibold rounded-full shadow-lg">
                            ✅ Ativo
                        </div>
                    </div>
                </div>

                <!-- Informações do produto -->
                <div class="space-y-4">
                    <div>
                        <h3
                            class="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                            {{ $p->name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            ID: #{{ $p->id }}
                        </p>
                    </div>

                    <!-- Botões de ação -->
                    <div class="flex gap-2">
                        <button wire:click="edit({{ $p->id }})"
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm">
                            ✏️ Editar
                        </button>
                        <button wire:click="delete({{ $p->id }})"
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm">
                            🗑️ Excluir
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div
                    class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Nenhum produto cadastrado
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Clique em "Novo Produto" para adicionar seu
                        primeiro produto ao catálogo.</p>
                    <button wire:click="$toggle('showForm')"
                        class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        ✨ Criar Primeiro Produto
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>
