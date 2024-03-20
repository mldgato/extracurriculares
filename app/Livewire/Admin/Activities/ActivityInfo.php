<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityUser;

class ActivityInfo extends Component
{
    public $activity; // Esta propiedad tiene la información de la actividad, incluido el ID
    public $usersAssignedToActivity; // Aquí almacenaremos los usuarios asignados a la actividad
    public $users; // Aquí almacenaremos todos los usuarios
    public $user_id; //El ide del usuario de select
    public $readyToLoad = false;
    public function mount()
    {
        // Obtenemos todos los usuarios
        $this->users = User::all();

        // Verificamos si hay una actividad cargada
        if ($this->activity) {
            // Obtenemos la actividad específica utilizando el ID
            $activity = Activity::findOrFail($this->activity->id);

            // Obtenemos los IDs de los usuarios asignados a la actividad
            $userIdsAssignedToActivity = $activity->activityUser()->pluck('user_id');

            // Obtenemos los usuarios asignados a la actividad
            $this->usersAssignedToActivity = User::whereIn('id', $userIdsAssignedToActivity)->get();
        }
    }
    public function render()
    {
        // Enviando datos a la vista
        return view('livewire.admin.activities.activity-info', [
            'activityUsers' => $this->usersAssignedToActivity,
            'users' => $this->users,
        ]);
    }
    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '10']
    ];
    protected $listeners = ['render', 'delete', 'save', 'refreshComponent' => '$refresh'];
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
        $ActivityUser = ActivityUser::create([
            'user_id' => $this->user_id,
            'activity_id' => $this->activity->id,
        ]);
        if ($ActivityUser) {
            $this->dispatch('closeModalMessaje', 'Información guardada', 'Asignación creada exitosamente.', 'success', 'CreateNewGradeassignment');
            // Emitir el evento
            $this->dispatch('refreshComponent');
        } else {
            $this->dispatch('closeModalMessaje', '¡Error!', 'Está intentando crear una asignación que ya existe.', 'error', 'null');
        }
    }




    public function confirmDelete($userId)
    {
        $this->dispatch('confirmDelete', $userId);
    }

    public function delete($userId)
    {
        User::find($userId)->activities()->detach($this->activity->id);
        $this->dispatch('closeModalMessaje', 'Información eliminada', 'Asignación eliminada exitosamente.', 'success', 'DeleteGradeassignment');
    }
}
