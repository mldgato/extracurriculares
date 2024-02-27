<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use App\Models\Activity;
use Livewire\WithPagination;

class ShowActivities extends Component
{
    public $activity, $activity_id;
    public $search;
    public $sort = 'order';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;

    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '10']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'activity' => 'required|unique:activities',
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
            $activities = Activity::where('activity', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $activities = [];
        }
        return view('livewire.admin.activities.show-activities', compact('activities'));
    }
    public function loadActivities()
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
            'activity'
        ]);
    }
    public function save()
    {
        $this->validate();
        Activity::create(
            [
                'activity' => $this->activity,
            ]
        );
        $this->resetFields();
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Actividad creada exitosamente.', 'success', 'CreateNewCycle');
    }
    public function edit($id)
    {
        $activity = Activity::where('id', $id)->first();
        $this->activity_id = $id;
        $this->activity = $activity->activity;
    }
    public function update()
    {
        $this->validate();
        if ($this->cycle_id) {
            $activity = Activity::find($this->activity_id);
            $activity->update([
                'activity' => $this->activity,
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Acticidad actualizada exitosamente.', 'success', 'UpdateNewCycle');
        }
    }
    public function delete(Activity $activity)
    {
        /* if (Classroom::where('cycle_id', $cycle->id)->doesntExist()) {
            $cycle->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Ciclo eliminado exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar el ciclo ya que se encuentra en uso en una asignación.', 'info', 'null');
        } */
    }
}
