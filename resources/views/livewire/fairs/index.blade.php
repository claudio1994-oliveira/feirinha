<div class="p-6 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Feirinhas</h1>
        <a href="{{ route('fairs.create') }}" class="px-3 py-2 bg-primary-600 text-white rounded" wire:navigate>
            Nova Feirinha
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($fairs as $fair)
            <div class="border rounded p-4 bg-white dark:bg-zinc-900">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <div class="font-semibold">{{ $fair->name }}</div>
                        <div class="text-sm text-zinc-500">
                            {{ \Carbon\Carbon::parse($fair->event_date)->format('d/m/Y') }}</div>
                    </div>
                    @if ($fair->is_current)
                        <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">Atual</span>
                    @endif
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('fairs.manage', $fair) }}" class="px-3 py-1 border rounded"
                        wire:navigate>Gerenciar</a>
                    @unless ($fair->is_current)
                        <form method="POST" action="{{ route('fairs.set-current', $fair) }}">
                            @csrf
                            <button class="px-3 py-1 border rounded">Definir como atual</button>
                        </form>
                    @endunless
                </div>
            </div>
        @endforeach
    </div>
</div>
