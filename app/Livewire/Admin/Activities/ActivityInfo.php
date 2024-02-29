<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use App\Models\User;

class ActivityInfo extends Component
{
    public $activity;
    public $user_id;
    public $search;
    public $sort = 'order';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    public function render()
    {
        $users = User::all();
        return view('livewire.admin.activities.activity-info', compact('users'));
    }
    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '10']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'user_id' => 'required',
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
            $this->direction = 'asc';
        }
    }
    public function resetFields()
    {
        $this->reset([
            'user_id'
        ]);
    }
    public function save()
    {
        $this->validate();
        $existingRelation = User::find($this->user_id)->activities()->where('activity_id', $this->activity->id)->exists();
        if (!$existingRelation) {
            User::find($this->user_id)->activities()->attach($this->activity->id);
            $this->dispatch('closeModalMessaje', 'Información guardada', 'Asignación creada exitosamente.', 'success', 'CreateNewGradeassignment');
        } else {
            $this->dispatch('closeModalMessaje', '¡Error!', 'Está intentando crear una asignación que ya existe.', 'error', 'null');
        }
    }
}
