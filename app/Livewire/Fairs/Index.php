<?php

namespace App\Livewire\Fairs;

use App\Models\Fair;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.fairs.index', [
            'fairs' => Fair::latest('event_date')->get(),
        ]);
    }
}
