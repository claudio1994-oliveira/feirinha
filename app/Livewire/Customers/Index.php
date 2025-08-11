<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public bool $showForm = false;
    public ?int $editingId = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|email|max:255')]
    public ?string $email = null;

    #[Validate('nullable|string|max:30')]
    public ?string $phone = null;

    public function edit(int $id)
    {
        $c = Customer::findOrFail($id);
        $this->editingId = $c->id;
        $this->name = $c->name;
        $this->email = $c->email;
        $this->phone = $c->phone;
        $this->showForm = true;
    }

    public function delete(int $id)
    {
        Customer::findOrFail($id)->delete();
    }

    public function save()
    {
        $this->validate();
        if ($this->editingId) {
            Customer::findOrFail($this->editingId)->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        } else {
            Customer::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
        }
        $this->reset(['showForm', 'editingId', 'name', 'email', 'phone']);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.customers.index', [
            'customers' => Customer::latest()->get(),
        ]);
    }
}
