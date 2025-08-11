<div class="max-w-5xl mx-auto p-6 space-y-6">
    <div class="text-center">
        <h1 class="text-3xl font-bold">{{ $fair?->name ?? 'Sem feirinha ativa' }}</h1>
        @if ($fair)
            <div class="text-zinc-500">{{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}</div>
        @endif
    </div>

    @if (!$fair)
        <div class="text-center text-zinc-600">Nenhuma feirinha ativa no momento.</div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($menu as $fp)
                <div class="border rounded p-4 bg-white">
                    <div class="flex items-center gap-3">
                        @if ($fp->product->photo_path)
                            <img src="{{ asset('storage/' . $fp->product->photo_path) }}"
                                class="w-16 h-16 object-cover rounded" />
                        @else
                            <div class="w-16 h-16 bg-zinc-200 rounded"></div>
                        @endif
                        <div class="flex-1">
                            <div class="font-semibold">{{ $fp->product->name }}</div>
                            <div class="text-sm text-zinc-500">R$ {{ number_format($fp->price, 2, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="mt-2 text-sm">
                        @if (!is_null($fp->quantity))
                            <span class="text-zinc-600">Vendidos: {{ $fp->sold }} / {{ $fp->quantity }}</span>
                        @else
                            <span class="text-zinc-600">Quantidade: ilimitada</span>
                        @endif
                        @if ($fp->sold_out)
                            <span class="ms-2 text-xs px-2 py-1 bg-amber-100 text-amber-800 rounded">Esgotado</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
