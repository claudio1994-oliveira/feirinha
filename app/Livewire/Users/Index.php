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

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|min:8')]
    public string $password = '';

    public function edit(int $id)
    {
        $u = User::findOrFail($id);
        $this->editingId = $u->id;
        $this->name = $u->name;
        $this->email = $u->email;
        $this->password = '';
        $this->showForm = true;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->reset(['editingId', 'name', 'email', 'password']);
        $this->showForm = true;
        $this->resetErrorBag();
    }

    public function cancel()
    {
        $this->reset(['showForm', 'editingId', 'name', 'email', 'password']);
        $this->resetErrorBag();
    }

    public function delete(int $id)
    {
        if ((Auth::user()?->id) === $id) {
            $this->dispatch('notify', message: 'Você não pode excluir seu próprio usuário.', type: 'error');
            return;
        }

        User::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Usuário excluído com sucesso.', type: 'success');
    }

    public function save()
    {
        if ($this->editingId) {
            // Edição de usuário existente
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$this->editingId,
                'password' => 'nullable|string|min:8',
            ]);

            $data = ['name' => $this->name, 'email' => $this->email];
            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }
            User::findOrFail($this->editingId)->update($data);
            $this->dispatch('notify', message: 'Usuário atualizado com sucesso.', type: 'success');
        } else {
            // Criação de novo usuário
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $this->dispatch('notify', message: 'Usuário criado com sucesso.', type: 'success');
        }

        $this->reset(['showForm', 'editingId', 'name', 'email', 'password']);
        $this->resetErrorBag();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }
}
