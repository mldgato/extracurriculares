<?php

namespace App\Livewire\Admin\Sections;

use Livewire\Component;
use App\Models\Section;
use App\Models\Classroom;
use Livewire\WithPagination;

class ShowSections extends Component
{
    use WithPagination;

    public $section_name, $section_id;
    public $search;
    public $sort = 'order';
    public $direction = 'asc';
    public $cant = '10';
    public $readyToLoad = false;
    public $TheOrder = 0;

    protected $paginationTheme = "bootstrap";
    protected $queryString = [
        'cant' => ['except' => '10']
    ];
    protected $listeners = ['render', 'delete'];
    protected $rules = [
        'section_name' => 'required|unique:sections',
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
            $sections = Section::where('section_name', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $sections = [];
        }
        return view('livewire.admin.sections.show-sections', compact('sections'));
    }
    public function loadSections()
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
            'section_name'
        ]);
    }

    public function save()
    {
        $this->validate();
        Section::create(
            [
                'section_name' => $this->section_name,
                'order' => $this->TheOrder
            ]
        );
        $this->reset([
            'section_name'
        ]);
        $this->dispatch('closeModalMessaje', 'Información guardada', 'Sección creada exitosamente.', 'success', 'CreateNewSection');
    }

    public function edit($id)
    {
        $section = Section::where('id', $id)->first();
        $this->section_id = $id;
        $this->section_name = $section->section_name;
    }
    public function update()
    {
        $this->validate();
        if ($this->section_id) {
            $section = Section::find($this->section_id);
            $section->update([
                'section_name' => $this->section_name,
            ]);
            $this->resetFields();
            $this->dispatch('closeModalMessaje', 'Información actualizada', 'Sección actualizada exitosamente.', 'success', 'UpdateNewSection');
        }
    }
    public function delete(Section $section)
    {
        if (Classroom::where('section_id', $section->id)->doesntExist()) {
            $section->delete();
            $this->dispatch('closeModalMessaje', 'Información eliminada', 'Sección eliminada exitosamente.', 'success', 'null');
        } else {
            $this->dispatch('closeModalMessaje', 'Información', 'No se ha podido eliminar la sección ya que se encuentra en uso en una asignación.', 'info', 'null');
        }
    }
}
