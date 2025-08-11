<?php

namespace App\Livewire\Fairs;

use App\Models\Fair;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|date')]
    public string $event_date = '';

    public bool $is_current = false;

    #[Layout('components.layouts.app')]
    public function save()
    {
        $this->validate();

        if ($this->is_current) {
            Fair::query()->update(['is_current' => false]);
        }

        Fair::create([
            'name' => $this->name,
            'event_date' => $this->event_date,
            'is_current' => $this->is_current,
        ]);

        return redirect()->route('fairs.index');
    }

    public function render()
    {
        return view('livewire.fairs.create');
    }
}
