<div class="max-w-5xl mx-auto p-6 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Usuários</h1>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">Gerencie quem pode acessar o sistema.</p>
        </div>
        <flux:button icon="plus" wire:click="$set('showForm', true)">Novo usuário</flux:button>
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
                            <flux:button size="sm" variant="ghost" wire:click="edit({{ $u->id }})">Editar
                            </flux:button>
                            <flux:button size="sm" variant="danger" wire:click="delete({{ $u->id }})">
                                Excluir</flux:button>
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

    <flux:modal name="user-form" :show="$showForm" focusable class="max-w-lg">
        <div
            class="w-full rounded-xl border border-amber-200/60 bg-white/90 shadow dark:border-white/10 dark:bg-neutral-900/60">
            <div class="p-6 md:p-8">
                <h2 class="text-lg font-semibold mb-4">{{ $editingId ? 'Editar usuário' : 'Novo usuário' }}</h2>
                <div class="space-y-4">
                    <flux:input wire:model="name" label="Nome" required />
                    <flux:input wire:model="email" label="Email" type="email" required />
                    <flux:input wire:model="password" label="Senha" type="password"
                        placeholder="{{ $editingId ? 'Deixe em branco para manter' : 'Mínimo 8 caracteres' }}" />
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showForm', false)">Cancelar</flux:button>
                    <flux:button variant="primary" wire:click="save">Salvar</flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
