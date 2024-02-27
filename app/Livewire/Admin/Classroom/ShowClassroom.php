<?php

namespace App\Livewire\Admin\Classroom;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cycle;
use App\Models\Level;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\ClassroomStudent;

class ShowClassroom extends Component
{
    use WithPagination;

    public $cycle_id, $level_id, $grade_id, $section_id;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '50';
    public $readyToLoad = false;

    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '50']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'cycle_id' => 'required|numeric',
        'level_id' => 'required|numeric',
        'grade_id' => 'required|numeric',
        'section_id' => 'required|numeric',
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
        $cycles = Cycle::orderBy('order', 'desc')->get();
        $leves = Level::orderBy('order', 'asc')->get();
        $grades = Grade::orderBy('order', 'asc')->get();
        $sections = Section::orderBy('order', 'asc')->get();
        $classrooms = Classroom::join('cycles', 'classrooms.cycle_id', 'cycles.id')
            ->join('levels', 'classrooms.level_id', 'levels.id')
            ->join('grades', 'classrooms.grade_id', 'grades.id')
            ->join('sections', 'classrooms.section_id', 'sections.id')
            ->select('classrooms.id', 'cycles.cycle_name as elciclo', 'levels.level_name as elnivel', 'grades.grade_name as elgrado', 'sections.section_name as laseccion')
            ->where('cycles.cycle_name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('levels.level_name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('grades.grade_name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('sections.section_name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.classroom.show-classroom', compact('classrooms', 'cycles', 'leves', 'grades', 'sections'));
    }
    public function loadClassrooms()
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
    public function save()
    {
        $this->validate();
        if (Classroom::where('cycle_id', $this->cycle_id)->where('level_id', $this->level_id)->where('grade_id', $this->grade_id)->where('section_id', $this->section_id)->doesntExist()) {
            Classroom::create(
                [
                    'cycle_id' => $this->cycle_id,
                    'level_id' => $this->level_id,
                    'grade_id' => $this->grade_id,
                    'section_id' => $this->section_id
                ]
            );
            $this->reset([
                'cycle_id', 'level_id', 'grade_id', 'section_id'
            ]);
            $this->dispatch('closeModalMessaje', 'Información guardada', 'Asignación creada exitosamente.', 'success', 'CreateNewGradeassignment');
        } else {
            $this->dispatch('closeModalMessaje', '¡Error!', 'Está intentando crear una asignación que ya existe.', 'error', 'null');
        }
    }
    public function resetFields()
    {
        $this->reset([
            'cycle_id', 'level_id', 'grade_id', 'section_id'
        ]);
    }

    public function delete(Classroom $classroom)
    {
        if (ClassroomStudent::where('classroom_id', $classroom->id)->doesntExist()) {
            $classroom->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Clase eliminada exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar la clase ya que se encuentra con estudiantes asignados.', 'info', 'null');
        }
    }
}
