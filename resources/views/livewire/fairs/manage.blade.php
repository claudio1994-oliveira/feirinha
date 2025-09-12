<div class="p-6 space-y-6">
    <div class="flex flex-col md:flex-row  items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Gerenciar Feirinha: {{ $fair->name }}</h1>
            <div class="text-sm text-zinc-500">{{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}</div>
        </div>
        <a href="{{ route('fairs.index') }}" class="px-3 py-2 border rounded" wire:navigate>Voltar</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
            <h2 class="font-semibold">Adicionar/Editar Produto no Cardápio</h2>
            <form wire:submit="addOrUpdateProduct" class="space-y-3">
                <div>
                    <label class="block text-sm mb-1">Produto</label>
                    <select wire:model="product_id" class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900">
                        <option value="">Selecione...</option>
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm mb-1">Preço</label>
                        <input type="number" min="0" step="0.01" wire:model="price"
                            class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Quantidade (opcional)</label>
                        <input type="number" min="0" step="1" wire:model="quantity"
                            class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
                    </div>
                </div>
                <button class="px-3 py-2 bg-primary-600 text-white rounded">Salvar</button>
            </form>
        </div>

        <div class="space-y-4">
            <h2 class="font-semibold">Cardápio do Dia</h2>
            <div class="space-y-2">
                @forelse($menu as $fp)
                    <div class="border rounded p-3 flex items-center justify-between">
                        <div>
                            <div class="font-semibold">{{ $fp->product->name }}</div>
                            <div class="text-sm text-zinc-500">R$ {{ number_format($fp->price, 2, ',', '.') }}
                                @if (!is_null($fp->quantity))
                                    • {{ $fp->sold }}/{{ $fp->quantity }} vendidos
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            @if ($fp->sold_out)
                                <span class="text-xs px-2 py-1 bg-amber-100 text-amber-800 rounded">Esgotado</span>
                            @endif
                            <button wire:click="toggleSoldOut({{ $fp->id }})"
                                class="px-3 py-1 border rounded">{{ $fp->sold_out ? 'Reabrir' : 'Esgotar' }}</button>
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-zinc-500">Nenhum produto no cardápio.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
