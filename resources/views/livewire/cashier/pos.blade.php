<div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Caixa - {{ $fair?->name ?? 'Sem feirinha atual' }}</h1>
            <a href="{{ route('fairs.index') }}" class="px-3 py-2 border rounded" wire:navigate>Feirinhas</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach ($menu as $fp)
                <button wire:click="addToCart({{ $fp->id }})"
                    class="border rounded p-3 text-left bg-white dark:bg-zinc-900">
                    <div class="font-semibold">{{ $fp->product->name }}</div>
                    <div class="text-sm text-zinc-500">R$ {{ number_format($fp->price, 2, ',', '.') }}</div>
                    @if (!is_null($fp->quantity))
                        <div class="text-xs text-zinc-400">{{ $fp->sold }}/{{ $fp->quantity }}</div>
                    @endif
                </button>
            @endforeach
        </div>
    </div>

    <div class="space-y-4">
        <h2 class="font-semibold">Carrinho</h2>
        <div class="space-y-2">
            @forelse($cart as $i => $item)
                <div class="border rounded p-3 bg-white dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-semibold">{{ $item['name'] }}</div>
                            <div class="text-sm text-zinc-500">R$ {{ number_format($item['price'], 2, ',', '.') }}</div>
                        </div>
                        <button class="text-red-600" wire:click="removeFromCart({{ $i }})">Remover</button>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <label>Qtd</label>
                        <input type="number" min="1"
                            class="w-20 border rounded px-2 py-1 bg-white dark:bg-zinc-900"
                            wire:change="updateQty({{ $i }}, $event.target.value)"
                            value="{{ $item['qty'] }}" />
                        <div class="ms-auto font-semibold">R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</div>
                    </div>
                </div>
            @empty
                <div class="text-sm text-zinc-500">Carrinho vazio</div>
            @endforelse
        </div>

        <div class="border rounded p-3 bg-white dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div>Total</div>
                <div class="text-xl font-semibold">R$ {{ number_format($this->total, 2, ',', '.') }}</div>
            </div>
            <div class="mt-3 space-y-2">
                <label class="block text-sm">Forma de pagamento</label>
                <select wire:model="payment_method" class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900">
                    <option value="">Selecione...</option>
                    <option value="cash">Espécie</option>
                    <option value="pix">PIX</option>
                    <option value="card">Cartão</option>
                </select>
            </div>
            <button wire:click="checkout(false)" class="mt-3 px-3 py-2 bg-green-600 text-white w-full rounded"
                @disabled(count($cart) === 0 || !$payment_method)>Finalizar Venda</button>
        </div>

        <div class="border rounded p-3 bg-white dark:bg-zinc-900 space-y-2">
            <h3 class="font-semibold">Conta em aberto</h3>
            <div>
                <label class="block text-sm">Cliente (opcional)</label>
                <input type="number" placeholder="ID do cliente" wire:model="customer_id"
                    class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900" />
            </div>
            <button wire:click="checkout(true)" class="px-3 py-2 border rounded w-full">Abrir conta</button>
        </div>

        <div class="border rounded p-3 bg-white dark:bg-zinc-900 space-y-2">
            <h3 class="font-semibold">Contas abertas</h3>
            <div class="space-y-2">
                @foreach ($openOrders as $o)
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-semibold">#{{ $o->id }} - {{ $o->customer?->name ?? 'Avulso' }}
                            </div>
                            <div class="text-sm text-zinc-500">R$ {{ number_format($o->total, 2, ',', '.') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-2 space-y-2">
                <label class="block text-sm">Forma de pagamento</label>
                <select wire:model="payment_method" class="w-full border rounded px-3 py-2 bg-white dark:bg-zinc-900">
                    <option value="">Selecione...</option>
                    <option value="cash">Espécie</option>
                    <option value="pix">PIX</option>
                    <option value="card">Cartão</option>
                </select>
                <div class="flex gap-2">
                    @foreach ($openOrders as $o)
                        <button wire:click="payOpenOrder({{ $o->id }})" class="px-3 py-1 border rounded">Pagar
                            #{{ $o->id }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
