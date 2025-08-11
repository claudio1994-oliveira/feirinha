<div class="p-6 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Clientes</h1>
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
                <label class="block text-sm mb-1">Email</label>
                <input type="email" wire:model="email"
                    class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Telefone</label>
                <input type="text" wire:model="phone"
                    class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
                @error('phone')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button class="px-3 py-2 bg-primary-600 text-white rounded">Salvar</button>
        </form>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($customers as $c)
            <div class="border rounded p-4 bg-white dark:bg-zinc-900">
                <div class="font-semibold">{{ $c->name }}</div>
                <div class="text-sm text-zinc-500">{{ $c->email }}</div>
                <div class="text-sm text-zinc-500">{{ $c->phone }}</div>
                <div class="mt-3 flex gap-2">
                    <button class="px-3 py-1 border rounded" wire:click="edit({{ $c->id }})">Editar</button>
                    <button class="px-3 py-1 border rounded text-red-600"
                        wire:click="delete({{ $c->id }})">Excluir</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
