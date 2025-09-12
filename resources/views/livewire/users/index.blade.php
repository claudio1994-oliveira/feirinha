<div class="max-w-5xl mx-auto p-6 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Usuários</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Gerencie quem pode acessar o sistema.</p>
        </div>
        <button
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            wire:click="create">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Novo usuário
        </button>
    </div>

    <div class="rounded-lg border border-amber-200/60 bg-white/90 dark:border-white/10 dark:bg-neutral-900/60">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 w-40">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $u)
                    <tr class="border-t border-neutral-200/60 dark:border-white/10">
                        <td class="px-4 py-3">{{ $u->name }}</td>
                        <td class="px-4 py-3">{{ $u->email }}</td>
                        <td class="px-4 py-3">
                            <button
                                class="inline-flex items-center px-3 py-1 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2"
                                wire:click="edit({{ $u->id }})">
                                Editar
                            </button>
                            <button
                                class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                wire:click="delete({{ $u->id }})"
                                wire:confirm="Tem certeza que deseja excluir este usuário?">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-neutral-600 dark:text-neutral-400">Nenhum
                            usuário.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3">
                    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                        {{ $editingId ? 'Editar usuário' : 'Novo usuário' }}</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input type="text" id="name" wire:model="name"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="email" wire:model="email"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Senha @if (!$editingId)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <input type="password" id="password" wire:model="password"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="{{ $editingId ? 'Deixe em branco para manter a senha atual' : 'Mínimo 8 caracteres' }}"
                                @if (!$editingId) required @endif>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-2">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2"
                            wire:click="cancel">
                            Cancelar
                        </button>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            wire:click="save">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
