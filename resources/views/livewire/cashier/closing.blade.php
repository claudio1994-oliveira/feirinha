<div class="p-6 space-y-6">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <h1 class="text-2xl font-semibold">Fechamento do Caixa - {{ $fair?->name ?? 'Sem feirinha' }}</h1>
        <a href="{{ route('pos') }}" class="px-3 py-2 border rounded" wire:navigate>Voltar ao Caixa</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <h2 class="font-semibold mb-3">Totais por forma de pagamento</h2>
            <div class="space-y-2">
                @foreach ($totals as $t)
                    <div class="flex items-center justify-between">
                        <div class="capitalize">{{ $t->payment_method }}</div>
                        <div>
                            <span class="text-zinc-500 text-sm me-3">{{ $t->count }} vendas</span>
                            <span class="font-semibold">R$ {{ number_format($t->total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t mt-3 pt-3 flex items-center justify-between">
                <div>Total geral</div>
                <div class="text-lg font-semibold">R$ {{ number_format($grandTotal, 2, ',', '.') }}</div>
            </div>
        </div>

        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <h2 class="font-semibold mb-3">Quantidade vendida por produto</h2>
            <div class="space-y-2">
                @foreach ($byProduct as $row)
                    <div class="flex items-center justify-between">
                        <div>{{ $row->name }}</div>
                        <div>
                            <span class="text-zinc-500 text-sm me-3">{{ $row->qty }} und</span>
                            <span class="font-semibold">R$ {{ number_format($row->total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
