<?php

namespace App\Livewire\Admin\Cycles;

use Livewire\Component;
use App\Models\Cycle;
use App\Models\Classroom;
use Livewire\WithPagination;

class ShowCycles extends Component
{
    use WithPagination;

    public $cycle_name, $cycle_id;
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
        'cycle_name' => 'required|unique:cycles|numeric|digits:4',
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
            $cycles = Cycle::where('cycle_name', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $cycles = [];
        }
        return view('livewire.admin.cycles.show-cycles', compact('cycles'));
    }
    public function loadCycles()
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
            'cycle_name'
        ]);
    }
    public function edit($id)
    {
        $cycle = Cycle::where('id', $id)->first();
        $this->cycle_id = $id;
        $this->cycle_name = $cycle->cycle_name;
    }
    public function update()
    {
        $this->validate();
        if ($this->cycle_id) {
            $cycle = Cycle::find($this->cycle_id);
            $cycle->update([
                'cycle_name' => $this->cycle_name,
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Nivel actualizado exitosamente.', 'success', 'UpdateNewCycle');
        }
    }
    public function delete(Cycle $cycle)
    {
        if (Classroom::where('cycle_id', $cycle->id)->doesntExist()) {
            $cycle->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Ciclo eliminado exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar el ciclo ya que se encuentra en uso en una asignación.', 'info', 'null');
        }
    }
}
