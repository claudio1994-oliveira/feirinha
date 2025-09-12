<div class="max-w-7xl mx-auto p-6 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Feirinhas</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Gerencie suas feirinhas e defina qual está ativa.
            </p>
        </div>
        <div class="flex gap-2">
            @if ($currentFair)
                <button
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    wire:click="endCurrent" wire:confirm="Tem certeza que deseja encerrar a feirinha atual?">
                    Encerrar Atual
                </button>
            @endif
            <button
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                wire:click="create">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Feirinha
            </button>
        </div>
    </div>

    <!-- Status da Feirinha Atual -->
    @if ($currentFair)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 dark:bg-green-900/20 dark:border-green-800">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-green-800 dark:text-green-200">Feirinha Ativa</h3>
                    <p class="text-sm text-green-700 dark:text-green-300">
                        {{ $currentFair->name }} -
                        {{ \Carbon\Carbon::parse($currentFair->event_date)->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 dark:bg-yellow-900/20 dark:border-yellow-800">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Nenhuma Feirinha Ativa</h3>
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">Crie uma nova feirinha ou ative uma
                        existente.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Feirinhas -->
    <div class="rounded-lg border border-amber-200/60 bg-white/90 dark:border-white/10 dark:bg-neutral-900/60">
        <div class="p-6">
            <h2 class="text-lg font-semibold mb-4">Todas as Feirinhas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($fairs as $fair)
                    <div
                        class="border rounded-lg p-4 bg-white dark:bg-gray-800 {{ $fair->is_current ? 'ring-2 ring-green-500' : '' }}">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">{{ $fair->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}
                                </div>
                            </div>
                            @if ($fair->is_current)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Ativa
                                </span>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('fairs.manage', $fair) }}"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                wire:navigate>
                                Gerenciar
                            </a>
                            @unless ($fair->is_current)
                                <button
                                    class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                    wire:click="setCurrent({{ $fair->id }})"
                                    wire:confirm="Deseja definir '{{ $fair->name }}' como feirinha atual?">
                                    Definir como Atual
                                </button>
                            @endunless
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v1a1 1 0 01-1 1h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V7H3a1 1 0 01-1-1V5a1 1 0 011-1h4zM9 3v1h6V3H9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Nenhuma feirinha</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comece criando sua primeira feirinha.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal de Criação de Feirinha -->
    @if ($showCreateForm)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3">
                    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Nova Feirinha</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome da Feirinha
                                <span class="text-red-500">*</span></label>
                            <input type="text" id="name" wire:model="name"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Ex: Feirinha de Dezembro" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="event_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data do Evento <span
                                    class="text-red-500">*</span></label>
                            <input type="date" id="event_date" wire:model="event_date"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('event_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div
                            class="bg-blue-50 border border-blue-200 rounded-md p-3 dark:bg-blue-900/20 dark:border-blue-800">
                            <div class="flex">
                                <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-blue-700 dark:text-blue-200">
                                    A nova feirinha será automaticamente definida como ativa, encerrando a atual (se
                                    houver).
                                </p>
                            </div>
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
                            Criar Feirinha
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
