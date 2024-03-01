<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use App\Models\User;
use App\Models\Activity;

class ActivityInfo extends Component
{
    public $activity;
    public $user_id;
    public $readyToLoad = false;
    public $deleteUserId;
    public function render()
    {
        $activity = Activity::with(['users' => function ($query) {
            $query->orderBy('surname');
        }])->find($this->activity->id);
        $activityUsers = $activity->users;
        $users = User::all();
        return view('livewire.admin.activities.activity-info', compact('users', 'activityUsers'));
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

    public function loadUsers()
    {
        $this->readyToLoad = true;
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
    public function confirmDelete($userId)
    {
        $this->deleteUserId = $userId;
        $this->dispatch('confirmDelete'); // Dispara un evento para confirmar la eliminación
    }

    public function delete()
    {
        // Utiliza $this->deleteUserId para realizar la eliminación
        $userId = $this->deleteUserId;

        $activity = Activity::find($this->activity->id);
        $activity->users()->detach($userId);
        $this->dispatch('closeModalMessaje', 'Información eliminada', 'Se ha quitado el usuario como encargado.', 'success', 'null');
    }
}
