<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ShowUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $user, $name, $surname, $email, $user_id, $password, $password_repeat, $user_roles;
    public $selectedRoles = [];
    public $search = '';
    public $sort = 'surname';
    public $direction = 'asc';
    public $cant = '10';
    public $readyToLoad = false;

    protected $queryString = [
        'cant' => ['except' => '10'],
        'search' => ['except' => '']
    ];

    protected $listeners = ['render', 'delete', 'save'];

    public function mount()
    {
        $this->rules = $this->rules();
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    protected array $rules = [];

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
        $roles = Role::all();
        if ($this->readyToLoad) {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orwhere('surname', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $users = [];
        }

        // Obtener los roles asignados al usuario actual
        $rolesUsuario = optional($this->user)->roles ? $this->user->roles->pluck('id')->toArray() : [];

        // Declarar $selectedRoles
        $selectedRoles = $this->selectedRoles;

        return view('livewire.admin.users.show-users', compact('users', 'roles', 'rolesUsuario', 'selectedRoles'));
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
            'email',
            'password',
            'password_repeat'
        ]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->user = User::where('id', $id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();
    }

    public function update()
    {
        $validar = $this->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$this->user_id",
        ]);

        if ($validar) {
            if ($this->user_id) {
                $user = User::find($this->user_id);
                $user->update([
                    'name' => $this->name,
                    'surname' => $this->surname,
                    'email' => $this->email,
                ]);
                $this->resetFields();
                $this->dispatch('closeModalMessaje', 'Información actualizada', 'Usuario actualizado exitosamente.', 'success', 'UpdateUserData');
            }
        }
    }

    public function updatePass()
    {
        $validar = $this->validate([
            'password' => 'required|min:8',
            'password_repeat' => 'required|same:password'
        ]);

        if ($validar) {
            if ($this->user_id) {
                $user = User::find($this->user_id);
                $user->update([
                    'password' => $this->password
                ]);
                $this->resetFields();
                $this->dispatch('closeModalMessaje', 'Información actualizada', 'Usuario actualizado exitosamente.', 'success', 'UpdateUserPass');
            }
        }
    }

    public function updateRole()
    {
        if ($this->user_id) {
            $user = User::find($this->user_id);

            // Verifica la existencia de los roles antes de sincronizar
            $existingRoles = Role::whereIn('id', $this->selectedRoles)->pluck('id')->toArray();
            $user->syncRoles($existingRoles);

            $this->dispatch('closeModalMessaje', 'Información', 'Usuario actualizado exitósamente.', 'info', 'UpdateUserRole');
        }
    }

    public function save()
    {
        $validar = $this->validate([
            'name' => 'required',
            'surname' => 'required', // Agrega 'required' aquí
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_repeat' => 'required|same:password'
        ]);
        if ($validar) {
            User::create([
                'name' => $this->name,
                'surname' => $this->surname, // Agrega esta línea
                'email' => $this->email,
                'password' => $this->password,
            ]);
        }
        $this->resetFields();
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Usuario creado exitosamente.', 'success', 'CreateNewCycle');
    }
}
