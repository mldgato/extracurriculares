<?php

namespace App\Livewire\Admin\Levels;

use Livewire\Component;
use App\Models\Level;
use App\Models\Classroom;
use Livewire\WithPagination;

class ShowLevels extends Component
{
    use WithPagination;

    public $level_name, $level_id;
    public $search;
    public $sort = 'order';
    public $direction = 'asc';
    public $cant = '10';
    public $readyToLoad = false;
    public $theOrder = 0;

    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '10']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'level_name' => 'required|unique:levels',
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
            $levels = Level::where('level_name', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $levels = [];
        }
        return view('livewire.admin.levels.show-levels', compact('levels'));
    }
    public function loadLevels()
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
            'level_name'
        ]);
    }
    public function save()
    {
        $this->validate();
        Level::create(
            [
                'level_name' => $this->level_name,
                'order' => $this->theOrder
            ]
        );
        $this->reset([
            'level_name'
        ]);
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Nivel creado exitosamente.', 'success', 'CreateNewLevel');
    }
    public function edit($id)
    {
        $level = Level::where('id', $id)->first();
        $this->level_id = $id;
        $this->level_name = $level->level_name;
    }
    public function update()
    {
        $this->validate();
        if ($this->level_id) {
            $level = Level::find($this->level_id);
            $level->update([
                'level_name' => $this->level_name,
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Nivel actualizado exitosamente.', 'success', 'UpdateNewLevel');
        }
    }
    public function delete(Level $level)
    {
        if (Classroom::where('level_id', $level->id)->doesntExist()) {
            $level->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Nivel eliminado exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar el nivel ya que se encuentra en uso en una asignación.', 'info', 'null');
        }
    }
}
