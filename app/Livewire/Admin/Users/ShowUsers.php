<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ShowUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $name, $surname, $email, $user_id;
    public $search = '';
    public $sort = 'surname';
    public $direction = 'asc';
    public $cant = '10';
    public $readyToLoad = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|unique:users',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCant()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }
    public function updatingDirection()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orwhere('surname', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $users = [];
        }
        return view('livewire.admin.users.show-users', compact('users'));
    }
    public function loadUsers()
    {
        $this->readyToLoad = true;
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'desc';
        }
    }

    public function resetFields()
    {
        $this->reset([
            'name',
            'surname',
            'email'
        ]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate();
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'surname' => $this->surname,
                'email' => $this->email,
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Usuario actualizado exitosamente.', 'success', 'UpdateNewCycle');
        }
    }
}
