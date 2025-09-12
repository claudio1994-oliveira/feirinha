<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">
                    👥 Clientes
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Gerencie seus clientes e seus dados de contato</p>
            </div>
            <button
                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                wire:click="$toggle('showForm')">
                {{ $showForm ? '❌ Fechar' : '✨ Novo Cliente' }}
            </button>
        </div>
    </div>

    @if ($showForm)
        <div
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    {{ $editingId ? 'Editar Cliente' : 'Novo Cliente' }}</h3>
            </div>

            <form wire:submit="save" class="space-y-6 max-w-3xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">👤 Nome
                            Completo</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Digite o nome completo do cliente..." />
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
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">📧 Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="cliente@email.com" />
                        @error('email')
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
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">📱
                            Telefone</label>
                        <input type="text" wire:model="phone"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="(11) 99999-9999" />
                        @error('phone')
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
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        💾 Salvar Cliente
                    </button>
                    <button type="button" wire:click="$toggle('showForm')"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        🚫 Cancelar
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Grid de Clientes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($customers as $c)
            <div
                class="group bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-rotate-1">
                <!-- Avatar e info principal -->
                <div class="text-center mb-6">
                    <div
                        class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        {{ strtoupper(substr($c->name, 0, 1)) }}
                    </div>
                    <h3
                        class="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                        {{ $c->name }}
                    </h3>
                </div>

                <!-- Informações de contato -->
                <div class="space-y-3 mb-6">
                    @if ($c->email)
                        <div class="flex items-center gap-3 p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300 truncate">{{ $c->email }}</span>
                        </div>
                    @endif

                    @if ($c->phone)
                        <div class="flex items-center gap-3 p-2 rounded-lg bg-green-50 dark:bg-green-900/20">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $c->phone }}</span>
                        </div>
                    @endif

                    @if (!$c->email && !$c->phone)
                        <div class="flex items-center gap-3 p-2 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                            </svg>
                            <span class="text-sm text-gray-400">Sem informações de contato</span>
                        </div>
                    @endif
                </div>

                <!-- Botões de ação -->
                <div class="flex gap-2">
                    <button wire:click="edit({{ $c->id }})"
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm">
                        ✏️ Editar
                    </button>
                    <button wire:click="delete({{ $c->id }})"
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm">
                        🗑️ Excluir
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div
                    class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-12 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Nenhum cliente cadastrado
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Adicione seus primeiros clientes para começar a
                        organizar as vendas.</p>
                    <button wire:click="$toggle('showForm')"
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        ✨ Cadastrar Primeiro Cliente
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>
