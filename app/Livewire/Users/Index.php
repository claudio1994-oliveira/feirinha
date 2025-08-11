<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public bool $showForm = false;
    public ?int $editingId = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('nullable|string|min:8')]
    public ?string $password = null;

    public function edit(int $id)
    {
        $u = User::findOrFail($id);
        $this->editingId = $u->id;
        $this->name = $u->name;
        $this->email = $u->email;
        $this->password = null;
        $this->showForm = true;
    }

    public function delete(int $id)
    {
        if ((Auth::user()?->id) === $id) {
            return; // evita apagar a si mesmo
        }
        User::findOrFail($id)->delete();
    }

    public function save()
    {
        if ($this->editingId) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$this->editingId,
                'password' => 'nullable|string|min:8',
            ]);

            $data = ['name' => $this->name, 'email' => $this->email];
            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }
            User::findOrFail($this->editingId)->update($data);
        } else {
            $this->validate();
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password ?? 'changeme123'),
            ]);
        }

        $this->reset(['showForm', 'editingId', 'name', 'email', 'password']);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }
}
