<div
    class="min-h-screen bg-gradient-to-br from-[#fff7ed] via-[#fef3c7] to-[#fed7aa] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 space-y-8">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6">
        <div class="flex flex-col md:flex-row  items-center justify-between">
            <div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-red-600 to-pink-600 dark:from-red-400 dark:to-pink-400 bg-clip-text text-transparent">
                    👤 Usuários
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Gerencie quem pode acessar o sistema</p>
            </div>
            <button
                class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                wire:click="create">
                ✨ Novo Usuário
            </button>
        </div>
    </div>

    <!-- Tabela de Usuários -->
    <div
        class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">👥 Lista de Usuários</h2>
            </div>

            @forelse ($users as $u)
                <div
                    class="group mb-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl p-6 hover:from-red-50 hover:to-pink-50 dark:hover:from-red-900/20 dark:hover:to-pink-900/20 transition-all duration-300 transform hover:scale-[1.02] border border-gray-200 dark:border-gray-600">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Avatar -->
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>

                            <!-- Info do usuário -->
                            <div>
                                <h3
                                    class="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors duration-300">
                                    {{ $u->name }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    {{ $u->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Botões de ação -->
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm"
                                wire:click="edit({{ $u->id }})">
                                ✏️ Editar
                            </button>
                            <button
                                class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm"
                                wire:click="delete({{ $u->id }})"
                                wire:confirm="Tem certeza que deseja excluir este usuário?">
                                🗑️ Excluir
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Nenhum usuário cadastrado
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Crie usuários para dar acesso ao sistema.</p>
                    <button wire:click="create"
                        class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95">
                        ✨ Criar Primeiro Usuário
                    </button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal de Formulário -->
    @if ($showForm)
        <div
            class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
            <div
                class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 w-full max-w-md">
                <div class="p-6">
                    <!-- Header do modal -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                        </div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-red-600 to-pink-600 dark:from-red-400 dark:to-pink-400 bg-clip-text text-transparent">
                            {{ $editingId ? '✏️ Editar Usuário' : '✨ Novo Usuário' }}
                        </h2>
                    </div>

                    <!-- Formulário -->
                    <div class="space-y-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                👤 Nome Completo <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="Digite o nome completo..." required>
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
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                📧 Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" wire:model="email"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="usuario@email.com" required>
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
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                🔒 Senha
                                @if (!$editingId)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <input type="password" id="password" wire:model="password"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white/90 dark:bg-gray-700/90 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                placeholder="{{ $editingId ? 'Deixe em branco para manter a senha atual' : 'Mínimo 8 caracteres' }}"
                                @if (!$editingId) required @endif>
                            @error('password')
                                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if ($editingId)
                            <!-- Aviso para edição -->
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
                                        💡 <strong>Dica:</strong> Deixe o campo senha em branco para manter a senha
                                        atual do usuário.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Botões de ação -->
                    <div class="flex justify-end gap-3 mt-8">
                        <button
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95"
                            wire:click="cancel">
                            🚫 Cancelar
                        </button>
                        <button
                            class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                            wire:click="save">
                            💾 Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
