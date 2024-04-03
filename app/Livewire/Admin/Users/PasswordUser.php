<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class PasswordUser extends Component
{
    public $password, $repeat, $user_id;

    protected $rules = [
        'password' => 'required|min:8|max:50',
        'repeat' => 'required|min:8|max:50|same:password',
    ];

    public function render()
    {
        return view('livewire.admin.users.password-user');
    }

    public function resetFields()
    {
        $this->reset([
            'password',
            'repeat'
        ]);
    }

    public function update()
    {
        $this->user_id = auth()->user();
        $this->validate();
        $user = User::find($this->user_id);
        $user->update([
            'password' => $this->password
        ]);
        $this->resetFields();
        $this->dispatch('closeModalMessaje', 'Información actualizada', 'Contraseña actualizada exitosamente.', 'success', 'UpdateNewCycle');
    }
}
