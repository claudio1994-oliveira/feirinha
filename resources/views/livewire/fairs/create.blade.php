<div class="p-6 space-y-4">
    <h1 class="text-2xl font-semibold">Nova Feirinha</h1>

    <form wire:submit="save" class="space-y-4 max-w-xl">
        <div>
            <label class="block text-sm mb-1">Nome</label>
            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
            @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Data do evento</label>
            <input type="date" wire:model="event_date"
                class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
            @error('event_date')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" wire:model="is_current" /> Definir como feirinha atual
        </label>

        <div class="flex gap-2">
            <a href="{{ route('fairs.index') }}" class="px-3 py-2 border rounded" wire:navigate>Cancelar</a>
            <button class="px-3 py-2 bg-primary-600 text-white rounded">Salvar</button>
        </div>
    </form>
</div>
