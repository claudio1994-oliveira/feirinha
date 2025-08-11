<?php

use App\Models\Customer;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth-culinary')] class extends Component {
    public string $name = '';
    public ?string $email = null;
    public ?string $phone = null;
    public bool $created = false;

    /**
     * Handle an incoming registration request (cliente público).
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Customer::class],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        Customer::create($validated);

        $this->reset(['name', 'email', 'phone']);
        $this->created = true;
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Cadastre-se como cliente')" :description="__('Informe seus dados para facilitar compras e comprovantes')" />

    @if ($created)
        <div
            class="rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-amber-800 dark:border-white/10 dark:bg-neutral-800 dark:text-amber-300">
            {{ __('Cadastro realizado com sucesso!') }}
        </div>
    @endif

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="name" :label="__('Nome completo')" type="text" required autofocus autocomplete="name"
            :placeholder="__('Ex: Maria da Silva')" />

        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Email (opcional)')" type="email" autocomplete="email"
            placeholder="email@example.com" />

        <!-- Phone -->
        <flux:input wire:model="phone" :label="__('Telefone (opcional)')" type="text" autocomplete="tel"
            :placeholder="__('(xx) xxxxx-xxxx')" />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Cadastrar') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Já é operador do sistema?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Entrar') }}</flux:link>
    </div>
</div>
