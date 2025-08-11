<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $showForm = false;
    public ?int $editingId = null;
    #[Validate('required|string|max:255')] public string $name = '';
    #[Validate('nullable|image|max:1024')] public $photo = null;

    #[Layout('components.layouts.app')]
    public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('products', 'public');
        }

        if ($this->editingId) {
            $product = Product::findOrFail($this->editingId);
            $product->update([
                'name' => $this->name,
                'photo_path' => $photoPath ?? $product->photo_path,
            ]);
        } else {
            Product::create([
                'name' => $this->name,
                'photo_path' => $photoPath,
            ]);
        }

        $this->reset(['showForm', 'editingId', 'name', 'photo']);
    }

    public function edit(int $id)
    {
        $p = Product::findOrFail($id);
        $this->editingId = $p->id;
        $this->name = $p->name;
        $this->showForm = true;
    }

    public function delete(int $id)
    {
        Product::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::orderBy('name')->get(),
        ]);
    }
}
