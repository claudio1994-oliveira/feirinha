<?php

namespace App\Livewire\Fairs;

use App\Models\Fair;
use App\Models\FairProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Manage extends Component
{
    public Fair $fair;

    // Formulário de adição/edição no cardápio
    public ?int $product_id = null;
    #[Validate('required|numeric|min:0')] public $price = '';
    #[Validate('nullable|integer|min:0')] public $quantity = '';

    #[Layout('components.layouts.app')]
    public function mount(Fair $fair)
    {
        $this->fair = $fair;
    }

    public function addOrUpdateProduct()
    {
        $this->validate();
        $product = Product::findOrFail($this->product_id);

        $pivot = FairProduct::updateOrCreate(
            ['fair_id' => $this->fair->id, 'product_id' => $product->id],
            ['price' => $this->price, 'quantity' => $this->quantity]
        );

        if (! is_null($pivot->quantity) && $pivot->sold >= $pivot->quantity) {
            $pivot->sold_out = true;
            $pivot->save();
        }

        $this->reset(['product_id', 'price', 'quantity']);
        $this->dispatch('notify', message: 'Produto atualizado no cardápio.');
    }

    public function toggleSoldOut(int $fairProductId)
    {
        $fp = FairProduct::where('fair_id', $this->fair->id)->findOrFail($fairProductId);
        $fp->sold_out = ! $fp->sold_out;
        $fp->save();
    }

    public function render()
    {
        return view('livewire.fairs.manage', [
            'products' => Product::orderBy('name')->get(),
            'menu' => FairProduct::with('product')->where('fair_id', $this->fair->id)->get(),
        ]);
    }
}
