<div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Dashboard - {{ $fair?->name ?? 'Sem feirinha atual' }}</h1>
        <a href="{{ route('pos') }}" class="px-3 py-2 border rounded" wire:navigate>Ir para o Caixa</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500">Faturamento</div>
            <div class="text-2xl font-semibold">R$ {{ number_format($total, 2, ',', '.') }}</div>
        </div>
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500">Vendas pagas</div>
            <div class="text-2xl font-semibold">{{ $ordersCount }}</div>
        </div>
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500">Ticket médio</div>
            <div class="text-2xl font-semibold">R$ {{ number_format($avgTicket, 2, ',', '.') }}</div>
        </div>
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500">Itens vendidos</div>
            <div class="text-2xl font-semibold">{{ $itemsSold }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500 mb-2">Por forma de pagamento</div>
            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between"><span>Espécie</span><span class="font-semibold">R$
                        {{ number_format($cashTotal, 2, ',', '.') }}</span></div>
                <div class="flex items-center justify-between"><span>PIX</span><span class="font-semibold">R$
                        {{ number_format($pixTotal, 2, ',', '.') }}</span></div>
                <div class="flex items-center justify-between"><span>Cartão</span><span class="font-semibold">R$
                        {{ number_format($cardTotal, 2, ',', '.') }}</span></div>
            </div>
        </div>

        <div class="border rounded p-4 bg-white dark:bg-zinc-900 lg:col-span-2">
            <div class="text-sm text-zinc-500 mb-2">Vendas por hora</div>
            <div class="grid grid-cols-6 md:grid-cols-12 gap-2">
                @foreach ($byHour as $row)
                    <div class="p-2 rounded border text-center">
                        <div class="text-xs text-zinc-500">{{ $row->hour }}h</div>
                        <div class="text-sm font-semibold">{{ $row->count }}</div>
                        <div class="text-xs">R$ {{ number_format($row->total, 2, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500 mb-2">Top 5 produtos</div>
            <div class="space-y-1">
                @foreach ($topProducts as $p)
                    <div class="flex items-center justify-between">
                        <div>{{ $p->name }}</div>
                        <div>
                            <span class="text-zinc-500 text-sm me-3">{{ $p->qty }} und</span>
                            <span class="font-semibold">R$ {{ number_format($p->total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="border rounded p-4 bg-white dark:bg-zinc-900">
            <div class="text-sm text-zinc-500 mb-2">Últimas vendas</div>
            <div class="space-y-2">
                @foreach ($recentOrders as $o)
                    <div class="flex items-center justify-between">
                        <div>#{{ $o->id }} - {{ $o->customer?->name ?? 'Avulso' }}</div>
                        <div>R$ {{ number_format($o->total, 2, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
