<?php

namespace App\Livewire\Fairs;

use App\Models\Fair;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public bool $showCreateForm = false;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|date')]
    public string $event_date = '';

    public function mount()
    {
        $this->event_date = now()->format('Y-m-d');
    }

    public function create()
    {
        $this->reset(['name', 'event_date']);
        $this->event_date = now()->format('Y-m-d');
        $this->showCreateForm = true;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            // Se for definir como atual, desativa todas as outras
            Fair::where('is_current', true)->update(['is_current' => false]);

            // Cria a nova feirinha como atual
            Fair::create([
                'name' => $this->name,
                'event_date' => $this->event_date,
                'is_current' => true, // Nova feirinha sempre fica ativa
            ]);
        });

        $this->dispatch('notify', message: 'Nova feirinha criada e definida como atual!', type: 'success');
        $this->reset(['showCreateForm', 'name', 'event_date']);
        $this->resetErrorBag();
    }

    public function cancel()
    {
        $this->reset(['showCreateForm', 'name', 'event_date']);
        $this->resetErrorBag();
    }

    public function setCurrent($fairId)
    {
        $fair = Fair::findOrFail($fairId);

        DB::transaction(function () use ($fair) {
            // Desativa todas as feirinhas
            Fair::where('is_current', true)->update(['is_current' => false]);

            // Ativa a selecionada
            $fair->update(['is_current' => true]);
        });

        $this->dispatch('notify', message: 'Feirinha "' . $fair->name . '" definida como atual!', type: 'success');
    }

    public function endCurrent()
    {
        $currentFair = Fair::where('is_current', true)->first();

        if ($currentFair) {
            $currentFair->update(['is_current' => false]);
            $this->dispatch('notify', message: 'Feirinha "' . $currentFair->name . '" encerrada!', type: 'success');
        } else {
            $this->dispatch('notify', message: 'Nenhuma feirinha ativa para encerrar.', type: 'error');
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.fairs.index', [
            'fairs' => Fair::latest('event_date')->get(),
            'currentFair' => Fair::where('is_current', true)->first(),
        ]);
    }
}
