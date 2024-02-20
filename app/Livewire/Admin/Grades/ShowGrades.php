<?php

namespace App\Livewire\Admin\Grades;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Classroom;
use Livewire\WithPagination;

class ShowGrades extends Component
{
    use WithPagination;

    public $grade_name, $grade_short_name, $grade_id;
    public $practices = 0;
    public $search;
    public $sort = 'order';
    public $direction = 'asc';
    public $cant = '25';
    public $readyToLoad = false;
    public $theOrder = 0;

    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '25']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'grade_name' => 'required|unique:grades',
        'grade_short_name' => 'required|unique:grades',
        'practices' => 'required|numeric|digits:1',
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
            $grades = Grade::where('grade_name', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $grades = [];
        }
        return view('livewire.admin.grades.show-grades', compact('grades'));
    }
    public function loadGrades()
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
            'grade_name',
            'grade_short_name',
        ]);
    }
    public function save()
    {
        $this->validate();
        Grade::create(
            [
                'grade_name' => $this->grade_name,
                'grade_short_name' => $this->grade_short_name,
                'practices' => $this->practices,
                'order' => $this->theOrder
            ]
        );
        $this->reset([
            'grade_name',
            'grade_short_name',
            'practices'
        ]);
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Grado creado exitosamente.', 'success', 'CreateNewGrade');
    }
    public function edit($id)
    {
        $grade = Grade::where('id', $id)->first();
        $this->grade_id = $id;
        $this->grade_name = $grade->grade_name;
        $this->grade_short_name = $grade->grade_short_name;
        $this->practices = $grade->practices;
    }
    public function update()
    {
        $this->validate([
            'grade_name' => "required|unique:grades,grade_name,$this->grade_id",
            'grade_short_name' => "required|unique:grades,grade_short_name,$this->grade_id",
        ]);
        if ($this->grade_id) {
            $grade = Grade::find($this->grade_id);
            $grade->update([
                'grade_name' => $this->grade_name,
                'grade_short_name' => $this->grade_short_name,
                'practices' => $this->practices
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Grado actualizado exitosamente.', 'success', 'UpdateNewGrade');
        }
    }
    public function delete(Grade $grade)
    {
        if (Classroom::where('grade_id', $grade->id)->doesntExist()) {
            $grade->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Grado eliminado exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar el grado ya que se encuentra en uso en una asignación.', 'info', 'null');
        }
    }
}
