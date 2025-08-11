<div class="p-6 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Produtos</h1>
        <button class="px-3 py-2 border rounded"
            wire:click="$toggle('showForm')">{{ $showForm ? 'Fechar' : 'Novo' }}</button>
    </div>

    @if ($showForm)
        <form wire:submit="save" class="space-y-3 max-w-xl">
            <div>
                <label class="block text-sm mb-1">Nome</label>
                <input type="text" wire:model="name"
                    class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Foto</label>
                <input type="file" wire:model="photo" class="w-full" />
                @error('photo')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button class="px-3 py-2 bg-primary-600 text-white rounded">Salvar</button>
        </form>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($products as $p)
            <div class="border rounded p-4 bg-white dark:bg-zinc-900">
                <div class="flex items-center gap-3">
                    @if ($p->photo_path)
                        <img src="{{ asset('storage/' . $p->photo_path) }}" class="w-16 h-16 object-cover rounded" />
                    @else
                        <div class="w-16 h-16 bg-zinc-200 rounded"></div>
                    @endif
                    <div class="flex-1">
                        <div class="font-semibold">{{ $p->name }}</div>
                    </div>
                </div>
                <div class="mt-3 flex gap-2">
                    <button class="px-3 py-1 border rounded" wire:click="edit({{ $p->id }})">Editar</button>
                    <button class="px-3 py-1 border rounded text-red-600"
                        wire:click="delete({{ $p->id }})">Excluir</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
