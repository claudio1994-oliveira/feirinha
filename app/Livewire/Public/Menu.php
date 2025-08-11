<?php

namespace App\Livewire\Public;

use App\Models\Fair;
use App\Models\FairProduct;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Menu extends Component
{
    #[Layout('components.layouts.public')]
    public function render()
    {
        $fair = Fair::where('is_current', true)->first();

        $menu = collect();
        if ($fair) {
            $menu = FairProduct::with('product')
                ->where('fair_id', $fair->id)
                ->orderBy('id')
                ->get();
        }

        return view('livewire.public.menu', compact('fair', 'menu'));
    }
}
