<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class PasswordUser extends Component
{
    public $password, $repeat, $user_id;
    public function render()
    {
        return view('livewire.admin.users.password-user');
    }
}
